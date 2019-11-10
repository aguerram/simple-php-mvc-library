<?php

/**
 * This is the base controller, you should call a controller that extends 
 * this controller.
 * NOTE: when calling routes add the method at the end, like : indexGet, loginPost
 */
class Controller extends BaseInstance
{
    /**
     * This method renders the given page located in views folder
     * example render('errors/404',$argsList)
     * NOTE : don't add .php at the end, this method will add it automaticly
     * 
     */

    public $request;

    public final function __construct($request)
    {
        $this->request = $request;
        $this->start();
    }

    protected function render($view, $args = [])
    {
        if (!file_exists("./views/$view.php"))
            throw new Exception("$view view not exist.");

        if (count($args) > 0) {
            extract($args);
            ob_start();
        }
        include "./views/$view.php";
    }
    /**
     * This method used to call a middleware
     * @param middlewares is an array of arrays of middleware name as a key 
     * that will be excepted from the middleware.
     * example : ["auth"=>"indexGet","loginPost"]
     */
    protected function middleware($middlewares = [])
    {
        foreach ($middlewares as $key => $midl) {
            if (is_numeric($key))
                $key = $midl;
            $Midl = ucfirst($key) . "Middleware";
            if (!file_exists("./middleware/$Midl.php"))
                throw new Exception("Middleware '$key' not exist, if your calling this class for __construct, you should consider using start method insead.");
            require_once("middleware/$Midl.php");
            if (!is_numeric($key)) {
                if (is_array($midl))
                    foreach ($midl as $route) {
                        if (strtolower($route) == strtolower($this->request->function))
                            return;
                    } else 
                if (strtolower($midl) == strtolower($this->request->function))
                    return;
            }
            $inst = new $Midl($this->request);
        }
    }
    /**
     * This method will be called when the controller started
     * It's better to use this method insead of a constructure
     */
    protected function start()
    { }
    public function pageNotFound()
    {
        $this->render("errors/404");
    }
}
