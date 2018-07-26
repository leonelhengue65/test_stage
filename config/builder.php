<?php

require __DIR__ . '/../config/dependanceInjection.php';

require __DIR__ . '/../class/generator/BackendGenerator.php';
require __DIR__ . '/../class/generator/android/BackendGeneratorJava.php';
require __DIR__ . '/../class/generator/FrontendGenerator.php';
require __DIR__ . '/../class/generator/rootGenerator.php';
require __DIR__ . '/../class/generator/RequestGenerator.php';
require __DIR__ . '/../class/generator/Traitement.php';
require __DIR__ . '/../class/generator/template/Templatedependences.php';
require __DIR__ . '/../class/generator/__Generator.php';
require __DIR__ . '/../class/generator/android/__Generatorjava.php';

require __DIR__ . '/../src/devups/ModuleAdmin/Entity/Dvups_module.php';
require __DIR__ . '/../src/devups/ModuleAdmin/Entity/Dvups_role.php';
require __DIR__ . '/../src/devups/ModuleAdmin/Entity/Dvups_right.php';
require __DIR__ . '/../src/devups/ModuleAdmin/Entity/Dvups_entity.php';
require __DIR__ . '/../src/devups/ModuleAdmin/Entity/Dvups_role_dvups_entity.php';
require __DIR__ . '/../src/devups/ModuleAdmin/Entity/Dvups_role_dvups_module.php';
require __DIR__ . '/../src/devups/ModuleAdmin/Entity/Dvups_right_dvups_entity.php';

$backend = new BackendGeneratorJava();
$frontend = new FrontendGenerator();
$rootgenerate = new RootGenerator();
$database = new RequestGenerator();
$traitement = new Traitement();

$module_entities = [];

function getproject($namespace) {
    // get all components building the global project
    $components = Core::buildOriginCore();

    $ns = explode("\\", $namespace);
    return __Generator::findproject($components, $ns[0]);
}

function getcomponent($namespace) {
    // get all components building the global project
    $components = Core::getComponentCore();

    $ns = explode("\\", $namespace);
    return __Generator::findproject($components, $ns[0]);
}

$project = null;
if (isset($argv[2])) {
    $project = getproject($argv[2]);

    chdir('src/' . $project->name);

    switch ($argv[1]) {

        case 'core:g:views':
            __Generator::views($argv[2], $project); //, 
            echo $argv[2] . ": Views generated with success";
            break;

        case 'core:g:genesis':
            __Generator::genesis($argv[2], $project); //, 
            echo $argv[2] . ": Genesis generated with success";
            break;

        case 'core:g:controller':
            __Generator::controller($argv[2], $project); //, 
            echo $argv[2] . ": Controller generated with success";
            break;

        case 'core:g:form':
            __Generator::form($argv[2], $project); //, 
            echo $argv[2] . ": Form generated with success";
            break;

        case 'core:g:formwidget':
            __Generator::formwidget($argv[2], $project); //,
            echo $argv[2] . ": Form widget generated with success";
            break;

        case 'core:g:viewswidget':
            __Generator::detailwidget($argv[2], $project); //,
            echo $argv[2] . ": Detail widget generated with success";
            break;

        case 'core:g:entity':
            if(isset($argv[3])){
                if(isset($argv[4])){
                    __Generatorjava::entity($argv[2], $project, $argv[4]); //,$argv[4] for package
                    echo $argv[2] . ": Entity java generated with success";
                }else
                    echo "warning: package missing!";
            }else{
                __Generator::entity($argv[2], $project); //,
                echo $argv[2] . ": Entity generated with success";
            }
            break;

        case 'core:g:crud':
            if(isset($argv[3])){
                if(isset($argv[4])){
                    __Generatorjava::crud($argv[2], $project, $argv[4]); //,$argv[4] for package
                    echo $argv[2] . ": Entity java generated with success";
                }else
                    echo "warning: package missing!";
            }else {
                __Generator::crud($argv[2], $project); //,
                echo $argv[2] . ": CRUD generated with success";
            }
            break;

        case 'core:g:module':
            __Generator::module($project, $argv[2]); //, 
            echo $argv[2] . ": Module generated with success";
            break;

        case 'core:g:moduleendless':
            __Generator::__moduleendless($project, $argv[2]); //, 
            echo $argv[2] . ": Moduleendless generated with success";
            break;

        case 'core:g:moduleservices':
            __Generator::__services($project, $argv[2]); //,
            echo $argv[2] . ": Services generated with success";
            break;

        case 'core:g:component':
            __Generator::component(Core::getComponentCore($argv[2])); //, 
            echo $project->name . ": component generated with success";
            break;

        default :
            __Generator::help();
            break;
    }

    chdir('../../');
} else {

    switch ($argv[1]) {

        case 'install':
            RequestGenerator::databasecreate(dbname); //, 
             echo " > Creating Database.\n\n". dbname . ": created with success ...\n";
            $result = [];
            exec("bin\doctrine orm:schema:create", $result);

            echo "\n > Update database schema (DOCTRINE ORM).\n\n" . implode("\n", $result);
            
            $rqg = new DBAL();
            $path = __DIR__ . '/../class/generator/dvupsadmin.sql';
            $dvupsadminsql = file_get_contents($path);
            $rqg->executeDbal($dvupsadminsql);
            
            echo "\n\n > Set the master admin.\n\nData master admin initialized with success.\ncredential\nlogin: admin\npassword: admin\n\nYour project is ready to use. Do your best :)";
            break;

        case 'database:create':
            RequestGenerator::databasecreate(dbname); //, 
            $result = [];
            exec("bin\doctrine orm:schema:create", $result);

            echo dbname . ": created with success\n\n " . implode("\n", $result);
            break;

        case 'dvups_:admin':
            $rqg = new DBAL();
            $path = __DIR__ . '/../class/generator/dvupsadmin.sql';
            $dvupsadminsql = file_get_contents($path);
            $rqg->executeDbal($dvupsadminsql);
            echo "Data admin initialized with success";
            break;

        case 'dvups_:implement':
            Core::updateDvupsTable();
            echo "Data admin updated with success";
            break;

        case 'dvups_:update':
            if (Core::updateDvupsTable())
                echo "Data admin updated with success";
            else
                echo "Data admin already uptodate";
            break;

        default :
            __Generator::help();
            break;
    }
}

echo "\n";



