<?php

namespace Controller;

use Model\SubjectGroup;
use Controller\ResponseController;

class SubjectGroupController
{
    private SubjectGroup $subjectGroup;

    public function __construct()
    {
        $this->subjectGroup = new SubjectGroup;
    }

    public function insert()
    {
        $data = $_POST;
        $founded = $this->subjectGroup->findByLabel($data['subject-group']);

        if (!$founded) {
            $this->subjectGroup->insert($data['subject-group']);
            $lastInsertData = $this->subjectGroup->findByLabel($data['subject-group']);
            ResponseController::generate(
                http_response_code(),
                "Groupe de discipline enregistré avec succès",
                $lastInsertData
            );
            return;
        }

        ResponseController::generate(
            204,
            "Le groupe '" . $data['subject-group'] . "' existe déjà",
            []
        );
    }

    public function all()
    {
        $subjectGroups = $this->subjectGroup->list();

        if (!empty($subjectGroups)) {
            ResponseController::generate(
                http_response_code(),
                "Données reçus avec succès",
                $subjectGroups
            );
        } else {
            ResponseController::generate(
                204,
                "Aucun groupe de discipline n'est enregistrer!",
                []
            );
        }
    }
}
