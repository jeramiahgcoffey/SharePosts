<?php
// Load Config
require_once 'config/config.php';

// Autoload Core Libraries
spl_autoload_register(function ($class_name) {
  require_once 'libraries/' . $class_name . '.php';
});
