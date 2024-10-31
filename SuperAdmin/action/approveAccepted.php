<?php
    include("../../conn.php");

    $id = $_GET['id'];

    $sql = "UPDATE admin_account SET status = 'Confirmed' WHERE id = $id";
    mysqli_query($conn,$sql);


    header("Location: ../pendingAdmin.php");
    
?>