<?php

namespace app\models;

class Feedback extends Model
{
    protected $id;
    protected $author;
    protected $text;

    public function getTableName() {
        return 'feedback';        
    }
}