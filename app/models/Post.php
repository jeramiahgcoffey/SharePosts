<?php
class Post
{
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }

  public function get_posts()
  {
    $this->db->query('SELECT *,
                      posts.id as post_id,
                      users.id as user_id,
                      posts.created_at as post_created,
                      users.created_at as user_created
                      FROM posts INNER JOIN users
                      ON posts.user_id = users.id
                      ORDER BY posts.created_at DESC
                    ');

    return $this->db->result_set();
  }

  public function get_post($id)
  {
    $this->db->query("SELECT * FROM posts WHERE id = :id");
    $this->db->bind(':id', $id);

    return $this->db->single();
  }

  public function add_post($data)
  {
    $this->db->query(
      'INSERT INTO posts (user_id, title, body) 
       VALUES (:user_id, :title, :body)'
    );

    $this->db->bind(':user_id', $data['user_id']);
    $this->db->bind(':title', $data['title']);
    $this->db->bind(':body', $data['body']);

    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function update_post($data)
  {
    $this->db->query(
      'UPDATE posts
      SET title = :title, body = :body
      WHERE id= :id'
    );

    $this->db->bind(':id', $data['id']);
    $this->db->bind(':title', $data['title']);
    $this->db->bind(':body', $data['body']);

    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function delete_post($id)
  {
    $this->db->query('DELETE FROM posts WHERE id = :id');

    $this->db->bind(':id', $id);

    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }
}
