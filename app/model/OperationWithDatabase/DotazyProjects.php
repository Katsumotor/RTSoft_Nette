<?php

namespace App\Model\OperationWithDatabase;

use Nette;
use App\Model\Database\connectionDB;

class DotazyProjects extends connectionDB {

    public function VypisProjekty() {
        $rows = $this->getDatabase()->table('project');
        return $rows;
    }

    public function vlozHodnotyDoDB($hodnoty) {
        $this->getDatabase()->table('project')->insert($hodnoty);
    }

    public function vratProjectPodleId($id) {
        return $this->getDatabase()->table('project')->get($id);
    }

    public function upravProjectPodleId($id, $values) {
        $this->getDatabase()->table('project')->where('id', $id)->update([
            'nazevProjektu' => $values->nazevProjektu,
            'datumOdevzdaniProjektu' => $values->datumOdevzdaniProjektu,
            'typprojektu' => $values->typprojektu,
            'webovyprojekt' => $values->webovyprojekt,
        ]);
    }

    public function deleteProjectPodleId($id){
    $this->getDatabase()->table('project')->where('id',$id)->delete();
    }
}
