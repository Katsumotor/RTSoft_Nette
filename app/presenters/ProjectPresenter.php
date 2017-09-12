<?php

namespace App\Presenters;

use Nette;

use Nette\Application\UI\Form;
use App\Model\Project\FormProjectManger;
use App\Model\OperationWithDatabase\DotazyProjects;

class ProjectPresenter extends Nette\Application\UI\Presenter {
    
    private $formProjectManger;
    private $operaceDBProject;
    
public function __construct(FormProjectManger $formProjectManger, DotazyProjects $operaceDBProject) {
        parent::__construct();
        $this->formProjectManger =$formProjectManger;
        $this->operaceDBProject = $operaceDBProject;
    }
  
       protected function createComponentZadaniProjektu() {
        $form = new Form;
        $form->addText('nazevProjektu', 'Zadejte nazev projektu  ')
              ->setRequired('Prosím vyplňte název projektu  ');
        $form->addText('datumOdevzdaniProjektu','Zadejte datum odevzdání projektu ve formátu d.m.y ')
              ->setRequired('Prosím vyplňte daturm projektu')
              ->addRule($form::PATTERN,'Datum musí být ve formátu d.m.Y','(0?[1-9]|[12][0-9]|3[01]).(0?[1-9]|1[012]).((19|20)\\d\\d)');
       $form->addSelect('typprojektu', 'Typ projektu', $this->formProjectManger->getTypProjektu())
               ->setPrompt("Vyberte polozku")
               ->addRule($form::FILLED, "Prosím vyberte typ projektu");
       
       $form->addCheckbox('webovyprojekt','webovy projekt');

       
       $form->addSubmit('vlozProjekt','Vlozit projekt');
       $form->onSuccess[] = [$this,'kontrolaZadaniProjektu'];
       return $form;
       
    }  
    
public function renderDefault(){
    $this->template->projects = $this->operaceDBProject->VypisProjekty();
}

public function kontrolaZadaniProjektu($form,$values){
    $parametr = $this->getParameter('id');
    
if(!$parametr){ 
    $this->operaceDBProject->vlozHodnotyDoDB($values);
    $this->flashMessage("Váš projekt byl úspěšně vložen",'sucess');
    $this->redirect('Project:');
}else{
 
    $this->operaceDBProject->upravProjectPodleId($parametr, $values);
    $this->flashMessage("Project byl úspěčně upraven",'sucess');
    $this->redirect('Project:');
}
}

public function actionEditovatProject($id){
    $row = $this->operaceDBProject->vratProjectPodleId($id);
    $this['zadaniProjektu']->setDefaults([
                'nazevProjektu'=>$row->NazevProjektu,
        'datumOdevzdaniProjektu'=>$row->DatumOdevzdaniProjektu,
        'typprojektu'=>$row->TypProjektu,
        'webovyprojekt'=>$row->WebovyProjekt,
    ]);
}

public function actionSmazatProject($id){   
    $row = $this->operaceDBProject->deleteProjectPodleId($id);
if($row){
     $this->flashMessage("Project byl úspěčně smazan",'sucess');
    $this->redirect('Project:');
}else{
  $this->flashMessage("Project nebyl úspěčně smazan",'error');
    $this->redirect('Project:');   
}   

}

}
