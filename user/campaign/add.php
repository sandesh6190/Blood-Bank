<?php
require_once('../../includes/themeheader.php');
require_once('../../includes/navbar.php');
require_once('../../includes/connection.php');
require_once('../../includes/functions.php');

if (!isset($_SESSION['user']) || ($_SESSION['user'] == null)) {
    header('Location: /login.php');
}

if (isPost()) {
    $Name = $_POST['inputName'];
    $Address = $_POST['inputAddress'];
    $OrgName = $_POST['inputOrgName'];
    $Date = $_POST['inputDate'];

    $connection = ConnectionHelper::getConnection();
    $query = "insert into tbl_campaign (Name,Address,OrgName,Date) values(:name,:address,:orgName,:date)";
    $statement = $connection->prepare($query);
    $statement->bindParam('name', $Name);
    $statement->bindParam('address', $Address);
    $statement->bindParam('orgName', $OrgName);
    $statement->bindParam('date', $Date);
    $statement->execute();
    $result = $statement->rowCount();
    if ($result > 0) {
        echo "Data inserted";
        header('Location: /user/campaign/');
    } else
        echo "Data not inserted";
}
?>
<form action="" method="POST">
    <div class="container mt-4">
        <div class="card shadow-lg">
            <div class="card-header" style="text-align: center;">
                <h3 class="card-title">Add Campaign</h3>
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
                        <label for="inputOrgName" class="form-label">Organizer Name</label>
                        <input type="text" class="form-control" name="inputOrgName" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="inputDate" class="form-label">Date</label>
                        <input type="date" class="form-control" name="inputDate" required>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-danger w-100" type="submit">Save</button>
            </div>
        </div>
    </div>
</form>

<?php
require_once('../../includes/footer.php');
?>