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
        $this->errorsController = new Controller($this->getRequest());
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
    /**
     * This method calls wanted url depending on fetched controller and method
     * and passes the rest of the url as arguments
     * */
    private function routeFetch()
    {
        //If controller exist call it other ways return page not found
        if ($this->checkExistController()) {
            $this->callFunction($this->args);
        } else {
            $this->errorsController->pageNotFound();
        }
    }

    /**
     * This method checks if the given controller is exist
     * @return boolean, true if controller exists other ways false
     */
    private function checkExistController()
    {
        $controller = $this->getController() . ".php";
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
        return ucfirst($this->controller) . "Controller";
    }
    /**
     * This method for calling the controller and the method with the arguments
     */
    private function callFunction($args = [])
    {
        
        $_controller = $this->getController();
        $method = $this->method."". ucwords($_SERVER['REQUEST_METHOD']);
        $inst = new $_controller($this->getRequest());
        
        $inst->$method($args);
    }
    /**
     * This method will return a request object that contains 
     * some of knonw methods
     */
    private function getRequest()
    {
        $request = new stdClass;
        $request->url=$this->controller;
        $request->method=strtolower($_SERVER['REQUEST_METHOD']);
        $request->function = $this->method."". ucwords($_SERVER['REQUEST_METHOD']);
        return $request;
    }
}
