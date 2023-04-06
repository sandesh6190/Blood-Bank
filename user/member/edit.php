<?php
require_once('../../includes/themeheader.php');
require_once('../../includes/navbar.php');
require_once('../../includes/connection.php');
require_once('../../includes/functions.php');

if (!isset($_SESSION['user']) || ($_SESSION['user'] == null)) {
    header('Location: /login.php');
}


function getMemberById($id)
{
    $connection = ConnectionHelper::getConnection();
    $query = "select * from tbl_member where ID = :id";
    $statement = $connection->prepare($query);
    $statement->bindParam('id', $id);
    $statement->execute();
    $result = $statement->fetch();
    return $result;
}

//getting id from parameter/url
$memberId = getParam('id');

$member = getMemberById($memberId);


if (isPost()) {
    $Name = $_POST['inputName'];
    $Address = $_POST['inputAddress'];
    $Phone = $_POST['inputPhone'];
    $Email = $_POST['inputEmail'];
    $Gender = $_POST['inputGender'];
    $BloodGroup = $_POST['inputBloodGroup'];
    $LastDate = $_POST['inputLastDate'];

    $connection = ConnectionHelper::getConnection();
    $query = "update tbl_member set Name = :name, Address =:address, Phone =:phone, Email=:email, Gender =:gender, BloodGroup =:bloodGroup, LastDate = :lastDate where ID = :id";
    $statement = $connection->prepare($query);
    $statement->bindParam('name', $Name);
    $statement->bindParam('address', $Address);
    $statement->bindParam('phone', $Phone);
    $statement->bindParam('email', $Email);
    $statement->bindParam('gender', $Gender);
    $statement->bindParam('bloodGroup', $BloodGroup);
    $statement->bindParam('lastDate', $LastDate);
    $statement->bindParam('id', $memberId);
    $statement->execute();
    $result = $statement->rowCount();
    if ($result > 0) {
        echo "Data updated";
        header('Location: /user/member/');
    } else
        echo "No data updated";
}
?>

<form method="post">

    <div class="container mt-4">
        <div class="card shadow-lg">
            <div class="card-header">
                <h4 class="card-title text-center text-primary text-uppercase">Edit Member Details</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="inputName" class="form-label">Name</label>
                        <input type="text" class="form-control" name="inputName" value="<?= $member['Name'] ?>"
                            required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="inputAddress" class="form-label">Address</label>
                        <input type="text" class="form-control" name="inputAddress" value="<?= $member['Address'] ?>"
                            required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="inputAge" class="form-label">Email</label>
                        <input type="email" class="form-control" name="inputEmail" value="<?= $member['Email'] ?>"
                            required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="inputPhone" class="form-label">Phone Number</label>
                        <input type="number" class="form-control" name="inputPhone" value="<?= $member['Phone'] ?>"
                            required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="inputGender" class="form-label">Gender</label><br>

                        <input class="form-check-input" type="radio" name="inputGender" id="" radio
                            <?= $member['Gender'] == 'Male' ? "checked" : "" ?> value="Male">
                        <label for="inputGender" class="form-label">Male</label>
                        <input class="form-check-input" type="radio" name="inputGender" id="" radio
                            <?= $member['Gender'] == 'Female' ? "checked" : "" ?> value="Female">
                        <label for="inputGender" class="form-label">Female</label>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="inputBloodGroup" class="form-label">Blood Group</label>
                        <select class="form-select" aria-label="Default select example" name="inputBloodGroup" required>
                            <option <?= $member['BloodGroup'] == '' ? "selected" : "" ?> value=""> </option>
                            <option <?= $member['BloodGroup'] == 'A+' ? "selected" : "" ?> value="A+">A+</option>
                            <option <?= $member['BloodGroup'] == 'A-' ? "selected" : "" ?> value="A-">A-</option>
                            <option <?= $member['BloodGroup'] == 'B+' ? "selected" : "" ?> value="B+">B+</option>
                            <option <?= $member['BloodGroup'] == 'B-' ? "selected" : "" ?> value="B-">B-</option>
                            <option <?= $member['BloodGroup'] == 'AB-' ? "selected" : "" ?> value="AB-">AB-</option>
                            <option <?= $member['BloodGroup'] == 'AB+' ? "selected" : "" ?> value="AB+">AB+</option>
                            <option <?= $member['BloodGroup'] == 'O+' ? "selected" : "" ?> value="O+">O+</option>
                            <option <?= $member['BloodGroup'] == 'O-' ? "selected" : "" ?> value="O-">O-</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="inputDate" class="form-label">Last Date</label>
                        <input type="date" class="form-control" name="inputLastDate" value="<?= $member['LastDate'] ?>"
                            required>
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