<?php

    class HomeController extends Controller{
        public function __construct()
        {
           
        }

        public function index($args)
        {
            if(isset($args[0]))
            {
                $titles = $args[0];
                $list = [
                    "Morocco",
                    "France",
                    "Spagne",
                    "Italy",
                    "Egypt"
                ];       
                $this->render("home",[
                    "title"=>$titles,
                    "list"=>$list
                ]);
            }
            else{
                $this->pageNotFound();
            }
        }
    }