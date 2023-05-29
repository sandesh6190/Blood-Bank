<?php
require_once('../../includes/connection.php');
require_once('../../includes/functions.php');

if (!isset($_SESSION['user']) || ($_SESSION['user'] == null)) {
    header('Location: /login.php');
}

if (isPost()) {
    $Name = $_POST['inputName'];
    $Address = $_POST['inputAddress'];
    $Phone = $_POST['inputPhone'];
    $Email = $_POST['inputEmail'];
    $Gender = $_POST['inputGender'];
    $BloodGroup = $_POST['inputBloodGroup'];
    $LastDate = $_POST['inputLastDate'];
    $Status = "Approved";

    $connection = ConnectionHelper::getConnection();
    $query = "insert into tbl_member (Name,Address,Phone,Email,Gender,BloodGroup,LastDate,Status) values(:name,:address,:phone,:email,:gender,:bloodGroup,:lastDate,:status)";
    $statement = $connection->prepare($query);
    $statement->bindParam('name', $Name);
    $statement->bindParam('address', $Address);
    $statement->bindParam('phone', $Phone);
    $statement->bindParam('email', $Email);
    $statement->bindParam('gender', $Gender);
    $statement->bindParam('bloodGroup', $BloodGroup);
    $statement->bindParam('lastDate', $LastDate);
    $statement->bindParam('status', $Status);
    $statement->execute();
    $result = $statement->rowCount();
    if ($result > 0) {
        addSuccessMessage("Member Added");

        header('Location: /user/member/');
    } else
        addErrorMessage("Unfortunately, Member didn't add");
}

require_once('../../includes/themeheader.php');
require_once('../../includes/navbar.php');
?>

<form method="post">

    <div class="container mt-4">
        <div class="card shadow-lg">
            <div class="card-header">
                <h4 class="card-title text-center text-primary text-uppercase">Membership Form</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="inputName" class="form-label">Name</label>
                        <input type="text" class="form-control" name="inputName" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="inputAddress" class="form-label">Address</label>
                        <input type="text" class="form-control" name="inputAddress" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="inputEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" name="inputEmail" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="inputPhone" class="form-label">Phone Number</label>
                        <input type="number" class="form-control" name="inputPhone" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="inputGender" class="form-label">Gender</label><br>

                        <input class="form-check-input" type="radio" name="inputGender" id="" radio value="Male">
                        <label for="inputGender" class="form-label">Male</label>
                        <input class="form-check-input" type="radio" name="inputGender" id="" radio value="Female">
                        <label for="inputGender" class="form-label">Female</label>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="inputBloodGroup" class="form-label">Blood Group</label>
                        <select class="form-select" aria-label="Default select example" name="inputBloodGroup" required>
                            <option selected value=""> </option>
                            <option value="A+">A+</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B-">B-</option>
                            <option value="AB-">AB-</option>
                            <option value="AB+">AB+</option>
                            <option value="O+">O+</option>
                            <option value="O-">O-</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="inputDate" class="form-label">Last Date</label>
                        <input type="date" class="form-control" name="inputLastDate" required>
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