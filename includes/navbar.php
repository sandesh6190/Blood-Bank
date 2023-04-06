<?php
require_once('functions.php');
?>


<nav class="navbar navbar-expand-lg navbar-dark bg-danger">

  <div class="container-fluid">
    <img src="/assets/bldbank.png" alt="">
    <a class="navbar-brand" href="#"> Blood Bank</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="/user/member/">Members</a>
        </li>

        <?php
        if (isset($_SESSION['user'])) {
          ?>

          <?php
          if ($_SESSION['user']['Role'] == "Admin") {
            ?>
            <li class="nav-item">
              <a class="nav-link" href="/Admin/users.php">Users</a>
            </li>
            <?php
          }
          ?>



          <li class="nav-item">
            <a class="nav-link" href="/user/campaign/">Campaign</a>
          </li>
          <?php
        }
        ?>



      </ul>
      <ul class="navbar-nav mb-2 mb-lg-0">
        <?php
        if (!isset($_SESSION['user']) || $_SESSION['user'] == null) {
          ?>
          <li class="nav-item">
            <a class="nav-link" href="/login.php">Login</a>
          </li>

          <?php
        } else {
          ?>
          <li class="nav-item">
            <form action="/logout.php" method="post">
              <button class="btn btn-light"><i class="bi bi-box-arrow-left"></i> Logout</button>
            </form>

          </li>
          <?php
        }
        ?>



      </ul>
    </div>
  </div>
</nav>