<?php

class App
{
    private $controller = "Home";
    private $method = "index";
    private $routes = [];
    private $url = "";
    public function __construct()
    {
        // print_r($_SERVER);
        if (!isset($_SERVER['QUERY_STRING'])) {
            throw new Exception("Bad Request");
        }
        $this->extractUrl();
        $this->initRoutes();
        $this->routeFetch();
    }
    /**
     * this method for extracting the requested url
     */
    private function extractUrl()
    {
        $url = substr($_SERVER['QUERY_STRING'], strpos($_SERVER['QUERY_STRING'], "=") + 1);
        $this->url = $url;
        echo $url;
        $urls = explode("/", $url);

        $urls_length = count($urls);
        if ($urls_length >= 2 || ($urls_length >= 1 && $urls[0] != "/")) {
            $this->controller = $urls[0];
            if ($urls_length >= 2 && $urls[1] != "") {
                $this->method = $urls[1];
            }
        }
    }

    private function routeFetch()
    {
        foreach ($this->routes as $key => $value) {
            if (strpos($key, "/") === 0) {
                $key = substr($key, 1);
            }
            if (strpos($key, "/") === strlen($key) - 1) {
                $key = substr($key, 0, strlen($key) - 1);
            }
            if ($key == $this->url) {
                $path = explode("@", $value['path']);
                $this->callFunction($path[0],  $path[1]);
                return;
            }
        }
        echo "<h1>Page not found 404.</h1>";
    }
    /**
     * This method for calling the controller and the method with the arguments
     */
    private function callFunction($controller, $method, $args = [])
    {
        $args['url'] = $_SERVER['QUERY_STRING'];
        $inst = new $controller();
        $inst->$method($args);
    }
    /**
     * This method for checking the syntaxe of routes file
     */
    private function initRoutes()
    {
        if (!file_exists("./routes/Route.php"))
            throw new Exception("Routes not found");
        $this->routes =  include("./routes/Route.php");
        foreach ($this->routes as $key => $value) {
            if (!isset($value['method']) || !isset($value['path']) || !strpos($value['path'],"@")>0) {
                throw new Exception("At route $key syntaxe is invalide");
            }
        }
    }
}
