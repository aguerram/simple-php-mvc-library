<?php

class UserModel extends Model
{
    protected $table = "users";

    public function login($email,$password)
    {
        $password = md5($password);
        $table = $this->table;
        $user = $this->selectOne("select id from $table where email=:email and password=:password",[
            ":email"=>$email,
            ":password"=>$password
        ]);
        return $user;
    }
}
