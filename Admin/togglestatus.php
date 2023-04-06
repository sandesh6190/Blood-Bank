<?php
require_once('../includes/connection.php');
require_once('../includes/functions.php');

if (!isset($_SESSION['user']) || ($_SESSION['user'] == null)) {
    header('Location: /login.php');
}
$userId = $_POST['userid'];
if (isPost()) {
    $deactivate = "Deactivate";
    $active = "Active";
    $connection = ConnectionHelper::getConnection();
    $query = "select * from user where ID = :id";
    $statement = $connection->prepare($query);
    $statement->bindParam('id', $userId);
    $statement->execute();
    $user = $statement->fetch();

    $updateQuery = "update user set Status = :toggle where ID=:id";
    $statement = $connection->prepare($updateQuery);
    $statement->bindParam('id', $userId);
    if ($user['Status'] == "Active") {
        $statement->bindParam('toggle', $deactivate);
    } else {
        $statement->bindParam('toggle', $active);
    }
    $statement->execute();

    header('Location: /Admin/users.php?searchStatus=' . $user['Status']);
}
?>