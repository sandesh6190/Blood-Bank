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
    $query = "select * from user where ((:search is null) or (Username like concat('%', :search, '%')) or (Name like concat('%', :search, '%')) or (Address like concat('%', :search, '%')) or (Email like concat('%', :search, '%'))) and ((:role is null) or (Role = :role)) and ((:status is null) or (Status = :status))";
    $statement = $connection->prepare($query);
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
    <a href="/Admin/adduser.php" class="btn btn-danger my-2">
        <i class="bi bi-person-plus"></i> Add User
    </a>

    <div class="card shadow-lg">
        <div class="card-header">
            <h4 class="card-title">List of Users</h4>

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
                        <button class="btn btn-warning my-2 my-sm-0" type="submit" style="color: red;"><i
                                class="bi bi-search"></i></button>
                    </form>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="table-danger">
                        <tr>
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
                        foreach ($result as $user):
                            ?>
                            <tr>
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
                                    <a class="btn btn-success btn-sm me-sm-2 d-flex" style="color: black;"
                                        href="/Admin/edituser.php?userid=<?= $user['ID'] ?>"><i
                                            class="bi bi-pencil-square"></i> Edit</a>
                                    <form action="/Admin/togglestatus.php" method="POST">
                                        <button class="btn btn-info btn-sm" style="display: flex; color: black;"
                                            name="userid" value="<?= $user['ID'] ?>"><i class="bi bi-toggle2-off"></i>
                                            Status</button>
                                    </form>
                                </td>
                            </tr>
                            <?php
                        endforeach;
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<?php
require_once('../includes/footer.php');
?>