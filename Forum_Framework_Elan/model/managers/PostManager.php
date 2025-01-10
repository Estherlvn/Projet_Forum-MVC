<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;

class PostManager extends Manager {

    protected $className = "Model\Entities\Post";
    protected $tableName = "post";

    public function __construct() {
        parent::connect();
