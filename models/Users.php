<?php

namespace app\models;

class Users extends Model
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

    public function getTableName() {
        return 'users';        
    }

}