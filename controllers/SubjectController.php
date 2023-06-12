<?php

namespace Controller;

use Model\Level;
use Model\Subject;
use Model\SubjectGroup;

use Controller\ResponseController;

class SubjectController
{
    private Subject $subject;
    private Level $levelModel;
    private SubjectGroup $subjectGroup;
    const JSON_CONTENT_TYPE = 'Content-Type: application/json';

    public function __construct()
    {
        $this->subject = new Subject;
        $this->levelModel= new Level;
        $this->subjectGroup = new SubjectGroup;
    }

    public function render()
    {
        ob_start();
        $levels = $this->levelModel->list();
        $subjectGroups = $this->subjectGroup->list();
        require_once VIEWS . DIRECTORY_SEPARATOR . 'subjects.html.php';
        $content = ob_get_clean();
        require_once VIEWS . DIRECTORY_SEPARATOR . 'template.html.php';
    }

    public function renderCoef($idClasse)
    {
        ob_start();
        $subjects = $this->subject->findInClasse($idClasse);
        $className = $subjects[0]->classe;
        // echo json_encode($subjects);
        require_once VIEWS . DIRECTORY_SEPARATOR . 'subjectsInClasse.html.php';
        $content = ob_get_clean();
        require_once VIEWS . DIRECTORY_SEPARATOR . 'template.html.php';
    }

    public function all()
    {
        header(self::JSON_CONTENT_TYPE);
        $data = $this->subject->list();

        if (!empty($data)) {
            ResponseController::generate(
                http_response_code(),
                "Données reçues avec succès",
                $data
            );
        } else {
            ResponseController::generate(
                204,
                "Aucun groupe de discipline !",
                []
            );
        }
    }

    public function byClasse($id)
    {
        header(self::JSON_CONTENT_TYPE);

        $data = $this->subject->groupBySubjectGroup($id);

        if (!empty($data)) {
            $data1 = $this->formatData($data);
            ResponseController::generate(http_response_code(), "Données reçues avec succès", $data1);
        } else {
            ResponseController::generate(
                204,
                "Aucune discipline dans cette classe",
                $data
            );
        }
    }

    private function formatData($data)
    {
        $data1 = [];
        
        foreach ($data as $subject) {
            $subjectGroupName = $subject->subject_groups;
            $subjectsSubjectsId = [];
            $subjects = explode(',', $subject->subjects);
            $idSubjects = explode(',', $subject->id_subjects);
            $subjectCodes = explode(',', $subject->subject_codes);
            for ($i=0; $i < count($subjects); $i++) {
                $tab = [
                    "subject_name" => $subjects[$i],
                    "subject_id" => $idSubjects[$i],
                    "subject_code" => $subjectCodes[$i]
                ];
                $subjectsSubjectsId[] = $tab;
            }
            $data1['group_name'][] = $subjectGroupName;
            $data1["subjects_ids"][] = $subjectsSubjectsId;
        }

        return $data1;
    }

    public function insert()
    {
        header(self::JSON_CONTENT_TYPE);

        $data = $_POST;

        $founded = $this->subject->findByLabel($data['label']);

        $code = $this->generateCode($data['label']);
        
        if (!$founded) {
            $inserted = $this->subject->insert($code, $data['label'], intval($data['subjectGroup']), intval($data['idClasse']));
            if ($inserted) {
                $lastInsertData = $this->subject->findByLabel($data['label']);
                ResponseController::generate(
                    http_response_code(),
                    "Une nouvelle discipline a été ajouté dans cette classe",
                    $lastInsertData
                );
            } else {
                ResponseController::generate(
                    204,
                    "Impossible d'enregistrer les données !!!",
                    []
                );
            }
            return;
        }

        $inClasse = $this->subject->getByClasseId($data['label'], $data['idClasse']);

        if (!$inClasse) {
            $this->subject->insertIntoSubjectClasse($founded->id, $data['idClasse']);
            $subjectInClasse = $this->subject->getByClasseId($data['label'], $data['idClasse']);
            ResponseController::generate(
                http_response_code(),
                "Une nouvelle discipline a été ajouté dans cette classe",
                $subjectInClasse
            );
            return;
        }

        ResponseController::generate(
            204,
            "Cette discipline existe déjà dans cette classe",
            []
        );
    }

    public function codeExists(string $code) : bool
    {
        if($this->subject->findSubjectByCode($code)) {
            return true;
        }

        return false;
    }

    public function generateCode(string $subject) : string
    {
        $code = "";
        $subject = trim($subject, ' ');

        if (strpos($subject, ' ')) {
            $labelParts = explode(' ', $subject);
            
            foreach ($labelParts as $part) {
                $code .= $part[0];
            }

            $code = strtoupper($code);

            if ($this->codeExists($code)) {
                $code .= $labelParts[0][0];
            }

            return $code;
        }

        $codeFounded = false;
        $start = 0;
        $end = 3;

        do {
            $code = strtoupper(substr($subject, $start, $end));
            $codeFounded = $this->codeExists($code);
            $end++;
        } while ($codeFounded);

        return $code;
    }

    public function deleteFromClasse($idClasse)
    {
        $idSubjects = explode(',', $_POST['idSubjects']);
        $deletedData = [];

        foreach ($idSubjects as $idSubject) {
            $data = $this->subject->findById($idSubject, $idClasse);
            $deletedData[] = $data;
        }

        if ($this->subject->removeAssocWithClasse($idClasse, $idSubjects)) {
            ResponseController::generate(
                200,
                count($idSubjects) > 1 ?
                    "Des disciplines ont étés retirées depuis cette classe"
                    :
                    "Une discipline a été retirée depuis cette classe",
                $deletedData
            );
        }
    }

    public function updateMaxNote()
    {
        $data = json_decode(file_get_contents('php://input'));
        
        if ($data && $this->subject->updateNoteMax(is_array($data) ? $data : [$data])) {
            $dataUpdated = $this->subject->findSubjectClasse(implode(",", array_column($data, 'id')));
            ResponseController::generate(200, "Données mises à jours", $dataUpdated);
        }
    }
}
