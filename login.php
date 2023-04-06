<?php
require_once('header.php');
require_once('includes/connection.php');
require_once('includes/functions.php');
// require_once('includes/navbar.php');

//yadi session xa (login gareko xa) vane dashboard ma janxa
if (isset($_SESSION['user'])) {
    header('Location: /user/member/');
}

if (isPost()) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $connection = ConnectionHelper::getConnection();
    $query = "select * from user where username = :username";
    $statement = $connection->prepare($query);
    $statement->bindParam('username', $username);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        if (password_verify($password, $result['Password'])) {
            if ($result['Status'] == "Active") {
                //session creation process
                //session_start();
                //$_SESSION['sessionName'] = "./..";   session set garne tarika
                //$SESSION['sessionName'] session get garne tarika
                session_start();
                $_SESSION['user'] = $result;
                header('Location: /user/member/');

            } else {
                echo "You are not active. Please contact to admin";
            }
        } else {
            echo "password donot match";
        }
    } else {
        echo "username doesnot match";
    }
}
?>

<div class="background">
    <div class="shape"></div>
    <div class="shape"></div>
</div>
<form action="" method="post">
    <h3>Login Here</h3>

    <label for="username">Username</label>
    <input type="text" placeholder="Email or Phone" id="username" name="username" required>

    <label for="password">Password</label>
    <input type="password" placeholder="Password" id="password" name="password" required>

    <button>Log In</button>
</form>


<!-- <div class="container">
<div class="card my-5">
    <div class="card-header">
        <h2 class="card-title">Login</h2>
    </div>
    <div class="card-body">
            <div class="mb-4">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" class="form-control">
            </div>
            <div class="mb-4">
                <label for="password">Password</label>
                <input type="text" id="password" name="password" class="form-control">
            </div>
    </div>
    <div class="card-footer">
    <button class="btn btn-primary">Login</button>
    </div>
</div>
</div>
</form> -->