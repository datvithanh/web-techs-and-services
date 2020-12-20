<?php

namespace App\Models;

class Session extends \Core\Model
{
    protected static $table = 'session'; 

    protected static $columns = ['gym_id', 'class_type_id', 'start_time', 'end_time'];
}
