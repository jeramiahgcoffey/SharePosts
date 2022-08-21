<?php
class Posts extends Controller
{
  public function __construct()
  {
    if (!is_logged_in()) {
      redirect('users/login');
      return;
    }

    $this->post_model = $this->model('Post');
    $this->user_model = $this->model('User');
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
          return;
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

  public function edit($id)
  {
    $data = [
      'id' => $id,
      'title' => '',
      'body' => '',
      'title_error' => '',
      'body_error' => ''
    ];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

      $data['title'] = trim($_POST['title']);
      $data['body'] = trim($_POST['body']);

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
        if ($this->post_model->update_post($data)) {
          flash('post_message', 'Post edited successfully');
          redirect('posts');
          return;
        } else {
          die('Something went wrong');
        }
      } else {
        // Load view with error
        $this->view('posts/edit', $data);
      }
    } else {
      // Get existing post from model
      $post = $this->post_model->get_post($id);

      // Check for owner  
      if ($post->user_id != $_SESSION['user_id']) {
        redirect('posts');
      }

      $data['id'] = $id;
      $data['title'] = $post->title;
      $data['body'] = trim($post->body);

      $this->view('posts/edit', $data);
    }
  }

  public function delete($id)
  {
    // Get existing post from model
    $post = $this->post_model->get_post($id);

    // Check for owner  
    if ($post->user_id != $_SESSION['user_id'] || !is_logged_in()) {
      redirect('posts');
      return;
    }

    if ($_SERVER['REQUEST_METHOD'] != 'POST') redirect('posts');

    if ($this->post_model->delete_post($id)) {
      flash('post_message', 'Post deleted successfully');
      redirect('posts');
    } else {
      die('Something went wrong');
    }
  }

  public function show($id)
  {
    $post = $this->post_model->get_post($id);
    $user = $this->user_model->get_user_by_id($post->user_id);

    $data = [
      'post' => $post,
      'user' => $user
    ];

    $this->view('posts/show', $data);
  }
}
