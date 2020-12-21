<?php

namespace App\Models;

class Register extends \Core\Model
{
    protected static $table = 'register'; 

    protected static $columns = ['user_id', 'session_id'];
}
