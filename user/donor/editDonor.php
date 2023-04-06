<?php
require_once('../../includes/themeheader.php');
require_once('../../includes/navbar.php');
require_once('../../includes/connection.php');
require_once('../../includes/functions.php');

if (!isset($_SESSION['user']) || ($_SESSION['user'] == null)) {
    header('Location: /login.php');
}


function getDonorById($id)
{
    $connection = ConnectionHelper::getConnection();
    $query = "select * from tbl_donor where ID = :id";
    $statement = $connection->prepare($query);
    $statement->bindParam('id', $id);
    $statement->execute();
    $result = $statement->fetch();
    return $result;
}

//getting id from parameter/url
$donorId = getParam('id');

$donor = getDonorById($donorId);

$CampaignID = getParam('CampaignId');


if (isPost()) {
    $Name = $_POST['inputName'];
    $Address = $_POST['inputAddress'];
    $Phone = $_POST['inputPhone'];
    $Age = $_POST['inputAge'];
    $Gender = $_POST['inputGender'];
    $BloodGroup = $_POST['inputBloodGroup'];

    $connection = ConnectionHelper::getConnection();
    $query = "update tbl_donor set Name = :name, Address =:address, Phone =:phone, Age=:age, Gender =:gender, BloodGroup =:bloodGroup where ID = :id";
    $statement = $connection->prepare($query);
    $statement->bindParam('name', $Name);
    $statement->bindParam('address', $Address);
    $statement->bindParam('phone', $Phone);
    $statement->bindParam('age', $Age);
    $statement->bindParam('gender', $Gender);
    $statement->bindParam('bloodGroup', $BloodGroup);
    $statement->bindParam('id', $donorId);
    $statement->execute();

    $query1 = "select CampaignID from tbl_donor where ID = :id";
    $statement = $connection->prepare($query1);
    $statement->bindParam('id', $donorId);
    $statement->execute();

    $CampaignID = $statement->fetch();
    header('Location: /user/donor/?CampaignId=' . $CampaignID['CampaignID']);
    // $CampaignID = $statement->fetchColumn();
    // header('Location: /user/campaign/donor/?CampaignId=' . $CampaignID);
}
?>

<form method="post">

    <div class="container mt-4">
        <div class="card shadow-lg">
            <div class="card-header">
                <h4 class="card-title text-center text-primary text-uppercase">Edit Donor Details</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="inputName" class="form-label">Name</label>
                        <input type="text" class="form-control" name="inputName" value="<?= $donor['Name'] ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="inputAddress" class="form-label">Address</label>
                        <input type="text" class="form-control" name="inputAddress" value="<?= $donor['Address'] ?>"
                            required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="inputAge" class="form-label">Age</label>
                        <input type="number" class="form-control" name="inputAge" value="<?= $donor['Age'] ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="inputPhone" class="form-label">Phone Number</label>
                        <input type="number" class="form-control" name="inputPhone" value="<?= $donor['Phone'] ?>"
                            required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="inputGender" class="form-label">Gender</label><br>

                        <input class="form-check-input" type="radio" name="inputGender" id="" radio
                            <?= $donor['Gender'] == 'Male' ? "checked" : "" ?> value="Male">
                        <label for="inputGender" class="form-label">Male</label>
                        <input class="form-check-input" type="radio" name="inputGender" id="" radio
                            <?= $donor['Gender'] == 'Female' ? "checked" : "" ?> value="Female">
                        <label for="inputGender" class="form-label">Female</label>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="inputBloodGroup" class="form-label">Blood Group</label>
                        <select class="form-select" aria-label="Default select example" name="inputBloodGroup" required>
                            <option <?= $donor['BloodGroup'] == '' ? "selected" : "" ?> value=""> </option>
                            <option <?= $donor['BloodGroup'] == 'A+' ? "selected" : "" ?> value="A+">A+</option>
                            <option <?= $donor['BloodGroup'] == 'A-' ? "selected" : "" ?> value="A-">A-</option>
                            <option <?= $donor['BloodGroup'] == 'B+' ? "selected" : "" ?> value="B+">B+</option>
                            <option <?= $donor['BloodGroup'] == 'B-' ? "selected" : "" ?> value="B-">B-</option>
                            <option <?= $donor['BloodGroup'] == 'AB-' ? "selected" : "" ?> value="AB-">AB-</option>
                            <option <?= $donor['BloodGroup'] == 'AB+' ? "selected" : "" ?> value="AB+">AB+</option>
                            <option <?= $donor['BloodGroup'] == 'O+' ? "selected" : "" ?> value="O+">O+</option>
                            <option <?= $donor['BloodGroup'] == 'O-' ? "selected" : "" ?> value="O-">O-</option>
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
require_once('../../includes/footer.php')
    ?>