<?php
require_once('includes/connection.php');
require_once('includes/functions.php');

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
    $Status = "Requested";

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
        echo "Member Request Sent";

        header('Location: /index.php');
    } else
        echo "Sorry!";
}
?>