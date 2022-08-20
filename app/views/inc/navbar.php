<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3" aria-label="First navbar example">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?php echo URL_ROOT; ?>"><?php echo SITE_NAME; ?></a>
    <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#links" aria-controls="navbarsExample01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-collapse collapse" id="links">
      <ul class="navbar-nav me-auto mb-2">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?php echo URL_ROOT; ?>">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo URL_ROOT; ?>/pages/about">About</a>
        </li>
      </ul>

      <ul class="navbar-nav ml-auto mb-2">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?php echo URL_ROOT; ?>/users/register">Register</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo URL_ROOT; ?>/users/login">Login</a>
        </li>
      </ul>
    </div>
  </div>
</nav>