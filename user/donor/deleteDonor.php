<?php
require_once('../../includes/connection.php');
require_once('../../includes/functions.php');

if (!isset($_SESSION['user']) || ($_SESSION['user'] == null)) {
    header('Location: /login.php');
}
$donorId = $_POST['id'];

if (isPost()) {
    $connection = ConnectionHelper::getConnection();

    //CampaignID paila tannu paryo kina bhane delete query le pailai id delete gardina sakcha
    $query1 = "select CampaignID from tbl_donor where ID = :id";
    $statement = $connection->prepare($query1);
    $statement->bindParam('id', $donorId);
    $statement->execute();

    $CampaignID = $statement->fetch();

    $query = "delete from tbl_donor where ID=:id";
    $statement = $connection->prepare($query);
    $statement->bindParam('id', $donorId);
    $statement->execute();

    header('Location: /user/donor/?CampaignId=' . $CampaignID['CampaignID']);
}

?>