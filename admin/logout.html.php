<?php
session_start();
if (isset($_SESSION['key'])) {
    unset($_SESSION['key']);
    session_destroy();
}

header("Location:../login/");
die();
