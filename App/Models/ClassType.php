<?php

namespace App\Models;

class ClassType extends \Core\Model
{
    protected static $table = 'class_type'; 

    protected static $columns = ['id', 'owner_id', 'name', 'address', 'created', 'modified'];
}