<?php
    class AuthMiddleware extends Middleware
    {
        public function __construct($request)
        {
            if($request->url == "login")
            {
                if($this->isLoggedIn())
                {
                    $this->redirect("/home");
                }
            }
            else{
                $this->redirect("/login");
            }
        }
        private function isLoggedIn()
        {
            if(isset($_SESSION['token']))
            {
                return true;
            }
        }
    }