<?php

namespace app\models;

class Users extends Model
{
    protected $id;
    protected $login;
    protected $pass;

    public function getTableName() {
        return 'users';        
    }

}