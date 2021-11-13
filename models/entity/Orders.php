<?php

namespace app\models\entity;

use app\models\Entity;

class Orders extends Entity
{
    protected $id;
    protected $name;
    protected $phone;
    protected $user_id;
    protected $session_id;
    protected $sum;
    protected $status;
    protected $props = [
        'name' => false,
        'phone' => false,
        'user_id' => false,
        'session_id' => false,
        'sum' => false,
        'status' => false
    ];
    public function __construct(
        
        $name = null,
        $phone = null,
        $user_id = null,
        $session_id = null,
        $sum = null,
        $status = null)
    {
        
        $this->name = $name;
        $this->phone = $phone;
        $this->user_id = $user_id;
        $this->session_id = $session_id;
        $this->sum = $sum;
        $this->status = $status;
    }

}