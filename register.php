<?php
require_once('header.php')
?>

<form action="" method="post">
<div class="container">
<div class="card my-5">
    <div class="card-header">
        <h2 class="card-title">Register</h2>
    </div>
    <div class="card-body">
            <div class="mb-4">
                <label for="firstName">First Name</label>
                <input type="text" id="firstName" name="firstName" class="form-control">
            </div>
            <div class="mb-4">
                <label for="lastName">Last Name</label>
                <input type="text" id="lastName" name="lastName" class="form-control">
            </div>
            <div class="mb-4">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" class="form-control">
            </div>
            <div class="mb-4">
                <label for="password">Password</label>
                <input type="text" id="password" name="password" class="form-control">
            </div>
    </div>
    <div class="card-footer">
    <button class="btn btn-primary">Register</button>
    </div>
</div>
</div>
</form>

<?php
require_once('footer.php')
?>