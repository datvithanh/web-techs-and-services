<?php

namespace App\Models;

class User extends \Core\Model
{
    protected static $table = 'user';

    protected static $columns = ["email", "name", "password", "address", "phone_number", "role"];
}
