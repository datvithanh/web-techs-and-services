<?php

namespace App\Controllers;

use App\Models\ClassType;
use \Core\View;
use \App\Models\User;
use \App\Models\Gym;
use App\Models\Session;

class GymController extends \Core\Controller
{
    public function get(){
        $data = [];
        $data['gyms'] = Gym::all();
        View::renderTemplate('Home/gym.html', $data);
    }

    public function info($id) {
        $data = [];
        $gym = Gym::getById($id);

        if($gym == null){
            View::renderTemplate('404.html');
            return;
        }

        $sessions = Session::where('gym_id', $id);
        foreach($sessions as $session) {
            $session->class_type = ClassType::$class_type_map[$session->class_type_id];
        }

        $data['gym'] = $gym;
        $data['sessions'] = $sessions;
        
        View::renderTemplate('Home/gym_info.html', $data);
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

        $data = ['gym' => $gym];
        View::renderTemplate('Home/gym_update.html', $data);
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
        foreach($gyms as $gym) {
            $sessions = Session::where('gym_id', $gym->id);
            foreach($sessions as $session) 
                $session->class_type = ClassType::$class_type_map[$session->class_type_id];
            $gym->sessions = $sessions;
        }

        $data = ['gyms' => $gyms];

        View::renderTemplate('Home/gym_register.html', $data);
    }

    public function gymRegister($id) { 
        var_dump($id);
    }
}
