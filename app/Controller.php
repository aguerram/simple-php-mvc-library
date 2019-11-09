<?php
    class Controller {
        protected function render($view,$args=[])
        {
            if(!file_exists("./views/$view.php"))
                throw new Exception("$view view not exist.");

            if(count($args)>0)
            {
                extract($args);
                ob_start();
            }
            include "./views/$view.php";
        }
    }