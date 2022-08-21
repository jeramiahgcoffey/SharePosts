<?php
class User
{
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function register($data)
  {
    $this->db->query(
      'INSERT INTO users (name, email, password) 
       VALUES (:name, :email, :password)'
    );

    $this->db->bind(':name', $data['name']);
    $this->db->bind(':email', $data['email']);
    $this->db->bind(':password', $data['password']);

    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function login($email, $password)
  {
    $this->db->query('SELECT * FROM users WHERE email = :email');
    $this->db->bind(':email', $email);

    $row = $this->db->single();

    $hashed_password = $row->password;
    if (password_verify($password, $hashed_password)) {
      return $row;
    } else {
      return false;
    }
  }

  // Find user by email
  public function find_user_by_email($email)
  {
    $this->db->query('SELECT * FROM users WHERE email = :email');
    $this->db->bind(':email', $email);
    $this->db->execute();

    // Check row
    if ($this->db->row_count() > 0) {
      return true;
    } else {
      return false;
    }
  }
}
