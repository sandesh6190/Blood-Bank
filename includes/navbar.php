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
    <div class="row">
      <div class="col-4 d-flex">
        <!-- <img src="/assets/images/bldbnk.png" alt=""> -->
        <img src="/assets/bldbank.png" alt="">
        <a class="navbar-brand" href="#"> Blood Bank</a>
      </div>
    </div>

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
            <button class="btn btn-primary rounded-2 dropdown-toggle bg-secondary text-danger" type="button"
              data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false"><i
                class="bi bi-person-workspace"></i>
              Hi!
              <?= $userName ?>
            </button>
            <ul class="dropdown-menu">
              <li>
                <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModal">
                  Change Password
                </button>
              </li>
              <li>
                <form action="/logout.php" class="text-start d-inline" method="post">
                  <button class="dropdown-item">Logout</button>
                </form>
              </li>
            </ul>
          </div>


          <div class="modal fade rounded-2" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <form action="/includes/updPassword.php" method="post">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Change Password</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="container-fluid">
                      <div class="row">
                        <div class="col-10 d-flex flex-column mt-2">
                          <label for="OldPassword" class="form-label">Old Password</label>
                          <input type="password" class="form-control" name="OldPassword" required>
                        </div>
                        <div class="col-10 d-flex flex-column mt-2">
                          <label for="NewPassword" class="form-label">New Password</label>
                          <input type="password" class="form-control" name="NewPassword" required>
                        </div>
                        <div class="col-10 d-flex flex-column mt-2">
                          <label for="ConfirmPassword" class="form-label">Confirm Password</label>
                          <input type="password" class="form-control" name="ConfirmPassword" required>
                        </div>
                      </div>
                    </div>

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary text-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info">Save changes</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <?php
        }
        ?>



      </ul>
    </div>
  </div>
</nav>

<?php renderMessages(); ?>