<?php

require_once('includes/connection.php');

function existingSuperAdmin()
{
    $defaultUsername = "super.admin";
    $connection = ConnectionHelper::getConnection();
    $query = "select count(*) from user where username = :username";
    $statement = $connection->prepare($query);
    $statement->bindParam('username', $defaultUsername);
    $statement->execute();
    $result = $statement->fetchColumn();
    if ($result == 0) {
        return false;
    }
    return true;
}

function seedSuperAdmin()
{
    $defaultName = "Super Admin";
    $defaultRole = "Admin";
    $defaultUsername = "super.admin";
    $defaultPassword = "Admin@123";
    $defaultStatus = "Active";
    $connection = ConnectionHelper::getConnection();
    $query = "insert into user (Name,Role,Username,Password,Status) values (:name,:role,:username,:passwordHash,:status)";
    $defaultPasswordHash = password_hash($defaultPassword, PASSWORD_DEFAULT);
    $statement = $connection->prepare($query);
    $statement->bindParam('name', $defaultName);
    $statement->bindParam('role', $defaultRole);
    $statement->bindParam('username', $defaultUsername);
    $statement->bindParam('passwordHash', $defaultPasswordHash);
    $statement->bindParam('status', $defaultStatus);
    $statement->execute();
    $result = $statement->rowCount();
    if ($result > 0) {
        return true;
    }
    return false;
}

if (existingSuperAdmin()) {
    echo "Already Exist";
} else {
    if (seedSuperAdmin()) {
        echo "Seed Successfull";
    }
}
?>