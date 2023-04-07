<?php
require_once('../../includes/themeheader.php');
require_once('../../includes/navbar.php');
require_once('../../includes/connection.php');
require_once('../../includes/functions.php');

if (!isset($_SESSION['user']) || ($_SESSION['user'] == null)) {
    header('Location: /login.php');
}

// $connection = ConnectionHelper::getConnection();
// $query = "select * from tbl_member";
// $statement = $connection->prepare($query);
// $statement->execute();
// //get all members
// $result = $statement->fetchAll(PDO::FETCH_ASSOC);

$searchStatus = getParam("searchStatus", "Approved");
$search = getParam("search");
$searchbloodgroup = getParam("searchBloodGroup");
$searchgender = getParam("searchGender");
function getSearchData()
{
    $searchStatus = getParam("searchStatus", "Approved");
    $search = getParam("search");
    $searchbloodgroup = getParam("searchBloodGroup");
    $searchgender = getParam("searchGender");
    $connection = ConnectionHelper::getConnection();
    $query = "select * from tbl_member where ((:search is null) or (Name like concat('%', :search, '%')) or (Address like concat('%', :search, '%')) or (Email like concat('%', :search, '%'))) and ((:gender is null) or (Gender = :gender)) and ((:bloodgroup is null) or (BloodGroup = :bloodgroup)) and (Status=:status)";
    $statement = $connection->prepare($query);
    $statement->bindParam('search', $search);
    $statement->bindParam('bloodgroup', $searchbloodgroup);
    $statement->bindParam('gender', $searchgender);
    $statement->bindParam('status', $searchStatus);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}
$result = getSearchData();

?>

<div class="container-fluid mt-2">
    <a href="add.php" class="btn btn-danger my-2">
        <i class="bi bi-person-plus"></i> Add Member
    </a>


    <div class="card shadow-lg">
        <div class="card-header">
            <h4 class="card-title">List of members</h4>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-3">

                </div>
                <div class="col-9">
                    <form class="d-flex my-2" action="" method="get">

                        <select class="form-select me-sm-2" aria-label="Default select example" name="searchStatus">
                            <option <?= $searchStatus == '' ? "selected" : "" ?> value="">Status</option>
                            <option <?= $searchStatus == 'Approved' ? "selected" : "" ?> value="Approved">Approved</option>
                            <option <?= $searchStatus == 'Requested' ? "selected" : "" ?> value="Requested">Requested
                            </option>
                        </select>

                        <select class="form-select me-sm-2" aria-label="Default select example" name="searchGender">
                            <option <?= $searchgender == '' ? "selected" : "" ?> value="">Gender</option>
                            <option <?= $searchgender == 'Male' ? "selected" : "" ?> value="Male">Male</option>
                            <option <?= $searchgender == 'Female' ? "selected" : "" ?> value="Female">Female</option>
                        </select>

                        <select class="form-select me-sm-2" aria-label="Default select example" name="searchBloodGroup">

                            <option <?= $searchbloodgroup == '' ? "selected" : "" ?> value="">Blood Group</option>
                            <option <?= $searchbloodgroup == 'A+' ? "selected" : "" ?> value="A+">A+</option>
                            <option <?= $searchbloodgroup == 'A-' ? "selected" : "" ?> value="A-">A-</option>
                            <option <?= $searchbloodgroup == 'B+' ? "selected" : "" ?> value="B+">B+</option>
                            <option <?= $searchbloodgroup == 'B-' ? "selected" : "" ?> value="B-">B-</option>
                            <option <?= $searchbloodgroup == 'AB+' ? "selected" : "" ?> value="AB-">AB-</option>
                            <option <?= $searchbloodgroup == 'AB-' ? "selected" : "" ?> value="AB+">AB+</option>
                            <option <?= $searchbloodgroup == 'O+' ? "selected" : "" ?> value="O+">O+</option>
                            <option <?= $searchbloodgroup == 'O-' ? "selected" : "" ?> value="O-">O-</option>
                        </select>


                        <input class="form-control me-sm-2" type="search" placeholder="Search" name="search"
                            value="<?= $search ?>">
                        <button class="btn btn-warning my-2 my-sm-0" type="submit" style="color: red;"><i
                                class="bi bi-search"></i></button>
                </div>
                </form>

            </div>

            <div class="table-responsive">
                <table class="table table-hover table-bordered ">

                    <thead class="table-danger">
                        <tr>
                            <th scope="col">SN</th>
                            <th scope="col">Name</th>
                            <th scope="col">Address</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Email</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Blood Group</th>
                            <th scope="col">Last Date</th>
                            <th scope="col">Action</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>

                    <tbody class="table-light">
                        <?php
                        $sn = 0;
                        foreach ($result as $member):
                            ?>
                            <tr class="">
                                <td>
                                    <?= ++$sn ?>
                                </td>
                                <td>
                                    <?= $member['Name'] ?>
                                </td>
                                <td>
                                    <?= $member['Address'] ?>
                                </td>
                                <td>
                                    <?= $member['Phone'] ?>
                                </td>
                                <td>
                                    <?= $member['Email'] ?>
                                </td>
                                <td>
                                    <?= $member['Gender'] ?>
                                </td>
                                <td>
                                    <?= $member['BloodGroup'] ?>
                                </td>
                                <td>
                                    <?= $member['LastDate'] ?>
                                </td>
                                <td class="d-flex">

                                    <?php
                                    if ($member['Status'] == "Requested") {
                                        ?>
                                        <form action="approve.php" method="POST" class="" style="display:inline">
                                            <input type="hidden" name="id" value="<?= $member['ID'] ?>" id="">
                                            <button class="btn btn-info  me-sm-2 d-flex"><i class="bi bi-check-square"></i>
                                                Approve</button>
                                        </form>
                                        <?php
                                    }
                                    ?>
                                    <a class="btn btn-success  me-sm-2" href="edit.php?id=<?= $member['ID'] ?>"> <i
                                            class="bi bi-pencil-square"></i></a>
                                    <form action="delete.php" method="POST" class="" style="display:inline">
                                        <input type="hidden" name="id" value="<?= $member['ID'] ?>" id="">
                                        <button class="btn btn-danger  me-sm-2"><i class="bi bi-trash-fill"></i></button>
                                    </form>
                                </td>
                                <td>
                                    <?= $member['Status'] ?>
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
<?php require_once('../../includes/footer.php'); ?>