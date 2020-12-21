<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\User;
use \App\Models\Gym;
use App\Models\Register;
use App\Models\Session;
use App\Models\ClassType;

class HomeController extends \App\Controllers\BaseController
{
    public function index()
    {
        if($this->data['user']){
            header("Location: /gym-register");
        }
        View::renderTemplate('Home/login.html', $this->data);
    }

    public function profile()
    {
        if ($this->data['user']->role == 'user'){
            $sessions = Session::all();
            $registers = Register::where('user_id', $this->data['user']->id);
            $registered_session_ids = array_map(function($register){
                return $register->session_id;
            }, $registers);

            $sessions = array_filter($sessions, function($session) use ($registered_session_ids){
                return in_array($session->id, $registered_session_ids);
            });
            
            foreach($sessions as $session) {
                $session->class_type = ClassType::$class_type_map[$session->class_type_id];
            }

            $this->data['sessions'] = $sessions;
        }
        else {
            $query = "SELECT user.email, t2.start_time, t2.end_time, t2.class_type_id, t2.id, t2.gym_id
            FROM user join (SELECT register.user_id, t.start_time, t.end_time, t.class_type_id, t.id, t.gym_id
            FROM register join (SELECT s.id, s.start_time, s.end_time, s.class_type_id, gym.id as gym_id from gym join session s ON gym.id = s.gym_id
            WHERE owner_id = " . $_SESSION['user_id'] .") t on register.session_id = t.id) t2 on user.id = t2.user_id;";
            $rows = Register::custom_fetch($query);
            for($i = 0; $i < count($rows); $i++) {
                $rows[$i]['class_type'] = ClassType::$class_type_map[strval($rows[$i]['class_type_id'])];
            }
            $this->data['sessions'] = $rows;
        }
        View::renderTemplate('Home/profile.html', $this->data);
    }

    public function registerView() {
        $user = User::getById(1);
        View::renderTemplate('Home/register.html', $this->data);
    }

    public function register() {
        $user = User::blankInstance();
        $user->name = $_POST['username'];
        $user->email = $_POST['email']; 
        
        $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $user->password = $hashed_password;
        $user->save();
        header("Location: /");
    }

    public function loginView() {
        View::renderTemplate('Home/login.html', $this->data);
    }

    public function login() {
        $user = User::where('email', $_POST['email'])[0];
        $password = $_POST['password'];

        if (password_verify($password, $user->password)){
            $_SESSION['user_id'] = $user->id;
            if($user->role == 'user')
                header("Location: /gym-register");
            else
                header("Location: /gym");
        }
        else{
            var_dump('cannot login'); 
        }
    }

    public function logout(){
        $_SESSION['user_id'] = '';
        header("Location: /");
    }
}
