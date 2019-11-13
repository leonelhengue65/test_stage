<?php 


use DClass\devups\Datatable as Datatable;

class AgregateurTable extends Datatable{
    
    public $entity = "agregateur";

    public $datatablemodel = [
['header' => 'Nom', 'value' => 'nom'], 
['header' => 'Reference', 'value' => 'reference']
];

    public function __construct($lazyloading = null, $datatablemodel = [])
    {
        parent::__construct($lazyloading, $datatablemodel);
    }

    public static function init($lazyloading = null){
        $dt = new AgregateurTable($lazyloading);
        return $dt;
    }

    public function buildindextable(){

        // TODO: overwrite datatable attribute for this view

        return $this;
    }
    
    public function builddetailtable()
    {
        $this->datatablemodel = [
['label' => 'Nom', 'value' => 'nom'], 
['label' => 'Reference', 'value' => 'reference']
];
        // TODO: overwrite datatable attribute for this view
        return $this;
    }

}
