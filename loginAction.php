<?php
    include("conn.php");

    if($_SERVER['REQUEST_METHOD'] == "POST"){

        $gmail = $_POST['gmail'];
        $password = $_POST['password'];

        if($gmail = "SuperAdmin" && $password = "SuperAdmin"){
            header("Location: SuperAdmin/superAdmin.php");
        }else{
            $checkIfExist = "SELECT * FROM admin_account";
            $queryIfExist = mysqli_query($conn,$checkIfExist);
    
            while($getData = mysqli_fetch_assoc($queryIfExist)){
                    if($gmail == $getData['gmail']){
                            if($password == $getData['password']){
                                    header("Location: Admin/dashboard.php");
                            }else{  
                                  header("Location: modals/loginWrongPass.php");
                            }
                    }else{
                        header("Location: modals/loginNoAccount.php");
                    }
            }
        }

      

    }

?>