<?php
    session_start();
    unset($_SESSION['user_hospital']);
    session_destroy();
    header('Location: login_h.php');
?>