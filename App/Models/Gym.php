<?php

namespace App\Models;

class Gym extends \Core\Model
{
    protected static $table = 'gym'; 

    protected static $columns = ['owner_id', 'name', 'address'];
}
