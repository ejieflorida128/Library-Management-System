<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .modal-backdrop {
            background: red;
        }

        /* Preloader styles */
        #preloader {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #fff;
            z-index: 9999999;
        }

        .loader {
            top: 50%;
            width: 50px;
            height: 50px;
            border-radius: 100%;
            position: relative;
            margin: 0 auto;
        }

        #loader-1:before,
        #loader-1:after {
            content: "";
            position: absolute;
            top: -10px;
            left: -10px;
            width: 100%;
            height: 100%;
            border-radius: 100%;
            border: 7px solid transparent;
            border-top-color: #3c9cfd;
        }

        #loader-1:before {
            z-index: 100;
            animation: spin 2s infinite;
        }

        #loader-1:after {
            border: 7px solid #fafafa;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

        /* Vibrate animation for modal */
        @keyframes vibrate {
            0% { transform: translate(0); }
            20% { transform: translate(-2px, 0); }
            40% { transform: translate(2px, 0); }
            60% { transform: translate(-2px, 0); }
            80% { transform: translate(2px, 0); }
            100% { transform: translate(0); }
        }

        /* Box shadow for modal */
        .modal-content {
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
            animation: vibrate 0.5s linear infinite; /* Apply vibration animation */
        }
    </style>
</head>
<body>

<div id="preloader">
    <div class="loader" id="loader-1"></div>
</div>

<script>
    // Hide the preloader after 2 seconds (2000 milliseconds)
    setTimeout(function() {
        document.getElementById("preloader").style.display = "none";
    }, 2000);
</script>

<div class="div">
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true" style="margin-top: 10%;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">System Notice!</h5>
                </div>
                <div class="modal-body">
                    There was an issue creating your account! This email is already in use. Please try with a different email address.
                </div>
                <div class="modal-footer">
                    <a href="../login.php" class="btn btn-danger">BACK TO LOGIN</a>
                </div>
            </div>
        </div>
    </div>

    

    <script>
        var myModal = new bootstrap.Modal(document.getElementById('myModal'), {
            backdrop: 'static', 
            keyboard: false
        });
        myModal.show();
      
    </script>
</div>

</body>
</html>
