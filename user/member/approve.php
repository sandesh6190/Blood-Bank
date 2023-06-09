<?php
require_once('../../includes/connection.php');
require_once('../../includes/functions.php');

if (!isset($_SESSION['user']) || ($_SESSION['user'] == null)) {
    header('Location: /login.php');
}

$memberId = $_POST['id'];

if (isPost()) {
    $Status = "Approved";
    $connection = ConnectionHelper::getConnection();

    $query = "select * from tbl_member where ID = :id";
    $statement = $connection->prepare($query);
    $statement->bindParam('id', $memberId);
    $statement->execute();
    $member = $statement->fetch();

    $updateQuery = "update tbl_member set Status = :status where ID=:id";
    $statement = $connection->prepare($updateQuery);
    $statement->bindParam('id', $memberId);
    $statement->bindParam('status', $Status);
    $statement->execute();

    addSuccessMessage("Successfully Member Approved");

    header('Location: /user/member/index.php?searchStatus=' . $member['Status']);
}
// else{
//     echo "invalid request type";
// }

?>