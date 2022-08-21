<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3" aria-label="navbar">
  <div class="container">
    <div class="container-fluid">
      <a class="navbar-brand" href="<?php echo URL_ROOT; ?>"><?php echo SITE_NAME; ?></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navLinks" aria-controls="navLinks" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="navbar-collapse collapse" id="navLinks">
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="<?php echo URL_ROOT; ?>">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo URL_ROOT; ?>/pages/about">About</a>
          </li>
        </ul>

        <ul class="navbar-nav ml-auto">
          <?php if (isset($_SESSION['user_id'])) : ?>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="<?php echo URL_ROOT; ?>/users/logout">Logout <?php echo $_SESSION['user_name']; ?></a>
            </li>
          <?php else : ?>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="<?php echo URL_ROOT; ?>/users/register">Register</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo URL_ROOT; ?>/users/login">Login</a>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </div>
</nav>