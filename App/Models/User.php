<?php

namespace App\Models;

class User extends \Core\Model
{
    protected static $table = 'user';

    protected static $columns = ["user_id", "email", "name", "password", "address", "phone_number", "created", "modified", "role"];
}
