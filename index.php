    <?php


    define("CONTROLLER_DIR", "./controller");
    
    session_start();

    require("./utils/Utils.php");

    require("./app/App.php");

    require("./app/Validate.php");

    require("./app/BaseInstace.php");

    require("./app/Model.php");

    require("./app/Middleware.php");

    require("./app/Controller.php");

    require('./config/env.php');

    require('./config/functions.php');
    
    $list = scandir("./controller");
    if (count($list) <= 2) {
        throw new Exception("No Controller is defined");
    }
    foreach ($list as $file) {
        if ($file !== "." && $file !== "..") {
            include CONTROLLER_DIR . "/" . $file;
        }
    }

    //to initialize env variabels from .env
    $env = new ENV();

    //to initialize the application
    try {
        $app = new App();
    } catch (Exception $ex) {
        if ($env->get("DEV") == true) {
            $app = new App();
        }
    }