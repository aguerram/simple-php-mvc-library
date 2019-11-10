<?php

/**
 * This class extended by middleware and controller, for shared method
 */
class BaseInstance
{
    private  $instances = [];

    protected function model($model)
    {
        /*Check if the model is already called by other object, then return the same instace
        Other wats create new instance and save it to the array*/
        $Model = ucfirst($model) . "Model";
        
        if (array_key_exists($model, $this->instances)) {
            return $this->instances[$Model];
        } else {
            if (!file_exists("model/$Model.php"))
                throw new Exception("$model not exist");
            require_once("model/$Model.php");
            $inst = new $Model();
            $this->instances[$Model] = $inst;
            return $inst;
        }
    }
    protected function controller($controller)
    {
        /*Check if the controller is already called by other object, then return the same instace
        Other wats create new instance and save it to the array*/
        $Controller = ucfirst($controller) . "Controller";
        if (array_key_exists($controller, BaseInstace::$instances)) {
            return BaseInstance::$instances[$controller];
        } else {
            
            if (!file_exists("controller/$Controller.php"))
                throw new Exception("Controller '$controller' not exist");
            $inst = new $Controller();
            BaseInstance::$instances[$Controller] = $inst;
            return $inst;
        }
    }
    protected function env($path)
    {
        global $env;
        return $env->get($path);
    }
    protected function redirect($path)
    {
        $base = $this->env("APP_URL");
        header("Location: $base$path");
        die;
    }
}
