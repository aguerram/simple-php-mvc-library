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
        $this->validate($_POST['email'], "email", "Your email isn't valid");
        $this->validate($_POST['password'], "min:8", "Password isn't valid");
        if (count($this->errors) > 0) {
            $this->render("login", [
                "errors" => $this->errors,
                "email" => $_POST['email']
            ]);
        } else {
            $userModel = $this->model("user");
            $user = $userModel->login($_POST['email'], $_POST['password']);
            if (!$user) {
                $this->render("login", [
                    "errors" => ["Email or password aren't correct"],
                    "email" => $_POST['email']
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
}
