<?php

namespace App\Forms;

use Nette;
use Nette\Forms\Container;

class ProjectForm extends Nette\Application\UI\Control {

    public $onProjectForm;
    public $queryProjects;
    public $id;

    public function __construct(\App\Model\QueryProjects $queryProjects) {
        parent::__construct();
        $this->queryProjects = $queryProjects;
    }

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

        $users = $form->addDynamic('users', function (Container $user) {
            $user->addSelect('name', 'Zadejte účastníka na projektu', $this->queryProjects->getAllPerson())
                    ->setPrompt("")
                    ->setRequired()
                    ->addRule(\App\Model\Validator::ISALREADYSELECTPERSON, 'Tento pracovník je jíž v seznamu', $this['projectForm']['users']->getValues());
            $user->addSubmit('remove', 'Odebrat pracovníka')
                    ->addRemoveOnClick();
        }, 0);

        $users->addSubmit('add', 'Přidat pracovníka')
                ->addCreateOnClick();
        $form->addSubmit('vlozProjekt', 'Vlozit projekt');
        $form->onSuccess[] = array($this, 'checkProjectForm');
        return $form;
    }

    public function checkProjectForm(Nette\Application\UI\Form $form, \Nette\Utils\ArrayHash $values) {
        $this->onProjectForm($this, $values);
    }

    public function loadDataIntoForm() {
        $row = $this->queryProjects->getProjectById($this->id);
        if ($row) {
            $form = $this['projectForm'];
            if (!$form->isSubmitted()) {
                $form->setValues([
                    'nazevProjektu' => $row->NazevProjektu,
                    'datumOdevzdaniProjektu' => Nette\Utils\DateTime::From($row->DatumOdevzdaniProjektu)->format('d.m.Y'),
                    'typprojektu' => $row->TypProjektu,
                    'webovyprojekt' => $row->WebovyProjekt
                ]);
                foreach ($row->related('persononproject') as $person) {
                    $form['users'][$person->id_person]->setValues(['name' => $person->id_person]);
                }
            }
            return true;
        }
        return false;
    }

    public function render() {
        if ($this->id != null) {
            if ($this->loadDataIntoForm()) {
                $this['projectForm']->render();
            }
        } else {
            $this['projectForm']->render();
        }
    }

}
