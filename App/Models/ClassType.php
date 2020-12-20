<?php

namespace App\Models;

class ClassType extends \Core\Model
{
    protected static $table = 'class_type'; 

    protected static $columns = ['name', 'address'];

    public static $class_type_map = ['1' => 'Regular', '2' => 'Yoga', '3' => 'Boxing', '4' => 'Zumba']; 
}