<?php

namespace App\Forms;

use Nette;

interface IProjectFormFactory {

    /**
     * @return \App\Forms\ProjectForm
     */
    function create();
}
