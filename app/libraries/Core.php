<?php
/*
 * App Core Class
 * Creates URL & loads core controller
 * URL FORMAT - /controller/method/params
 */
class Core
{
  protected $current_controller = 'Pages';
  protected $current_method = 'index';
  protected $params = [];

  public function __construct()
  {
    $url = $this->get_url();

    // Look in controllers for first value
    if (!empty($url[0]) && file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
      // Set as current controller
      $this->current_controller = ucwords($url[0]);

      unset($url[0]);
    }

    // Require the controller
    require_once '../app/controllers/' . $this->current_controller . '.php';

    // Instantiate controller class
    $this->current_controller = new $this->current_controller;

    // Check for second part of url
    if (isset($url[1])) {
      // Check to see if method exists in controller
      if (method_exists($this->current_controller, $url[1])) {
        $this->current_method = $url[1];

        unset($url[1]);
      }
    }

    // Get params
    $this->params = $url ? array_values($url) : [];

    // Call a callback with array of params
    call_user_func_array([$this->current_controller, $this->current_method], $this->params);
  }

  public function get_url()
  {
    if (isset($_GET['url'])) {
      $url = rtrim($_GET['url'], '/');
      $url = filter_var($url, FILTER_SANITIZE_URL);
      $url_arr = explode('/', $url);
      return $url_arr;
    }
  }
}
