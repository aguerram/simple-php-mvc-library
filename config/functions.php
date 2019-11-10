<?php

    function root($path)
    {
        global $env;
        return $env->get("APP_URL").$path;
    }