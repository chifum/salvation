<?php
session_start();
require_once'../config/conn.php';
$conn = mysqli_connect(servername, username, password, dbname);


if(session_destroy()) {
    unset($_SESSION['username']);
    unset($_SESSION['id']);
    header("location:login.php");
}
