<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\User;
use \App\Models\Gym;

class HomeController extends \Core\Controller
{
    public function index()
    {
        $data['testing_var'] = 'this is value of testing var';
        View::renderTemplate('Home/index.html', $data);
    }

    public function registerGet() {
        $user = User::getById(1);
        View::renderTemplate('Home/register.html');
    }

    public function registerPost() {
        $user = User::blankInstance();
        $user->name = $_POST['username'];
        $user->email = $_POST['email']; 
        
        $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $user->password = $hashed_password;
        $user->save();
    }

    public function loginGet() {
        View::renderTemplate('Home/login.html');
    }

    public function loginPost() {
        $user = User::where('email', $_POST['email'])[0];
        $password = $_POST['password'];

        if (password_verify($password, $user->password)){
            var_dump('login successful');
        }
        else{
            var_dump('cannot login'); 
        }
    }
}
