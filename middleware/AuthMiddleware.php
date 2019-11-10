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
                if(!$this->isLoggedIn())
                {
                    $this->redirect("/login");
                }
            }
        }
        private function isLoggedIn()
        {
            if(isset($_SESSION['token']) && isset($_SESSION['id']))
            {
                $userModel = $this->model("user");

                $id = $_SESSION['id'];
                $user = $userModel->findById($id);
                if($user && $user->token == $_SESSION['token'])
                {
                    return true;
                }
                return false;
            }
            else{
                return false;
            }
        }
    }