<?php

namespace App\Model;

use Nette;

class Validator {

    const ISALREADYSELECTPERSON = 'App\Model\Validator::isAlreadySelectPerson';

    public static function isAlreadySelectPerson(\Nette\Forms\IControl $control, $values) {
        $pole = [];
        foreach ($values as $key => $value) {
            foreach ($value as $key => $idPerson) {
                array_push($pole, $idPerson);
            }
        }
        if (count($pole) != count(array_unique($pole))) {
            return false;
        }
        return true;
    }

}
