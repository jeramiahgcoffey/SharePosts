<?php
class Users extends Controller
{
  public function __construct()
  {
    $this->user_model = $this->model('User');
  }

  public function register()
  {
    // Init data
    $data = [
      'name' => '',
      'email' => '',
      'password' => '',
      'confirm_password' => '',
      'name_error' => '',
      'email_error' => '',
      'password_error' => '',
      'confirm_password_error' => ''
    ];

    // Check for POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Sanitize POST data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

      // Process form
      $data['name'] = trim($_POST['name']);
      $data['email'] = trim($_POST['email']);
      $data['password'] = trim($_POST['password']);
      $data['confirm_password'] = trim($_POST['confirm_password']);

      // Validate Email
      if (empty($data['email'])) {
        $data['email_error'] = 'Please enter email';
      } elseif ($this->user_model->find_user_by_email($data['email'])) {
        $data['email_error'] = 'Email is already taken';
      }

      // Validate Name
      if (empty($data['password'])) {
        $data['name_error'] = 'Please enter name';
      }

      // Validate Password
      if (empty($data['password'])) {
        $data['password_error'] = 'Please enter password';
      } elseif (strlen($data['password']) < 6) {
        $data['password_error'] = 'Password must be at least 6 characters';
      }

      // Validate Confirm Password
      if (empty($data['confirm_password'])) {
        $data['confirm_password_error'] = 'Please confirm password';
      } elseif ($data['password'] != $data['confirm_password']) {
        $data['confirm_password_error'] = 'Passwords do not match';
      }

      // Confirm no errors
      if (
        empty($data['email_err'])
        && empty($data['name_error'])
        && empty($data['password_error'])
        && empty($data['confirm_password_error'])
      ) {
        // Validated
        // Hash password
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        // Register user
        if ($this->user_model->register($data)) {
          redirect('users/login');
        } else {
          die('Something went wrong');
        }
      } else {
        // Load view with errors
        $this->view('users/register', $data);
      }
    } else {
      // Load initial view
      $this->view('users/register', $data);
    }
  }

  public function login()
  {
    // Init data
    $data = [
      'email' => '',
      'password' => '',
      'email_error' => '',
      'password_error' => '',
    ];

    // Check for POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Sanitize POST data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

      // Process form
      $data['email'] = trim($_POST['email']);
      $data['password'] = trim($_POST['password']);

      // Validate Email
      if (empty($data['email'])) {
        $data['email_error'] = 'Please enter email';
      }

      // Validate Password
      if (empty($data['password'])) {
        $data['password_error'] = 'Please enter password';
      } elseif (strlen($data['password']) < 6) {
        $data['password_error'] = 'Password must be at least 6 characters';
      }

      // Confirm no errors
      if (
        empty($data['email_err'])
        && empty($data['password_error'])
      ) {
        // Validated
        die('SUCCESS');
      } else {
        // Load view with errors
        $this->view('users/login', $data);
      }
    } else {
      // Load initial view
      $this->view('users/login', $data);
    }
  }
}
