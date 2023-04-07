<?php
require_once('functions.php');

function getUserName()
{
  return $_SESSION['user']['Name'];
}
if (isset($_SESSION['user'])) {
  $userName = getUserName();
}
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

          <div class="btn-group dropstart">
            <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown"
              data-bs-auto-close="true" aria-expanded="false">
              Hi! <?= $userName ?>
            </button>
            <ul class="dropdown-menu">
              <li>

                <button class="dropdown-item">Change Password</button>
              </li>
              <li>
                <form action="/logout.php" class="text-start d-inline" method="post">
                  <button class="dropdown-item">Logout</button>
                </form>
              </li>
            </ul>
          </div>

          <?php
        }
        ?>



      </ul>
    </div>
  </div>
</nav>