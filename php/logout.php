<?php
    unset($_SESSION['usersname']);
    session_destroy();
    header("Location: login.php");
?>