<?php
class Validate
{

    public function isNotEmpty($val, $msg=null)
    {
        if (isset($val) && !empty($val))
            return null;

        return $msg?$msg:"'$val' should not be empty";
    }

    public function isEmail($email, $msg=null)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return null;
        } else {
            return $msg?$msg:"'$email' is not a valid email";
        }
    }
    public function isString($val, $msg=null)
    {
        if (preg_match("/^[a-z_\']$/i", $val)) {
            return null;
        } else {
            return $msg?$msg:"'$val' is not a valid string";
        }
    }
    public function isNumber($val, $msg=null)
    {
        if (preg_match("/^[0-9\.]$/i", $val)) {
            return null;
        } else {
            return $msg?$msg:"'$val' is not a valid string";
        }
    }
    public function max($val, $max, $msg=null)
    {
        if ($this->isNumber($val)) {
            if ($val <= $max)
                return null;
        }
        if (strlen($val) <= $max)
            return null;

        return $msg?$msg:"'$val' doesn't match $max as a maximum";
    }
    public function min($val, $min, $msg=null)
    {
        if ($this->isNumber($val) == null) {
            if ($val >= $min)
                return null;
        }
        if (strlen($val) >= $min)
            return null;
        return $msg?$msg:"'$val' doesn't match $min as a minimum";
    }
}
