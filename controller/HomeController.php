<?php

class HomeController extends Controller
{
    public function start()
    {
        $this->middleware(["auth"]);
    }
    public function indexGet($args)
    {

        $userModel = $this->model("user");
        $titles = "Home";
        $list = [
            "Morocco",
            "France",
            "Spagne",
            "Italy",
            "Egypt"
        ];
        $this->render("home", [
            "title" => $titles,
            "list" => $userModel->all()
        ]);
    }
}
