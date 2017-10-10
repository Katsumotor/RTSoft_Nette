<?php

namespace App\Model;

use Nette;

class Validator {

    const ISALREADYSELECTPERSON = 'App\Model\Validator::isAlreadySelectPerson';

    public static function isAlreadySelectPerson(\Nette\Forms\IControl $control, array $values) {
        $count = 0;
        foreach ($values[0] as $key => $value) {
            foreach ($value as $key => $idPerson) {
                if ($idPerson == $values[1]->name) {
                    $count++;
                    if ($count == 2) {
                        return false;
                    }
                }
            }
        }
        return true;
    }

}
