<?php
namespace App\Proxies;

abstract class Proxy{
  public function __construct($wrapped) {
    $this->wrapped = $wrapped;
  }

  public function __call($method, $args) {
      return call_user_func_array(array($this->wrapped, $method),
          $args
      );
  }
}