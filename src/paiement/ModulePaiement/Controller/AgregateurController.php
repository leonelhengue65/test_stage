<?php 


use DClass\devups\Datatable as Datatable;

class AgregateurController extends Controller{

    public function listView($next = 1, $per_page = 10){

        $lazyloading = $this->lazyloading(new Agregateur(), $next, $per_page);

        self::$jsfiles[] = Agregateur::classpath('Ressource/js/agregateurCtrl.js');

        $this->entitytarget = 'Agregateur';
        $this->title = "Manage Agregateur";
        
        $this->renderListView(AgregateurTable::init($lazyloading)->buildindextable()->render());

    }

    public function datatable($next, $per_page) {
        $lazyloading = $this->lazyloading(new Agregateur(), $next, $per_page);
        return ['success' => true,
            'datatable' => AgregateurTable::init($lazyloading)->buildindextable()->getTableRest(),
        ];
    }

    public function createAction($agregateur_form = null){
        extract($_POST);

        $agregateur = $this->form_fillingentity(new Agregateur(), $agregateur_form);
 

        if ( $this->error ) {
            return 	array(	'success' => false,
                            'agregateur' => $agregateur,
                            'action' => 'create', 
                            'error' => $this->error);
        }
        
        $id = $agregateur->__insert();
        return 	array(	'success' => true,
                        'agregateur' => $agregateur,
                        'tablerow' => AgregateurTable::init()->buildindextable()->getSingleRowRest($agregateur),
                        'detail' => '');

    }

    public function updateAction($id, $agregateur_form = null){
        extract($_POST);
            
        $agregateur = $this->form_fillingentity(new Agregateur($id), $agregateur_form);

                    
        if ( $this->error ) {
            return 	array(	'success' => false,
                            'agregateur' => $agregateur,
                            'action_form' => 'update&id='.$id,
                            'error' => $this->error);
        }
        
        $agregateur->__update();
        return 	array(	'success' => true,
                        'agregateur' => $agregateur,
                        'tablerow' => AgregateurTable::init()->buildindextable()->getSingleRowRest($agregateur),
                        'detail' => '');
                        
    }
    

    public function detailView($id)
    {

        $this->entitytarget = 'Agregateur';
        $this->title = "Detail Agregateur";

        $agregateur = Agregateur::find($id);

        $this->renderDetailView(
            AgregateurTable::init()
                ->builddetailtable()
                ->renderentitydata($agregateur)
        );

    }
    
    public function deleteAction($id){
      
            Agregateur::delete($id);
        return 	array(	'success' => true, 
                        'detail' => ''); 
    }
    

    public function deletegroupAction($ids)
    {

        Agregateur::delete()->where("id")->in($ids)->exec();

        return array('success' => true,
                'detail' => ''); 

    }
    public function listAgregateur(){
        return array(
            'success'=>true,
            'agregateurs'=>Agregateur::all('nom')
        ) ;
    }


    public function route($agregateur){
        ob_start();
        switch ($agregateur){
            case 'monetbil':
                $this->monetbil();
                break;
        }
        $a=array(
            'contenu'=>ob_get_clean(),
        );
        Genesis::renderView("agregateur.template",$a);
    }


    public function monetbil(){
        Genesis::renderView("agregateur.monetbil");
    }

}
