<?php
require_once('../includes/themeheader.php');
require_once('../includes/connection.php');
require_once('../includes/functions.php');
require_once('../includes/navbar.php');


if (isset($_SESSION['user'])) {
    if ($_SESSION['user']['Role'] != "Admin") {
        header('Location: /user/member/');
    }
} else {
    header('Location: /login.php');
}


// $connection = ConnectionHelper::getConnection();
// $query = "select * from user";
// $statement = $connection->prepare($query);
// $statement->execute();
// $result = $statement->fetchAll(PDO::FETCH_ASSOC);


$search = getParam('userSearch');
$searchrole = getParam('searchRole');
$searchstatus = getParam('searchStatus', 'Active');



function getSearchUser()
{
    $search = getParam('userSearch');
    $searchrole = getParam('searchRole');
    $searchstatus = getParam('searchStatus', 'Active');
    $connection = ConnectionHelper::getConnection();
    $query = "select * from user where ((:search is null) or (Username like concat('%', :search, '%')) or (Name like concat('%', :search, '%')) or (Address like concat('%', :search, '%')) or (Email like concat('%', :search, '%'))) and ((:role is null) or (Role = :role)) and ((:status is null) or (Status = :status)) and Id != :id";
    $statement = $connection->prepare($query);
    $statement->bindParam('id', $_SESSION['user']['ID']);
    $statement->bindParam('search', $search);
    $statement->bindParam('role', $searchrole);
    $statement->bindParam('status', $searchstatus);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    // dd($result);
    return $result;
}
$result = getSearchUser();

?>


<div class="container-fluid mt-2">


    <div class="card shadow-lg">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="card-title">List of Users</h4>

                <a href="/Admin/adduser.php" class="btn btn-danger my-2" title="Add User">
                    <i class="bi bi-person-plus"></i> Add User
                </a>
            </div>
        </div>

        <div class="card-body">
            <div class="row my-2">
                <div class="col-5">

                </div>
                <div class="col-7">
                    <form class="d-flex" action="" method="get">
                        <select class="form-select me-sm-2" aria-label="Default select example" name="searchStatus">
                            <option <?= $searchstatus == '' ? "selected" : "" ?> value="">Status</option>
                            <option <?= $searchstatus == 'Active' ? "selected" : "" ?> value="Active">Active</option>
                            <option <?= $searchstatus == 'Deactivate' ? "selected" : "" ?> value="Deactivate">Deactivate
                            </option>
                        </select>

                        <select class="form-select me-sm-2" aria-label="Default select example" name="searchRole">
                            <option <?= $searchrole == '' ? "selected" : "" ?> value="">Role</option>
                            <option <?= $searchrole == 'Admin' ? "selected" : "" ?> value="Admin">Admin</option>
                            <option <?= $searchrole == 'User' ? "selected" : "" ?> value="User">User</option>
                        </select>

                        <input class="form-control me-sm-2" type="search" placeholder="Search" name="userSearch"
                            value="<?= $search ?>">
                        <button class="btn btn-warning my-2 my-sm-0" type="submit" title="Search User"
                            style="color: red;"><i class="bi bi-search"></i></button>
                    </form>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="table-danger">
                        <tr>
                            <th>SN</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Role</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-light">
                        <?php
                        $sn = 0;
                        foreach ($result as $user):
                            ?>
                            <tr>
                                <td>
                                    <?= ++$sn ?>
                                </td>
                                <td>
                                    <?= $user['Name'] ?>
                                </td>
                                <td>
                                    <?= $user['Username'] ?>
                                </td>
                                <td>
                                    <?= $user['Email'] ?>
                                </td>
                                <td>
                                    <?= $user['Address'] ?>
                                </td>
                                <td>
                                    <?= $user['Role'] ?>
                                </td>
                                <td>
                                    <?= $user['Phone'] ?>
                                </td>
                                <td>
                                    <?= $user['Status'] ?>
                                </td>
                                <td class="d-flex">
                                    <a class="btn btn-success me-sm-2 d-flex" title="Edit" style="color: black;"
                                        href="/Admin/edituser.php?userid=<?= $user['ID'] ?>"><i
                                            class="bi bi-pencil-square"></i></a>
                                    <form action="/Admin/togglestatus.php" method="POST">
                                        <button class="btn btn-warning me-sm-2" title="Status Change"
                                            style="display: flex; color: black;" name="userid" value="<?= $user['ID'] ?>">
                                            <?php
                                            if ($user['Status'] == "Active"):
                                                ?>
                                                <i class="bi bi-toggle2-off"></i>
                                                <?php
                                            else:
                                                ?>
                                                <i class="bi bi-toggle2-on"></i>
                                            <?php endif ?>
                                        </button>
                                    </form>
                                    <button class="btn btn-info" title="Reset Password" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal1" style="display: flex; color: black;" "><i class=" bi
                                    bi-key-fill"></i>
                                    </button>
                                </td>
                            </tr>
                            <?php
                        endforeach;
                        ?>

                    </tbody>
                    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <form action="/Admin/resetPassword.php" method="post">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Reset Password</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-10 d-flex flex-column mt-2">
                                                    <label for="NewPassword" class="form-label">New Password</label>
                                                    <input type="password" class="form-control" name="NewPassword"
                                                        required>
                                                </div>
                                                <div class="col-10 d-flex flex-column mt-2">
                                                    <label for="ConfirmPassword" class="form-label">Confirm
                                                        Password</label>
                                                    <input type="password" class="form-control" name="ConfirmPassword"
                                                        required>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary text-danger"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class=" btn
                                            btn-info" name="userid" value="<?= $user['ID'] ?>"> Reset</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </table>
            </div>
        </div>
    </div>

</div>

<?php
require_once('../includes/footer.php');
?>