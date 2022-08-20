<?php
class Pages extends Controller
{
  public function __construct()
  {
  }

  public function index()
  {

    $data = [
      'title' => 'SharePosts',
      'description' => 'Simple social network built on the JerMVC PHP framework'
    ];
    $this->view('pages/index', $data);
  }

  public function about()
  {
    $data = [
      'title' => 'About Us',
      'description' => 'Application to share posts with other users'

    ];
    $this->view('pages/about', $data);
  }
}
