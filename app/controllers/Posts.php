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

  public function add()
  {
    $data = [
      'title' => '',
      'body' => '',
      'user_id' => '',
      'title_error' => '',
      'body_error' => ''
    ];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

      $data['title'] = trim($_POST['title']);
      $data['body'] = trim($_POST['body']);
      $data['user_id'] = $_SESSION['user_id'];

      // Validate data
      if (empty($data['title'])) {
        $data['title_error'] = 'Please enter title';
      }

      if (empty($data['body'])) {
        $data['body_error'] = 'Please enter body text';
      }

      // Confirm no errors
      if (empty($data['title_error']) && empty($data['body_error'])) {
        // Validated
        if ($this->post_model->add_post($data)) {
          flash('post_message', 'Post added successfully');
          redirect('posts');
        } else {
          die('Something went wrong');
        }
      } else {
        // Load view with error
        $this->view('posts/add', $data);
      }
    } else {
      $this->view('posts/add', $data);
    }
  }
}
