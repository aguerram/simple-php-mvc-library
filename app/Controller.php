<?php
    class Controller {
        /**
         * This method renders the given page located in views folder
         * example render('errors/404',$argsList)
         * NOTE : don't add .php at the end, this method will add it automaticly
         * 
         */
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

        protected function env($path)
        {
            global $env;
            return $env->get($path);
        }

        public function pageNotFound()
        {
            $this->render("errors/404");
        }


    }