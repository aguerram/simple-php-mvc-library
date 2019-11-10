<?php

    function route($path)
    {
        global $env;
        return $env->get("APP_URL").$path;
    }
    function assets($path)
    {
        global $env;
        return $env->get("APP_URL").$path;
    }