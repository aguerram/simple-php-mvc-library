<?php
class LoginController extends Controller
{
    public function start()
    {
        $this->middleware(["auth"=>["logoutget"]]);
    }
    public function indexGet($args)
    {
        $this->render("login");
    }
    public function indexPost($args)
    {
        $this->validate($_POST['username']);
        $this->validate($_POST['password'], "min:8", "Password isn't valid");
        if (count($this->errors) > 0) {
            $this->render("login", [
                "errors" => $this->errors,
                "username" => $_POST['username']
            ]);
        } else {
            $userModel = $this->model("user");
            $user = $userModel->login($_POST['username'], $_POST['password']);
            if (!$user) {
                $this->render("login", [
                    "errors" => ["Username or password aren't correct"],
                    "username" => $_POST['username']
                ]);
            } else {
                $token = Utils::generateRandomString(64);
                $userModel->update(["token" => $token], "id = $user->id");
                $_SESSION['token'] = $token;
                $_SESSION['id'] =  $user->id;
                $this->redirect("/");
            }
        }
    }
    public function logoutGet()
    {
        unset($_SESSION['token']);
        unset($_SESSION['id']);
        $this->redirect("/login");
    }
}
