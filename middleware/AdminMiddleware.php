<?php

    class AdminMiddleware extends Middleware{
        public function __construct($request)
        {
            $this->checkGuard();
        }
        public function checkGuard()
        {
            if(isset($_SESSION['token']) && isset($_SESSION['id']))
            {   
                $userModel =  $this->model("user");

                $user = $userModel->findById($_SESSION['id']);

                if($user->is_admin == 0)
                {
                    die("You don't have permessions");
                }
            }
        }
    }