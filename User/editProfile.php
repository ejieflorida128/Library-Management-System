<?php
session_start();
include("../conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    $fullname = $_POST['fullname'];
    $gmail = $_POST['gmail'];
    $password = $_POST['password'];
    $number = $_POST['number'];
    $address = $_POST['address'];

   
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
        $targetDir = "../profile_pictures/";
        $fileName = basename($_FILES["profile_picture"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $targetFilePath);
        
      
        $_SESSION['profile_picture'] = $targetFilePath;
    }


    $_SESSION['fullname'] = $fullname;
    $_SESSION['gmail'] = $gmail;
    $_SESSION['password'] = $password;
    $_SESSION['number'] = $number;
    $_SESSION['address'] = $address;
  

    $sql = "UPDATE accounts SET fullname=?, gmail=?, password=?, number=?, address=?, profile_picture=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssi", $fullname, $gmail, $password, $number, $address, $_SESSION['profile_picture'], $_SESSION['id']);
    $stmt->execute();
    
    header("Location: profile.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Library Management System</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <link href="img/favicon.ico" rel="icon">


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
   
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


 
    <link href="template/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="template/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <link href="template/css/bootstrap.min.css" rel="stylesheet">

    <link href="template/css/style.css" rel="stylesheet">
    <style>
        body{

    color: #1a202c;
    text-align: left;
    background-color: #e2e8f0;    
    overflow: hidden; 
}
.main-body {
    padding: 15px;
}
.card {
    box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);
}

.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0 solid rgba(0,0,0,.125);
    border-radius: .25rem;
}

.card-body {
    flex: 1 1 auto;
    min-height: 1px;
    padding: 1rem;
}

.gutters-sm {
    margin-right: -8px;
    margin-left: -8px;
}

.gutters-sm>.col, .gutters-sm>[class*=col-] {
    padding-right: 8px;
    padding-left: 8px;
}
.mb-3, .my-3 {
    margin-bottom: 1rem!important;
}

.bg-gray-300 {
    background-color: #e2e8f0;
}
.h-100 {
    height: 100%!important;
}
.shadow-none {
    box-shadow: none!important;
}
    </style>
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
      
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
                    <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>

                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        setTimeout(function() {
                            document.getElementById("spinner").classList.remove("show");
                        }, 2000);
                    });

        </script>
      
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a href="index.html" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary">Library MS</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="<?php echo $_SESSION['profile_picture']; ?>" alt="" style="width: 40px; height: 40px; border: 1px solid grey;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0"><?php echo $_SESSION['fullname']; ?></h6>
                        <span><?php echo $_SESSION['type']; ?></span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                <a href="dashboard.php" class="nav-item nav-link"><i class="fa fa-home me-2"></i>Dashboard</a>
                <a href="profile.php" class="nav-item nav-link active"><i class="fa fa-user me-2"></i>Profile</a>
                <a href="books.php" class="nav-item nav-link"><i class="fa fa-book me-2"></i>Available Books</a>
                <a href="logs.php" class="nav-item nav-link"><i class="fa fa-download me-2"></i>My Library</a>

                
                   
                </div>
            </nav>
        </div>
     
        <div class="content">
          
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                      
                       
                    </div>
                    <div class="nav-item dropdown">
                       
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="<?php  echo  $_SESSION['profile_picture']; ?>" alt="" style="width: 40px; height: 40px; border: 1px solid grey;">
                            <i class="fa fa-edit" style="color: grey; font-size: 12px;"></i>

                            <span class="d-none d-lg-inline-flex"><?php echo $_SESSION['fullname']; ?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                          
                            <a href="../index.php" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
       
            <div class="container-fluid pt-4 px-4">
            <div class="container">
                    <H3 style = "color: grey; font-weight: bolder;"> Edit Profile</H3>
                    <form action="editProfile.php" method = "post" enctype="multipart/form-data">
                    <div class="main-body">                       
                            <div class="row gutters-sm">
                            <div class="col-md-4 mb-3">
                            <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex flex-column align-items-center text-center">
                                     
                                        <img id="profileImagePreview" src="<?php echo $_SESSION['profile_picture']; ?>" alt="Admin"  style = "height: 150px; width: 150px; border-radius: 50%;">
                                        <div class="mt-3">
                                            <h4><?php echo $_SESSION['fullname']; ?></h4>
                                            <p class="text-secondary mb-1"><?php echo $_SESSION['gmail']; ?></p>
                                            
                                           
                                            <div style="margin-top: 20px;">
                                            <label class="btn btn-primary" for="profile_picture">
                                                <i class="fa fa-pencil-alt"></i>
                                            </label>
                                            <input type="file" name="profile_picture" id="profile_picture" hidden onchange="previewProfileImage(event)">
                                            <input type="submit" value="Submit Changes" class="btn btn-success">
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    </div>

                                    <script>
                                    function previewProfileImage(event) {
                                        const file = event.target.files[0];
                                        if (file) {
                                        const reader = new FileReader();
                                        reader.onload = function(e) {
                                            document.getElementById('profileImagePreview').src = e.target.result;
                                        };
                                        reader.readAsDataURL(file);
                                        }
                                    }
                                    </script>

                            
                            </div>
                            <div class="col-md-8">
                                <div class="card mb-3">
                                <div class="card-body">
                                    <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Full Name</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name = "fullname" value = "<?php echo $_SESSION['fullname'];  ?>" class = "form-control">
                                    </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Gmail</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                    <input type="text" name = "gmail" value = "<?php echo $_SESSION['gmail'];?>" class = "form-control">
                                   
                                    </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Password</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                    <input type="text" name = "password" value = "<?php echo $_SESSION['password'];?>" class = "form-control">
                                 
                                    </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Mobile Number</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                    <?php  
                                            if(empty($_SESSION['number'])) {
                                                echo '<input type="text" name="number" value="no information provided!" class="form-control">';
                                            } else {
                                              
                                                echo '<input type="text" name="number" value="' . $_SESSION['number'] . '" class="form-control">';
                                            }
                                            ?>
                                    </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Address</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                    <?php  
                                        if(empty($_SESSION['address'])) {
                                            echo '<textarea name="address" class="form-control">no information provided!</textarea>';
                                        } else {
                                            
                                            echo '<textarea name="address" class="form-control">' . htmlspecialchars($_SESSION['address']) . '</textarea>';
                                        }
                                        ?>

                                    </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                    
                                    </div>
                                </div>
                                </div>

                            



                            </div>
                            </div>

                        </div>
                        </div>
                    </form>
            </div>
          
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="../index.php">Library Management System by: Group LMS</a>, All Right Reserved. 
                        </div>
                        <div class="col-12 col-sm-6 text-center text-sm-end">
                          
                        </div>
                    </div>
                </div>
            </div>
        
        </div>
    
    </div>

   
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="template/lib/chart/chart.min.js"></script>
    <script src="template/lib/easing/easing.min.js"></script>
    <script src="template/lib/waypoints/waypoints.min.js"></script>
    <script src="template/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="template/lib/tempusdominus/js/moment.min.js"></script>
    <script src="template/lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="template/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

  
    <script src="template/js/main.js"></script>
</body>

</html>