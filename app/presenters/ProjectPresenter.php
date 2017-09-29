<?php

namespace App\Presenters;

use Nette;
use Nette\Application\UI\Form;

class ProjectPresenter extends Nette\Application\UI\Presenter {

    private $queryProjects;

    /**
     * 
     * @var \App\Forms\IProjectFormFactory @inject
     */
    public $IprojectForm;
    public $parameter;

    public function __construct(\App\Model\QueryProjects $queryProjects ) {
        parent::__construct();
        $this->queryProjects = $queryProjects;
    }

    protected function createComponentProjectForm() {
        $control = $this->IprojectForm->create();
        $control->onProjectForm[] = function (\App\Forms\ProjectForm $projectForm, $values) {
            if (!$this->parameter) {
                $this->queryProjects->insertProjectIntoDB($values);
                $this->flashMessage("Váš projekt byl úspěšně vložen", 'sucess');
                $this->redirect('Project:');
            } else {
                $row = $this->queryProjects->editProjectById($this->parameter, $values);
                if ($row) {
                    $this->flashMessage("Project byl úspěčně upraven", 'sucess');
                } else {
                    $this->flashMessage("Tento projekt neexistuje", 'error  ');
                }
                $this->redirect('Project:');
            }
        };
        if ($this->parameter) {
            $row = $this->queryProjects->getProjectById($this->parameter);
            if ($row) {
                $control->actionEditovatProject($row);
            } else {
                $this->flashMessage('Tento projekt neexistuje', 'sucess');
                $this->redirect('Project:');
            }
        }
        return $control;
    }

    public function renderDefault() {
        $this->template->projects = $this->queryProjects->getAllProjects();
    }

    public function actionSmazatProject($id) {
        $row = $this->queryProjects->deleteProjectPodleId($id);
        if ($row) {
            $this->flashMessage("Project byl úspěčně smazan", 'sucess');
        } else {
            $this->flashMessage("Project nebyl úspěčně smazan", 'error');
        }
        $this->redirect('Project:');
    }

    public function actionEditProject($id) {
        $this->parameter = $id;
    }

}
