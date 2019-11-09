<?php

    class HomeController extends Controller{
        public function __construct()
        {
           
        }

        public function index($args)
        {
            $title = "Page title | $args[0]";
            $list = [
                "Morocco",
                "France",
                "Spagne",
                "Italy",
                "Egypt"
            ];       
            $this->render("home",[
                "title"=>$title,
                "list"=>$list
            ]);
        }
    }