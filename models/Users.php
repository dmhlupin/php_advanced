<?php

namespace app\models;

class Users extends dbModel
{
    protected $id;
    protected $login;
    protected $pass;

    public function __construct(
        $id = null,
        $login = null,
        $pass = null
    )
    {
        $this->id = $id;
        $this->login = $login;
        $this->pass = $pass;
    }

    public static function getTableName() {
        return 'users';        
    }

}