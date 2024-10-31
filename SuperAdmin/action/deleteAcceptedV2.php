<?php
    include("../../conn.php");

    $id = $_GET['id'];

    $sql = "DELETE FROM accounts WHERE id = $id";
    mysqli_query($conn,$sql);


    header("Location: ../pendingAdmin.php");
    
?>