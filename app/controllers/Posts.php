<?php
class Posts extends Controller
{
  public function __construct()
  {
    !is_logged_in() && redirect('users/login');

    $this->post_model = $this->model('Post');
  }

  public function index()
  {
    $posts = $this->post_model->get_posts();

    $data = [
      'posts' => $posts
    ];

    $this->view('posts/index', $data);
  }
}
