<?php

namespace App\Forms;

use Nette;
use Nette\Object;

class ProjectForm extends Nette\Application\UI\Control{

    public $onProjectForm;

    public function setTypProjektu() {
        return array(
            "Časově omezený projekt" => "Časově omezený projekt",
            "Continous integration" => "Continous integration"
        );
    }

    public function createComponentProjectForm() {
        $form = new \Nette\Application\UI\Form();
        $form->addText('nazevProjektu', 'Zadejte nazev projektu prosím ')
                ->setRequired('Prosím vyplňte název projektu  ');
        $form->addText('datumOdevzdaniProjektu', 'Zadejte datum odevzdání projektu ve formátu d.m.y ')
                ->setRequired('Prosím vyplňte daturm projektu')
                ->addRule($form::PATTERN, 'Datum musí být ve formátu d.m.Y', '(0?[1-9]|[12][0-9]|3[01]).(0?[1-9]|1[012]).((19|20)\\d\\d)');
        $form->addSelect('typprojektu', 'Typ projektu', $this->setTypProjektu())
                ->setPrompt("Vyberte polozku")
                ->addRule($form::FILLED, "Prosím vyberte typ projektu");
        $form->elementPrototype->novalidate = 'novalidate';
        $form->addCheckbox('webovyprojekt', 'webovy projekt');
        $form->addSubmit('vlozProjekt', 'Vlozit projekt');
 
        $form->onSuccess[] = [$this, 'checkProjectForm'];
      
        return $form;
    }

    public function checkProjectForm($form, $values) {
        $this->onProjectForm($this, $values);
    }

    public function render() {
        $this['projectForm']->render();
    }
    public function actionEditovatProject($row) {    
            $this['projectForm']->setValues([
            'nazevProjektu' => $row->NazevProjektu,
            'datumOdevzdaniProjektu' => $row->DatumOdevzdaniProjektu,
            'typprojektu' => $row->TypProjektu,
            'webovyprojekt' => $row->WebovyProjekt
        ]);
    }
}
