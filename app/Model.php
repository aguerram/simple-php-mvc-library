<?php
    abstract class Model
    {
        private static $connection;
        public function __construct()
        {
            if(Model::$connection == null)
            {
                Model::$connection = new PDO("");
            }
        }

        abstract protected function schema();
    }
