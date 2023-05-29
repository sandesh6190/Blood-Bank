<?php
require_once('../includes/functions.php');
require_once('../includes/connection.php');

if (!isset($_SESSION['user']) || ($_SESSION['user'] == null)) {
    header('Location: /login.php');
}

$userId = getParam('userid');

function getUserDetails($userId)
{
    $connection = ConnectionHelper::getConnection();
    $query = "select * from user where ID=:id";
    $statement = $connection->prepare($query);
    $statement->bindParam('id', $userId);
    $statement->execute();
    $user = $statement->fetch();
    return $user;
}
$user = getUserDetails($userId);

if (isPost()) {
    $Username = $_POST['inputUsername'];
    $Name = $_POST['inputName'];
    $Address = $_POST['inputAddress'];
    $Phone = $_POST['inputPhone'];
    $Email = $_POST['inputEmail'];
    $Role = $_POST['inputRole'];

    $connection = ConnectionHelper::getConnection();
    $query = "update user set Username = :username, Name = :name ,Address = :address ,Phone= :phone,Email= :email,Role =:role where ID = :id";
    $statement = $connection->prepare($query);
    $statement->bindParam('id', $userId);
    $statement->bindParam('username', $Username);
    $statement->bindParam('name', $Name);
    $statement->bindParam('address', $Address);
    $statement->bindParam('phone', $Phone);
    $statement->bindParam('email', $Email);
    $statement->bindParam('role', $Role);
    $statement->execute();
    $result = $statement->rowCount();
    if ($result > 0) {
        addSuccessMessage("Successfully User Edited");
    } else
        addErrorMessage("Unfortunately, User didn't Edited");

    header('Location: /Admin/users.php');
}

require_once('../includes/themeheader.php');
require_once('../includes/navbar.php');

?>

<form method="post">

    <div class="container mt-4">
        <div class="card shadow-lg">
            <div class="card-header">
                <h4 class="card-title text-center text-primary text-uppercase">User Edit</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="inputUserName" class="form-label">Username</label>
                        <input type="text" class="form-control" name="inputUsername" value="<?= $user['Username'] ?>"
                            required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="inputName" class="form-label">Name</label>
                        <input type="text" class="form-control" name="inputName" value="<?= $user['Name'] ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="inputAddress" class="form-label">Address</label>
                        <input type="text" class="form-control" name="inputAddress" value="<?= $user['Address'] ?>"
                            required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="inputEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" name="inputEmail" value="<?= $user['Email'] ?>"
                            required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="inputPhone" class="form-label">Phone Number</label>
                        <input type="number" class="form-control" name="inputPhone" value="<?= $user['Phone'] ?>"
                            required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="inputRole" class="form-label">Role</label>
                        <select class="form-select" aria-label="Default select example" name="inputRole" required>
                            <!-- <option value=<?= $user['Role'] == '' ? "selected" : "" ?>>Role</option> -->
                            <option <?= $user['Role'] == 'Admin' ? "selected" : "" ?> value="Admin">Admin</option>
                            <option <?= $user['Role'] == 'User' ? "selected" : "" ?> value="User">User</option>
                        </select>
                    </div>

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


<?php
require_once('../includes/footer.php');
?>