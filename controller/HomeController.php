<?php

    class HomeController extends Controller{
        public function indexGet($args)
        {
            if(isset($args[0]))
            {
                $userModel = $this->model("user");
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