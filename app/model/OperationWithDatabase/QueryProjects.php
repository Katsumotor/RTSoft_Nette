<?php

namespace App\Model;

use Nette;
use App\Model\Database\connectionDB;

class QueryProjects extends connectionDB {

    public function getTableProject() {
        return $this->getDatabase()->table('project')->order('DatumOdevzdaniProjektu ASC');
    }

    public function getTablePersonOnProject() {
        return $this->getDatabase()->table('persononproject');
    }

    public function getAllProjects() {
        /** $rows = $this->getDatabase()->query("SELECT project.*,person.* FROM project LEFT JOIN persononproject ON project.id=persononproject.id_project LEFT JOIN person ON person.id_person=persononproject.id_person"); */
        $rows = $this->getTableProject()->fetchAll();
        return $rows;
    }

    public function insertProjectIntoDB(Nette\Utils\ArrayHash $values) {
        /**
         * $id = $this->getDatabase()->query('INSERT INTO project',[
         * 'NazevProjektu' => $values->nazevProjektu,
          'DatumOdevzdaniProjektu' => Nette\Utils\DateTime::From($values->datumOdevzdaniProjektu)->format('Y.m.d'),
          'TypProjektu' => $values->typprojektu,
          'WebovyProjekt' => $values->webovyprojekt
         * ];
         */
        $id = $this->getTableProject()->insert([
                    'NazevProjektu' => $values->nazevProjektu,
                    'DatumOdevzdaniProjektu' => Nette\Utils\DateTime::From($values->datumOdevzdaniProjektu)->format('Y.m.d'),
                    'TypProjektu' => $values->typprojektu,
                    'WebovyProjekt' => $values->webovyprojekt,
                ])->id;
        foreach ($values['users'] as $users) {
            foreach ($users as $person) {
                if ($person != null) {
                    $this->getTablePersonOnProject()->insert(['id_project' => $id, 'id_person' => $person]);
                }
            }
        }
    }

    public function editProject(int $id, Nette\Utils\ArrayHash $values) {
        $row = $this->deleteProjectPodleId($id);
        if ($row) {
            $this->insertProjectIntoDB($values);
            return $row;
        }
        return false;
    }

    public function getProjectById(int $id) {
        $row = $this->getTableProject()->get($id);
        return $row;
    }

    public function editProjectById(int $id, Nette\Utils\ArrayHash $values) {
        return $this->getTableProject()->where('id', $id)->update([
                    'nazevProjektu' => $values->nazevProjektu,
                    'datumOdevzdaniProjektu' => $values->datumOdevzdaniProjektu,
                    'typprojektu' => $values->typprojektu,
                    'webovyprojekt' => $values->webovyprojekt,
        ]);
    }

    public function deleteProjectPodleId(int $id) {
        /** $rows = $this->database->query("DELETE FROM project WHERE id=?,$id"); */
        return $this->getTableProject()->where('id', $id)->delete();
    }

    public function getAllPerson() {
        $polePerson = [];
        $row = $this->database->table('person');
        foreach ($row as $key => $person) {
            $polePerson[$person->id_person] = $person->name . " " . $person->surname;
        }
        return $polePerson;
    }

    public function getCountPersonInDB() {
        $row = $this->database->table('person')->count('*');
        return $row;
    }

    public function getAllPersonOnProject() {
        $rows = $this->getTablePersonOnProject()->fetchAll();
        return $rows;
    }

}
