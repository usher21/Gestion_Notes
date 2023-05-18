<?php

namespace Model\Managers;

use Model\Database;
use Model\Entities\Student;

class StudentManager
{
    private $students = [];

    public function addStudent(Student $student)
    {
        $this->students[] = $student;
    }

    public function getStudents(): array
    {
        return $this->students;
    }

    public function loadStudents()
    {
        $request = "SELECT
                        firstname,
                        lastname,
                        type, birth_date,
                        number, state,
                        Student.id id,
                        Classe.id id_classe,
                        Classe.label as classe,
                        Level.label as level,
                        Level.id as id_level
                        FROM
                            Student
                        JOIN Classe ON Classe.id = Student.id_classe
                        JOIN Level ON Level.id = Student.id_level";
                        
        $students = Database::getInstance()->request($request);

        foreach ($students as $student) {
            $studentObject = new Student(
                $student->id,
                $student->firstname,
                $student->lastname,
                $student->type,
                $student->number ?? -1,
                explode(' ', $student->birth_date)[0],
                $student->id_level,
                $student->id_classe,
                $student->state,
                $student->classe,
                $student->level
            );

            $this->addStudent($studentObject);
        }
    }

    public function insert($firstName, $lastName, $idLevel, $idClasse, $type, $birthDate)
    {
        $request = "INSERT INTO Student(firstname, lastname, id_level, id_classe, type, birth_date)
                    VALUES(?, ?, ?, ?, ?, ?)";
        $bindValues = [$firstName, $lastName, $idLevel, $idClasse, $type, $birthDate];
        return Database::getInstance()->request($request, $bindValues);
    }
}
