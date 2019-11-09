<?php
    define("CONTROLLER_DIR","./controller");

    require("./app/App.php");

    require("./app/Controller.php");
    
    require('./config/env.php');
    $list = scandir("./controller");
    if(count($list)<=2)
    {
        throw new Exception("No Controller is defined");
    }
    foreach ($list as $file) {
        if($file !== "." && $file !== "..")
        {
            include CONTROLLER_DIR."/".$file;
        }
    }

    //to initialize env variabels from .env
    $env = new ENV();

    //to initialize the application
    $app = new App();
