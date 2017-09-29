<?php

namespace App\Model;

use Nette;
use App\Model\Database\connectionDB;

class QueryProjects extends connectionDB {

    public function getAllProjects() {
        $rows = $this->getDatabase()->table('project');
        return $rows;
    }

    public function insertProjectIntoDB($hodnoty) {
        $this->getDatabase()->table('project')->insert($hodnoty);
    }

    public function getProjectById($id) {
        return $this->getDatabase()->table('project')->get($id);
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

}
