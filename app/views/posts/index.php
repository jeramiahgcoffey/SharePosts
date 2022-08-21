<?php require APP_ROOT . '/views/inc/header.php'; ?>
<?php flash('post_message'); ?>
<div class="row align-items-center mb-3">
  <div class="col-6">
    <h1>Posts</h1>
  </div>
  <div class="col-6">
    <a href="<?php echo URL_ROOT; ?>/posts/add" class="btn btn-primary float-right">
      <i class="fa fa-pencil"></i> Add Post
    </a>
  </div>
</div>
<?php foreach ($data['posts'] as $post) : ?>
  <div class="card card-body mb-3">
    <h4 class="card-title">
      <?php echo $post->title; ?>
    </h4>
    <div class="bg-light p-2 mb-3">
      Written by <?php echo $post->name; ?> on <?php echo DateTime::createFromFormat('Y-m-d H:i:s', $post->post_created)->format('m/d/Y h:i A'); ?>
    </div>
    <p class="card-text">
      <?php echo $post->body; ?>
    </p>
    <a href="<?php echo URL_ROOT; ?>/posts/show/<?php echo $post->post_id; ?>" class="btn btn-dark">More</a>
  </div>
<?php endforeach; ?>
<?php require APP_ROOT . '/views/inc/footer.php';
