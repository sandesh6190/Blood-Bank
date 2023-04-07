<?php
require_once('includes/functions.php'); //function vitra session_start xa

if (isPost()) {
    session_destroy();
    header("Location: /index.php");
}

?>