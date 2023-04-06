<?php
require_once('../includes/themeheader.php');
require_once('../includes/navbar.php');
require_once('../includes/functions.php');
require_once('../includes/connection.php');

if (!isset($_SESSION['user']) || ($_SESSION['user'] == null)) {
    header('Location: /login.php');
}

if (isPost()) {
    $Username = $_POST['inputUsername'];
    $Password = $_POST['inputPassword'];
    $Name = $_POST['inputName'];
    $Address = $_POST['inputAddress'];
    $Phone = $_POST['inputPhone'];
    $Email = $_POST['inputEmail'];
    $Status = "Active";
    $Role = $_POST['inputRole'];

    $connection = ConnectionHelper::getConnection();
    $query = "insert into user (Username,Password,Name,Address,Phone,Email,Status,Role) values(:username,:password,:name,:address,:phone,:email,:status,:role)";
    $statement = $connection->prepare($query);
    $PasswordHash = password_hash($Password, PASSWORD_DEFAULT);
    $statement->bindParam('username', $Username);
    $statement->bindParam('password', $PasswordHash);
    $statement->bindParam('name', $Name);
    $statement->bindParam('address', $Address);
    $statement->bindParam('phone', $Phone);
    $statement->bindParam('email', $Email);
    $statement->bindParam('status', $Status);
    $statement->bindParam('role', $Role);
    $statement->execute();
    $result = $statement->rowCount();
    if ($result > 0) {
        echo "Data inserted";
    } else
        echo "No data inserted";
}
?>
<form method="post">

    <div class="container mt-4">
        <div class="card shadow-lg">
            <div class="card-header">
                <h4 class="card-title text-center text-primary text-uppercase">User Form</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="inputName" class="form-label">Userame</label>
                        <input type="text" class="form-control" name="inputUsername" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="inputAddress" class="form-label">Password</label>
                        <input type="password" class="form-control" name="inputPassword" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="inputName" class="form-label">Name</label>
                        <input type="text" class="form-control" name="inputName">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="inputAddress" class="form-label">Address</label>
                        <input type="text" class="form-control" name="inputAddress">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="inputEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" name="inputEmail">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="inputPhone" class="form-label">Phone Number</label>
                        <input type="number" class="form-control" name="inputPhone">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="inputRole" class="form-label">Role</label>
                        <select class="form-select" aria-label="Default select example" name="inputRole" required>
                            <!-- <option selected>Role</option> -->
                            <option value="Admin">Admin</option>
                            <option value="User">User</option>
                        </select>
                    </div>
                    <!-- <div class="col-md-6 mb-3">
                        <select class="form-select" aria-label="Default select example" name="inputStatus" required>
                            <option selected>Status</option>
                            <option value="Active">Active</option>
                            <option value="Deactivate">Deactivate</option>
                        </select>
                    </div> -->

                </div>


            </div>
            <div class="card-footer">
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-danger w-100">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>