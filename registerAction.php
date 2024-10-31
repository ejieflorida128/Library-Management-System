<?php
    include("conn.php");

    if($_SERVER['REQUEST_METHOD'] == "POST"){
            $fullname = $_POST['fullname'];
            $gmail = $_POST['gmail'];
            $password = $_POST['password'];

                $checkIfExist = "SELECT * FROM admin_account";
                $queryIfExist = mysqli_query($conn,$checkIfExist);

                $ifExist = 0;

                while($checkNow = mysqli_fetch_assoc($queryIfExist)){
                        if($gmail == $checkNow['gmail']){
                             $ifExist++;
                        }   
                }

                if($ifExist > 0){
                    // should add Unsuccess toast
                    header("Location: modals/registerUnsuccess.php");
                }else{
                    // should add success toast
                    $insertQuery = "INSERT INTO admin_account (fullname,gmail,password,status) VALUES ('$fullname','$gmail','$password','Pending')";
                    mysqli_query($conn,$insertQuery);

                    header("Location: modals/registerSuccess.php");
                }

               
              
    }
?>