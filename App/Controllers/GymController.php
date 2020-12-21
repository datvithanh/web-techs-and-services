<?php

namespace App\Controllers;

use App\Models\ClassType;
use \Core\View;
use \App\Models\User;
use \App\Models\Gym;
use App\Models\Register;
use App\Models\Session;

class GymController extends \App\Controllers\BaseController
{
    public function get(){
        $this->data['gyms'] = Gym::where('owner_id', $this->data['user']->id);
        View::renderTemplate('Home/gym.html', $this->data);
    }

    public function info($id) {
        $gym = Gym::getById($id);

        if($gym == null){
            View::renderTemplate('404.html');
            return;
        }

        $sessions = Session::where('gym_id', $id);
        foreach($sessions as $session) {
            $session->class_type = ClassType::$class_type_map[$session->class_type_id];
        }

        $this->data['gym'] = $gym;
        $this->data['sessions'] = $sessions;
        
        View::renderTemplate('Home/gym_info.html', $this->data);
    }

    public function createView(){
        View::renderTemplate('Home/gym_create.html');
    }

    public function create(){
        $gym = Gym::blankInstance();
        $gym->name = $_POST['name'];
        $gym->address = $_POST['address'];
        // TODO
        $gym->owner_id = 13;
        $gym->save();
        $this->get();
    }

    public function updateView($id) {
        $gym = Gym::getById($id);

        if($gym == null){
            View::renderTemplate('404.html');
            return;
        }

        $this->data['gym'] = $gym;
        View::renderTemplate('Home/gym_update.html', $this->data);
    }

    public function update($id) { 
        $gym = Gym::getById($id);
        
        if($gym == null){
            View::renderTemplate('404.html');
            return;
        }

        $gym->name = $_POST['name'];
        $gym->address = $_POST['address'];
        $gym->save();
        $this->get();
    }

    public function delete($id) {
        $gym = Gym::getById($id);

        if($gym == null){
            View::renderTemplate('404.html');
            return;
        }

        $gym->delete();
        $this->get();
    }  

    public function gymRegisterView() {
        $gyms = Gym::all();
        $register_ids = array_map(function($register){
            return $register->session_id;
        }, 
        Register::where('user_id', $this->data['user']->id));
        foreach($gyms as $gym) {
            $sessions = Session::where('gym_id', $gym->id);
            foreach($sessions as $session) {
                $session->class_type = ClassType::$class_type_map[$session->class_type_id];
                $session->is_registered = in_array($session->id, $register_ids);
            }
            $gym->sessions = $sessions;
        }

        $this->data['gyms'] = $gyms;

        View::renderTemplate('Home/gym_register.html', $this->data);
    }

    public function gymRegister($id) { 
        // var_dump($id);
        $register = Register::blankInstance();
        $register->user_id = $this->data['user']->id;
        $register->session_id = $id;
        $register->save();
        header("Location: /gym-register");
    }

    public function cancelGymRegister($id) {
        $register = Register::custom('delete from register where user_id=' .$this->data['user']->id. ' and session_id='.$id);
        header("Location: /gym-register");
    }
}
