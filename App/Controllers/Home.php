<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\User;
use \App\Models\Gym;

/**
 * Home controller
 *
 * PHP version 7.0
 */
class Home extends \Core\Controller
{

    /**
     * Show the index page
     *
     * @return void
     */
    public function indexAction()
    {
        $users = User::all();
        // $users = User::where('email', '%dat%');
        // $users = User::getById("1");
        // var_dump(User::getTable());
        // var_dump((object) $users[0]);
        // $users = Gym::getById(1);
        var_dump($users);
        // $user = new User($users[0]);
        // var_dump($user->email);
        // User::create('abc@gmail.com', 'askd', '012381248', 'user');
        // User::
        View::renderTemplate('Home/index.html');
    }
}
