<?php

namespace app\models\entity;

use app\models\Entity;

class Users extends Entity
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
        
        $login = null,
        $name = null,
        $pass = null,
        $hash = null
    )
    {
        
        $this->login = $login;
        $this->name = $name;
        $this->pass = $pass;
        $this->hash = $hash;
    }
    


}