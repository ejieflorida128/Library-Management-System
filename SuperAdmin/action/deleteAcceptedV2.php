<?php
    include("../../conn.php");

    $id = $_GET['id'];

    $sql = "DELETE FROM admin_account WHERE id = $id";
    mysqli_query($conn,$sql);


    header("Location: ../pendingAdmin.php");
    
?>