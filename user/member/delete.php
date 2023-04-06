<?php
require_once('../../includes/connection.php');
require_once('../../includes/functions.php');

if (!isset($_SESSION['user']) || ($_SESSION['user'] == null)) {
    header('Location: /login.php');
}
$memberId = $_POST['id'];

if (isPost()) {
    $connection = ConnectionHelper::getConnection();
    $query = "delete from tbl_member where ID=:id";
    $statement = $connection->prepare($query);
    $statement->bindParam('id', $memberId);
    $statement->execute();
    header('Location: /user/member/');
}

?>