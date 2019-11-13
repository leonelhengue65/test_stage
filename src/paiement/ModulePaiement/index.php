<?php
            //ModulePaiement
        
        require '../../../admin/header.php';
        
// move comment scope to enable authentication
if (!isset($_SESSION[ADMIN]) and $_GET['path'] != 'connexion') {
    header("location: " . __env . 'admin/login.php');
}

        global $viewdir, $moduledata;
        $viewdir[] = __DIR__ . '/Ressource/views';
        
$moduledata = Dvups_module::init('ModulePaiement');
                


    
        define('CHEMINMODULE', ' ');

    
        		$agregateurCtrl = new AgregateurController();
		

(new Request('layout'));

switch (Request::get('path')) {

    case 'layout':

        Genesis::renderView("overview",$agregateurCtrl->listAgregateur());
        break;

    case 'agregateur/index':
        $agregateurCtrl->listView();
        break;
    case 'route/index':
        $agregateurCtrl->route(Request::get("route"));
        break;
		
    default:
        Genesis::renderView('404', ['page' => Request::get('path')]);
        break;
}
    
    