<?php

global $_start;
$_start = microtime(true);

require __DIR__ . '/header.php';

use Genesis as g;
use paiement\ModulePaiement\Controller\MonetbilController;
use Request as R;

header("Access-Control-Allow-Origin: *");

$agrCtrl= new AgregateurController();

(new Request('hello'));

switch (Request::get('path')) {

    case 'test.webservice':
        g::json_encode(MonetbilController::key());
        break;

    default :
        g::json_encode(["success" => false, "message" => "404 :".Request::get('path')." page note found"]);
        break;
}
