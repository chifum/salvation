<?php
require_once'config.php';
$conn = mysqli_connect(servername, username, password, dbname);
if($conn->connect_error) {
    die("Could not connect " . mysqli_connect_error($conn));
}
?>