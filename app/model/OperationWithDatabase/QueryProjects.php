<?php

namespace App\Model;

use Nette;
use App\Model\Database\connectionDB;

class QueryProjects extends connectionDB {

    public function getAllProjects() {
        $rows = $this->getDatabase()->table('project')->order('DatumOdevzdaniProjektu ASC')->fetchAll();
        return $rows;
    }

    public function insertProjectIntoDB($values) {
        $id = $this->getDatabase()->table('project')->insert(['NazevProjektu' => $values->nazevProjektu,
                    'DatumOdevzdaniProjektu' => Nette\Utils\DateTime::From($values->datumOdevzdaniProjektu)->format('Y.m.d'),
                    'TypProjektu' => $values->typprojektu,
                    'WebovyProjekt' => $values->webovyprojekt,
                ])->id;
        foreach ($values['users'] as $users) {
            foreach ($users as $person) {
                $this->getDatabase()->table('persononproject')->insert(['id_project' => $id, 'id_person' => $person]);
            }
        }
    }

    public function editProject($id, $values) {
        $row = $this->deleteProjectPodleId($id);
        if ($row) {
            $this->insertProjectIntoDB($values);
            return $row;
        }
        return false;
    }

    public function getProjectById($id) {
        $row = $this->getDatabase()->table('project')->get($id);
        return $row;
    }

    public function editProjectById($id, $values) {
        return $this->getDatabase()->table('project')->where('id', $id)->update([
                    'nazevProjektu' => $values->nazevProjektu,
                    'datumOdevzdaniProjektu' => $values->datumOdevzdaniProjektu,
                    'typprojektu' => $values->typprojektu,
                    'webovyprojekt' => $values->webovyprojekt,
        ]);
    }

    public function deleteProjectPodleId($id) {
        return $this->getDatabase()->table('project')->where('id', $id)->delete();
    }

    public function getAllPerson() {
        $polePerson = [];
        $row = $this->database->table('person');
        foreach ($row as $key => $person) {
            $polePerson[$person->id_person] = $person->name . " " . $person->surname;
        }
        return $polePerson;
    }

    public function getAllPersonOnProject() {
        $rows = $this->getDatabase()->table('persononproject')->fetchAll();
        return $rows;
    }

}
