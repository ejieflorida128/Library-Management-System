<?php
          session_start(); 
          include("conn.php");

              if($_SERVER['REQUEST_METHOD'] == "POST"){
                    $password = $_POST['password'];
                    $Cpassword = $_POST['Cpassword'];

                            if($password == $Cpassword){

                                        $id = $_SESSION['uniqueId'];

                                        $sqlUpdate = "UPDATE accounts SET password = '$password' WHERE id = $id";
                                        mysqli_query($conn,$sqlUpdate);
                                        
                                        header("Location: login.php");
                            }else{
                                header("Location: error.php");
                            }   
              }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<!-- Modal -->
<div class="modal fade" id="forgotPasswordModal" tabindex="-1" role="dialog" aria-labelledby="forgotPasswordModalLabel" aria-hidden="true" style="margin-top: 5%;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="forgotPasswordModalLabel">Forgot Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="reset_password.php" method="post">
                    <div class="form-group">
                        <label for="password">New Password: </label>
                        <input type="text" class="form-control" id="password" name="password" placeholder="Your New Password" required>
                        <label for="Cpassword">Confirm Password: </label>
                        <input type="text" class="form-control" id="Cpassword" name="Cpassword" placeholder="Confirm New Password" required>
                      
                    </div>
                    <button type="submit" class="btn btn-success">Confirm Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- Include jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    // Automatically show the modal when the page loads and prevent closing by clicking outside or pressing the Esc key
    $(document).ready(function() {
        $('#forgotPasswordModal').modal({
            backdrop: 'static', // Prevents modal from closing when clicking outside
            keyboard: false     // Prevents modal from closing with the Esc key
        });
        $('#forgotPasswordModal').modal('show');
    });

              
</script>

</body>
</html>