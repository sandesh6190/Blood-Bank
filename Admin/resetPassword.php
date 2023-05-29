<?php
require_once("../includes/connection.php");
require_once("../includes/functions.php");

if (!isset($_SESSION['user']) || ($_SESSION['user'] == null)) {
    header('Location: /login.php');
}

if (isPost()) {
    $userID = $_POST['userid'];
    $NewPassword = $_POST['NewPassword'];
    $ConfirmPassowrd = $_POST['ConfirmPassword'];
    if (strcmp($NewPassword, $ConfirmPassowrd) == 0) {
        $connection = ConnectionHelper::getConnection();
        $PwdHashed = password_hash($NewPassword, PASSWORD_DEFAULT);
        $query = "update user set Password = :password where ID = :id";
        $statement = $connection->prepare($query);
        $statement->bindParam('password', $PwdHashed);
        $statement->bindParam('id', $userID);
        $statement->execute();
        $result = $statement->rowCount();
        if ($result > 0) {
            header('Location: /user/member/');
            addSuccessMessage("Successfully User Edited");
        }
    } else {
        header('Location: /user/member/');
        addErrorMessage("Unfortunately, Password didn't change");
    }
}

?>