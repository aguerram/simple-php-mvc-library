<?php

    function route($path)
    {
        global $env;
        return $env->get("APP_URL").$path;
    }