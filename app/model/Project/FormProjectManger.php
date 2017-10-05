<?php

namespace App\Model\Project;

use Nette;
use Nette\Object;

class FormProjectManger extends Object {

    const CASOVE_OMEZENE = "Časově omezený projekt", CONTINOUS_INTEGRATION = "Continous integration";

    public function getTypProjektu() {
        return array(
            self::CASOVE_OMEZENE => "Časově omezený projekt",
            self::CONTINOUS_INTEGRATION => "Continous integration"
        );
    }

}
