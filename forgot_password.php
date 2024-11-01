<?php
session_start();
include("conn.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $fullname = $_POST['fullname'];
    $gmail = $_POST['gmail'];
    $number = $_POST['number'];

    // Query to select all matching entries
    $sqlCheckDb = "SELECT * FROM accounts";
    $queryCheckDb = mysqli_query($conn, $sqlCheckDb);

    $matchFound = false; // Flag to track if a match is found

    while ($sqlValue = mysqli_fetch_assoc($queryCheckDb)) {
        if ($fullname == $sqlValue['fullname'] && $gmail == $sqlValue['gmail'] && $number == $sqlValue['number']) {
           $_SESSION['uniqueId'] = $sqlValue['id'];
            $matchFound = true;
            header("Location: reset_password.php?id=$id");
            exit(); // Ensure no further code runs after the redirect
        }
    }

    // If no match was found, redirect to invalidRecovery.php
    if (!$matchFound) {
        header("Location: invalidRecovery.php");
        exit(); // Ensure no further code runs after the redirect
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
               
            </div>
            <div class="modal-body">
                <form action="forgot_password.php" method="post">
                    <div class="form-group">
                        <label for="fullname">Enter your Fullname</label>
                        <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Your Fullname" required>
                        <label for="gmail">Enter your Gmail</label>
                        <input type="email" class="form-control" id="gmail" name="gmail" placeholder="Your Gmail" required>
                        <label for="number">Enter your Number</label>
                        <input type="number" class="form-control" id="number" name="number" placeholder="Your Number" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Check Account</button>
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
