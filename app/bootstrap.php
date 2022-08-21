<?php
// Load Config
require_once 'config/config.php';

// Load helpers
require_once 'helpers/url_helper.php';

// Autoload Core Libraries
spl_autoload_register(function ($class_name) {
  require_once 'libraries/' . $class_name . '.php';
});
