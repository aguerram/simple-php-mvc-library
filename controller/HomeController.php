<?php

    class HomeController extends Controller{
        public function __construct()
        {
           
        }
        public function index($args)
        {
            $title = "Page title";
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