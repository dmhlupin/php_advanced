<?php

namespace app\models;

class Users extends dbModel
{
    protected $id;
    protected $login;
    protected $name;
    protected $pass;
    protected $hash;
    protected $props = [
        'login' => false,
        'name' => false,
        'pass' => false,
        'hash' => false
    ];

    public function __construct(
        $id = null,
        $login = null,
        $name = null,
        $pass = null,
        $hash = null
    )
    {
        $this->id = $id;
        $this->login = $login;
        $this->name = $name;
        $this->pass = $pass;
        $this->hash = $hash;
    }

    public static function getTableName() {
        return 'users';        
    }

}