<?php

require_once('../../includes/connection.php');
require_once('../../includes/functions.php');

if (!isset($_SESSION['user']) || ($_SESSION['user'] == null)) {
    header('Location: /login.php');
}



$Search = getParam('search');
$SearchBloodGroup = getParam('searchBloodGroup');
$SearchGender = getParam('searchGender');

$CampaignID = getParam('CampaignId');
$CampaignName = getParam('CampaignName');
function getDonor($CampaignID)
{
    $Search = getParam('search');
    $SearchBloodGroup = getParam('searchBloodGroup');
    $SearchGender = getParam('searchGender');

    $connection = ConnectionHelper::getConnection();
    $query = "select * from tbl_donor where (CampaignID = :campaignID) and ((:search is null) or (Name like concat('%', :search, '%')) or (Address like concat('%', :search, '%'))) and ((:searchBloodGroup is null) or (BloodGroup = :searchBloodGroup)) and ((:searchGender is null) or (Gender = :searchGender))";
    $statement = $connection->prepare($query);
    $statement->bindParam('search', $Search);
    $statement->bindParam('searchBloodGroup', $SearchBloodGroup);
    $statement->bindParam('searchGender', $SearchGender);
    $statement->bindParam('campaignID', $CampaignID);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

$result = getDonor($CampaignID);
require_once('../../includes/themeheader.php');
require_once('../../includes/navbar.php');
?>

<div class="container-fluid mt-2">
    <div>

    </div>

    <div class="card shadow-lg">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="card-title">List of Donors of <span class="text-danger">
                        <?= $CampaignName ?>
                    </span>

                </h4>

                <!-- <a href="/user/campaign/" class="btn btn-danger my-2"><i class="bi bi-box-arrow-left"></i> Back</a> -->
                <a href="/user/donor/addDonor.php?CampaignId=<?= $CampaignID ?>" class="btn btn-info my-2"
                    title="Add Donor"><i class="bi bi-person-plus"></i> Add
                    Donor</a>
            </div>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-6">

                </div>
                <div class="col-6">
                    <form action="" method="get" class="d-flex my-2">
                        <select class="form-select me-sm-2" aria-label="Default select example" name="searchBloodGroup">

                            <option <?= $SearchBloodGroup == '' ? "selected" : "" ?> value="">Blood Group</option>
                            <option <?= $SearchBloodGroup == 'A+' ? "selected" : "" ?> value="A+">A+</option>
                            <option <?= $SearchBloodGroup == 'A-' ? "selected" : "" ?> value="A-">A-</option>
                            <option <?= $SearchBloodGroup == 'B+' ? "selected" : "" ?> value="B+">B+</option>
                            <option <?= $SearchBloodGroup == 'B-' ? "selected" : "" ?> value="B-">B-</option>
                            <option <?= $SearchBloodGroup == 'AB+' ? "selected" : "" ?> value="AB-">AB-</option>
                            <option <?= $SearchBloodGroup == 'AB-' ? "selected" : "" ?> value="AB+">AB+</option>
                            <option <?= $SearchBloodGroup == 'O+' ? "selected" : "" ?> value="O+">O+</option>
                            <option <?= $SearchBloodGroup == 'O-' ? "selected" : "" ?> value="O-">O-</option>
                        </select>

                        <select class="form-select me-sm-2" aria-label="Default select example" name="searchGender">
                            <option <?= $SearchGender == '' ? "selected" : "" ?> value="">Gender</option>
                            <option <?= $SearchGender == 'Male' ? "selected" : "" ?> value="Male">Male</option>
                            <option <?= $SearchGender == 'Female' ? "selected" : "" ?> value="Female">Female</option>
                        </select>

                        <input class="form-control me-sm-2" type="search" placeholder="Search" name="search"
                            value="<?= $Search ?>">
                        <button class="btn btn-warning my-2 my-sm-0" type="submit" title="Search Donors"
                            style="color: red;"><i class="bi bi-search"></i></button>
                    </form>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-bordered ">
                    <thead class="table-danger">
                        <tr>
                            <th>SN</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>BloodGroup</th>
                            <th>Age</th>
                            <th>Gender</th>
                            <th>Phone</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-light">
                        <?php
                        $sn = 0;
                        foreach ($result as $donor):
                            ?>
                            <tr>
                                <td>
                                    <?= ++$sn ?>
                                </td>
                                <td>
                                    <?= $donor['Name'] ?>
                                </td>
                                <td>
                                    <?= $donor['Address'] ?>
                                </td>
                                <td>
                                    <?= $donor['BloodGroup'] ?>
                                </td>
                                <td>
                                    <?= $donor['Age'] ?>
                                </td>
                                <td>
                                    <?= $donor['Gender'] ?>
                                </td>
                                <td>
                                    <?= $donor['Phone'] ?>
                                </td>
                                <td class="d-flex">
                                    <a class="btn btn-success  me-sm-2" title="Edit"
                                        href="/user/donor/editDonor.php?id=<?= $donor['ID'] ?>&CampaignId=<?= $CampaignID ?>"><i
                                            class="bi bi-pencil-square"></i></a>
                                    <form action="/user/donor/deleteDonor.php" method="POST">
                                        <input type="hidden" name="id" value="<?= $donor['ID'] ?>">
                                        <button class="btn btn-danger sm-2" title="Delete"><i
                                                class="bi bi-trash-fill"></i></button>
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
require_once('../../includes/footer.php');
?>