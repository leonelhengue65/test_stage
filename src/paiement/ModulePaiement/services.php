<?php
            //ModulePaiement
		
        require '../../../admin/header.php';
        
// verification token
//

        use Genesis as g;
        use Request as R;
        
        header("Access-Control-Allow-Origin: *");
                

		$agregateurCtrl = new AgregateurController();
		
     (new Request('hello'));

     switch (R::get('path')) {
                
        case 'agregateur._new':
                AgregateurForm::render();
                break;
        case 'agregateur.create':
                g::json_encode($agregateurCtrl->createAction());
                break;
        case 'agregateur._edit':
                AgregateurForm::render(R::get("id"));
                break;
        case 'agregateur.update':
                g::json_encode($agregateurCtrl->updateAction(R::get("id")));
                break;
        case 'agregateur._show':
                $agregateurCtrl->detailView(R::get("id"));
                break;
        case 'agregateur._delete':
                g::json_encode($agregateurCtrl->deleteAction(R::get("id")));
                break;
        case 'agregateur._deletegroup':
                g::json_encode($agregateurCtrl->deletegroupAction(R::get("ids")));
                break;
        case 'agregateur.datatable':
                g::json_encode($agregateurCtrl->datatable(R::get('next'), R::get('per_page')));
                break;

	
        default:
            g::json_encode(['success' => false, 'error' => ['message' => "404 : action note found", 'route' => R::get('path')]]);
            break;
     }

