<?php
require_once('../../includes/connection.php');
require_once('../../includes/functions.php');

if (!isset($_SESSION['user']) || ($_SESSION['user'] == null)) {
    header('Location: /login.php');
}

$CampaignId = $_POST['id'];

if (isPost()) {
    $connection = ConnectionHelper::getConnection();
    $query = "select count(*) from tbl_donor where CampaignID = :id";
    $statement = $connection->prepare($query);
    $statement->bindParam('id', $CampaignId);
    $statement->execute();
    $donorCount = $statement->fetchColumn();


    if ($donorCount == 0) {
        $query = "delete from tbl_campaign  where ID = :id";
        $statement = $connection->prepare($query);
        $statement->bindParam('id', $CampaignId);
        $statement->execute();
    } else {
        echo "Campaign can't be deleted!";
    }

    header('Location: /user/campaign/');
}

?>