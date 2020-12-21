<?php
namespace App\Proxies;

class AuthProxy{
  public function __construct($wrapped) {
    $this->wrapped = $wrapped;
  }

  public function __call($method, $args) {
      if (array_key_exists('user_id', $_SESSION) && $_SESSION['user_id']) {
        header("Location: /login");
        return;
      }

      return call_user_func_array(array($this->wrapped, $method),
          $args
      );
  }
}