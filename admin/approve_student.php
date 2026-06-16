<?php
session_start();
include "../includes/conn.php";

if(!isset($_SESSION['admin_login'])){
    header("Location: admin_login.php");
    exit();
}

if(isset($_GET['id'])){
    $id = mysqli_real_escape_string($connect, $_GET['id']);

    $query = "UPDATE items SET status='Approved' WHERE id='$id'";
    mysqli_query($connect, $query);

    header("Location: dashboard.php?item=approved");
    exit();
}else{
    header("Location: dashboard.php");
    exit();
}
?>