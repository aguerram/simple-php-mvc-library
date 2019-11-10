<?php
    class LoginController extends Controller{
        public function start()
        {
            $this->middleware(["auth"]);
        }
        public function indexGet($args)
        {
            $this->render("login");
        }
    }