<?php


namespace Model;

use System\Queries;

class BaseModel {
    
    protected $db;

    public function __construct() {
        $this->db = new Queries();
    }
}