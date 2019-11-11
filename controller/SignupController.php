<?php
class SignupController extends Controller
{
    public function start()
    { }
    public function indexGet($args)
    {
        $this->render("signup");
    }
    public function indexPost($args)
    {
        $this->validate($_POST['username'],"string","Your username isn't valid");
        $this->validate($_POST['last_name'],"string","Your last name isn't valid");
        $this->validate($_POST['first_name'],"string","Your first name isn't valid");
        $this->validate($_POST['password'], "min:8", "Password must have more then 8 characters");

        if($_POST['password'] != $_POST['r_password'])
        {
            array_push($this->errors,"Your password doesn't match");
        }
        
        if(count($this->errors) <= 0){
            $userModel = $this->model("user");
            if($userModel->findByUsername($_POST["username"]))
            {
                array_push($this->errors,"Username '$_POST[username]' is already exist");
            }
            else{
                if($userModel->save($_POST))
                {
                    $this->render("signup",[
                        "success"=>["Your account has been created successfully"]
                    ]);
                }
            }
        }
        if(count($this->errors) > 0)
        {
            $this->render("signup",[
                "errors"=>$this->errors,
                "username"=>$_POST['username'],
                "last_name"=>$_POST['last_name'],
                "first_name"=>$_POST['first_name'],
            ]);
        }
    }
}
