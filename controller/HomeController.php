<?php

    class HomeController extends Controller{
        public function __construct()
        {
           
        }

        public function index($args)
        {
            if(isset($args[0]))
            {
                $userModel = $this->model("user");
                echo $userModel->create([
                    "nom"=>"Mostafa",
                    "id"=>5
                ]);
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
                    "list"=>$userModel->all()
                ]);
            }
            else{
                $this->pageNotFound();
            }
        }
    }