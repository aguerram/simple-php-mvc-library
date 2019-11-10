<?php
    class Middleware extends BaseInstance{
        protected function env($path)
        {
            global $env;
            return $env->get($path);
        }
        
    }