<?php

class App
{
    private $controller = "home";
    private $method = "index";
    private $args = [];
    private $url = "";
    public function __construct()
    {
        // print_r($_SERVER);
        if (!isset($_SERVER['QUERY_STRING'])) {
            throw new Exception("Bad Request");
        }
        $this->extractUrl();
        $this->routeFetch();
    }
    /**
     * this method for extracting the requested url
     */
    private function extractUrl()
    {
        $url = substr($_SERVER['QUERY_STRING'], strpos($_SERVER['QUERY_STRING'], "=") + 1);
        $this->url = $url;
        $urls = explode("/", $url);

        $urls_length = count($urls);
        if ($urls_length >= 2 || ($urls_length >= 1 && $urls[0] != "")) {
            $this->controller = $urls[0];
            if ($urls_length >= 2 && $urls[1] != "") {
                $this->method = $urls[1];
                //That means there are arguments in the array
                if ($urls_length > 2) {
                    foreach (array_slice($urls, 2) as $arg) {
                        $clean_arg = trim($arg);
                        if (strlen($clean_arg) > 0) {
                            array_push($this->args, trim($clean_arg));
                        }
                    }
                }
            }
        }
    }

    private function routeFetch()
    {

        if ($this->checkExistController()) {
            $this->callFunction($this->args);
        } else {
            echo "<h1>Page not found 404.</h1>";
        }
    }

    /**
     * This method checks if the given controller is exist
     * @return boolean, true if controller exists other ways false
     */
    private function checkExistController()
    {
        $controller = $this->getController().".php";
        if (!file_exists("./controller/" . $controller)) {
            return false;
        }
        return true;
    }
    /**
     * this method returns the controller in class format 
     * example : home => HomeController
     */
    private function getController()
    { 
        return ucfirst($this->controller)."Controller";
    }
    /**
     * This method for calling the controller and the method with the arguments
     */
    private function callFunction($args = [])
    {
        $_controller = $this->getController();
        $method = $this->method;
        $inst = new $_controller();
        $inst->$method($args);
    }
}
