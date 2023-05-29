<?php
require_once('../../includes/connection.php');
require_once('../../includes/functions.php');

if (!isset($_SESSION['user']) || ($_SESSION['user'] == null)) {
    header('Location: /login.php');
}

$campaignId = getParam('id');
function getCampaign($cmpId)
{
    $connection = ConnectionHelper::getConnection();
    $query = "select *from tbl_campaign where ID = :id";
    $statement = $connection->prepare($query);
    $statement->bindParam('id', $cmpId);
    $statement->execute();
    $result = $statement->fetch();
    return $result;
}

$campaign = getCampaign($campaignId);

if (isPost()) {
    $Name = $_POST['inputName'];
    $Address = $_POST['inputAddress'];
    $OrgName = $_POST['inputOrgName'];
    $Date = $_POST['inputDate'];

    $connection = ConnectionHelper::getConnection();
    $query = "update tbl_campaign set Name = :name, Address=:address, OrgName =:orgName, Date = :date where ID = :id";
    $statement = $connection->prepare($query);
    $statement->bindParam('id', $campaignId);
    $statement->bindParam('name', $Name);
    $statement->bindParam('address', $Address);
    $statement->bindParam('orgName', $OrgName);
    $statement->bindParam('date', $Date);
    $statement->execute();
    $result = $statement->rowCount();
    if ($result > 0) {
        addSuccessMessage("Successfully Campaign Edited");
    } else
        addErrorMessage("Unfortunately, Campaign didn't Edit");
    header('Location: /user/campaign/');
}

require_once('../../includes/themeheader.php');
require_once('../../includes/navbar.php');
?>

<form action="" method="POST">
    <div class="container mt-4">
        <div class="card shadow-lg">
            <div class="card-header" style="text-align: center;">
                <h3 class="card-title">Edit Campaign</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="inputName" class="form-label">Name</label>
                        <input type="text" class="form-control" name="inputName" value=<?= $campaign['Name'] ?> required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="inputAddress" class="form-label">Address</label>
                        <input type="text" class="form-control" name="inputAddress" value=<?= $campaign['Address'] ?>
                            required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="inputOrgName" class="form-label">Organizer Name</label>
                        <input type="text" class="form-control" name="inputOrgName" value=<?= $campaign['OrgName'] ?>
                            required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="inputDate" class="form-label">Date</label>
                        <input type="date" class="form-control" name="inputDate" value=<?= $campaign['Date'] ?> required>
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