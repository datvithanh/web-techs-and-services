<?php

namespace App\Controllers;

use App\Models\ClassType;
use \Core\View;
use \App\Models\User;
use \App\Models\Gym;
use App\Models\Session;
use DateTime;

class SessionController extends \Core\Controller
{
    public function delete($id) {
        $session = Session::getById($id);
        $gym_id = $session->gym_id;
        if($session == null){
            View::renderTemplate('404.html');
            return;
        }

        $session->delete();
        header("Location: /gym/" . $gym_id);
    }  

    public function createView($id) {
        $gym = Gym::getById($id);
        $data = [];
        $data['gym'] = $gym;

        View::renderTemplate('Home/session_create.html', $data);
    }

    public function create($id) {
        $session = Session::blankInstance();

        $start_time = $_POST['start_time'] . ':00';
        $end_time = $_POST['end_time'] . ':00';
        $start_time = str_replace('T', ' ', $start_time);
        $end_time = str_replace('T', ' ', $end_time);

        $session->gym_id = $id;
        $session->class_type_id = $_POST['class_type_id'];
        $session->start_time = $start_time;
        $session->end_time = $end_time;
        $session->save();

        header("Location: /gym/" . $id);
    }

    public function update($id) {
        $session = Session::getById($id);

        $start_time = $_POST['start_time'] . ':00';
        $end_time = $_POST['end_time'] . ':00';
        $start_time = str_replace('T', ' ', $start_time);
        $end_time = str_replace('T', ' ', $end_time);

        $session->class_type_id = $_POST['class_type_id'];
        $session->start_time = $start_time;
        $session->end_time = $end_time;
        $session->save();

        header("Location: /gym/" . $session->gym_id);
    }

    public function updateView($id) {
        $session = Session::getById($id);
        
        if($session == null){
            View::renderTemplate('404.html');
            return;
        }

        $session->selected = ['', '', '', '', ''];
        $session->selected[$session->class_type_id] = 'selected';
        
        $session->start_time = substr(str_replace(' ', 'T', $session->start_time), 0, -3);
        $session->end_time = substr(str_replace(' ', 'T', $session->end_time), 0, -3);

        $data = ['session' => $session];

        View::renderTemplate('Home/session_update.html', $data);
    }
}
