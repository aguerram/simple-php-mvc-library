<?php

class UserModel extends Model
{
    protected $table = "users";

    public function login($email,$password)
    {
        $password = md5($password);
        $table = $this->table;
        $user = $this->selectOne("select id,is_admin from $table where username=:username and password=:password",[
            ":username"=>$email,
            ":password"=>$password
        ]);
        return $user;
    }
    public function findByUsername($username)
    {
        $table = $this->table;
        return $this->selectOne("select id from $table where username = :username ",[
            "username"=>strtolower(trim($username))
        ]);
    }
    public function save($array)
    {
        return $this->create([
            "username"=>strtolower($array["username"]),
            "password"=>md5($array["password"]),
            "last_name"=>ucfirst($array["last_name"]),
            "first_name"=>ucfirst($array["first_name"]),
        ]);
    }
}
