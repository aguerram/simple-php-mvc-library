<?php
    class AuthMiddleware extends Middleware
    {
        public function __construct()
        {
            echo "Called";
        }
    }