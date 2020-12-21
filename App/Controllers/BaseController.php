<?php

namespace App\Controllers;

use App\Models\User;

class BaseController extends \Core\Controller
{
  protected $data = [];

  public function __construct($route_params)
  {
    $this->route_params = $route_params;
    if (!array_key_exists('user_id', $_SESSION))
      $this->data['user'] = null;
    else
      $this->data['user'] = User::getById($_SESSION['user_id']);
  }

  public function __call($name, $args)
  {
    $method = $name;
    var_dump($method);
    if (method_exists($this, $method)) {
      if ($this->before() !== false) {
        call_user_func_array([$this, $method], $args);
        $this->after();
      }
    } else {
      throw new \Exception("Method $method not found in controller " . get_class($this));
    }
  }

  protected function before()
  {
      // var_dump('eatshit');
  }

  protected function after()
  {
  }
}
