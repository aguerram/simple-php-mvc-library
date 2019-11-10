<?php
class LoginController extends Controller
{
    public function start()
    {
        $this->middleware(["auth"]);
    }
    public function indexGet($args)
    {
        $this->render("login");
    }
    public function indexPost($args)
    {
        $this->validate($_POST['email'], "email","Your email isn't valid");
        $this->validate($_POST['password'], "min:8","Password isn't valid");
        if (count($this->errors) > 0) {
            $this->render("login",[
                "errors"=>$this->errors
            ]);
        }
        else{
            $userModel = $this->model("user");
            $userModel->login($_POST['email'],$_POST['password']);
        }
    }
}
