<?php

namespace App\Model\Database;

use Nette;

abstract class connectionDB {

    public $database;

    public function __construct(Nette\Database\Context $context) {
        $this->database = $context;
    }

    public function getDatabase() {
        return $this->database;
    }

}
