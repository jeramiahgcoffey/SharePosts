<?php
class User
{
  private $db;

  public function __construct()
  {
    $this->db = new Database();
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
