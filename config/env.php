<?php

class ENV
{
    private $env = [];
    public function __construct()
    {
        if (!file_exists(".env")) {
            throw new Exception("'.env' files is missing.");
        } else {
            $file = fopen("./.env", "r");
            $values = fread($file, filesize(".env"));
            $list = explode("\n", $values);
            foreach ($list as $line) {
                if (strlen(trim($line)) < 1)
                    continue;

                $split_line = explode("=", $line, 2);
                //split founded line into 2
                if (count($split_line) == 2) {
                    $key = trim($split_line[0]);
                    $val = trim($split_line[1]);
                    //It's a comment line that starts with #

                    if (preg_match("/^\#.*$/", $key))
                        continue;
                    if (preg_match("/^(true|false)$/i", $val)) {
                        $val = strtolower($val) == "true" ? true : false;
                    }
                    else if(preg_match("/^[0-9\.]$/",$val))
                    {
                        $val = strval($val);
                    }

                    $this->env[$key] = $val;
                }
            }
        }
    }
    /**
     * this method will return an env variable if it's exist other ways will return null
     */
    public function get($path)
    {
        if (!array_key_exists($path, $this->env)) return null;
        return $this->env[$path];
    }
}
