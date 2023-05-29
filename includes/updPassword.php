<!-- done by any user -->
<?php
require_once("connection.php");
require_once("functions.php");

if (!isset($_SESSION['user']) || ($_SESSION['user'] == null)) {
    header('Location: /login.php');
} else {
    $userID = $_SESSION['user']['ID'];
}

if (isPost()) {
    $OldPassword = $_POST["OldPassword"];
    $NewPassword = $_POST["NewPassword"];
    $ConfirmPassword = $_POST["ConfirmPassword"];

    $connection = ConnectionHelper::getConnection();
    $query = "select Password from user where ID = :id";
    $statement = $connection->prepare($query);
    $statement->bindParam('id', $userID);
    $statement->execute();
    $userPwd = $statement->fetchColumn();

    if (password_verify($OldPassword, $userPwd)) {
        if (strcmp($NewPassword, $ConfirmPassword) != 0) {
            addErrorMessage("Enter the same password!");
        } else {
            $PwdHashed = password_hash($NewPassword, PASSWORD_DEFAULT);
            $query1 = "update user set Password = :password where ID = :id";
            $statement = $connection->prepare($query1);
            $statement->bindParam('password', $PwdHashed);
            $statement->bindParam('id', $userID);
            $statement->execute();
            $result = $statement->rowCount();
            if ($result > 0) {
                header('Location: /user/member/');
                addSuccessMessage("Password changed Successfully ");
            }
        }
    } else {
        header('Location: /user/member/');
        addErrorMessage("Old Password didn't match");

    }


}
?>