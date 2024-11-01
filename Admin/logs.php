<?php
    include("../conn.php");
    session_start();


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Library Management System</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">


    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    
  
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

   
    <link href="template/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="template/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

   
    <link href="template/css/bootstrap.min.css" rel="stylesheet">

   
    <link href="template/css/style.css" rel="stylesheet">
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
                <a href="dashboard.php" class="nav-item nav-link "><i class="fa fa-home me-2"></i>Dashboard</a>
                <a href="profile.php" class="nav-item nav-link "><i class="fa fa-user me-2"></i>Profile</a>
                <a href="books.php" class="nav-item nav-link "><i class="fa fa-book me-2"></i>My Books</a>
                <a href="logs.php" class="nav-item nav-link active"><i class="fa fa-download me-2"></i>Out for Lending</a>
                
                
                   
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
                <form class="d-none d-md-flex ms-4" method="GET" action="">
                    <input class="form-control border-0" type="search" name="search" placeholder="Search">
                    
                </form>

                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                      
                       
                    </div>
                    <div class="nav-item dropdown">
                       
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="<?php  echo  $_SESSION['profile_picture']; ?>" alt="" style="width: 40px; height: 40px; border: 1px solid grey;">
                            <span class="d-none d-lg-inline-flex"><?php echo $_SESSION['fullname']; ?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="profile.php" class="dropdown-item">My Profile</a>
                            <a href="../index.php" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
          
            <div class="container-fluid pt-4 px-4">
    <div class="col-12" style="margin-top: 30px;">
        <div class="bg-light rounded h-100 p-4">
            <h6 class="mb-4" style="font-weight: bold; color: #333;">Out for Lending</h6>

            <div class="table-responsive">
                <table class="table">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col" style="text-align: center;">#</th>
                            <th scope="col" style="text-align: center;">Book Title</th>
                            <th scope="col" style="text-align: center;">Borrower</th>
                            <th scope="col" style="text-align: center;">Date Lent</th>
                        </tr>
                    </thead>
                    <tbody>
                                <?php
                              
                                $search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';

                                $admin_id = $_SESSION['id'];

                             
                                $getAllLatestData = "
                                    SELECT lend_books.*, 
                                        (SELECT fullname FROM accounts WHERE id = lend_books.user_id) AS fullname 
                                    FROM lend_books 
                                    WHERE admin_id = ? 
                                    AND book_title LIKE ? 
                                    ORDER BY lend_id";

                               
                                if ($stmt = mysqli_prepare($conn, $getAllLatestData)) {
                                 
                                    $searchParam = "%" . $search . "%"; 
                                    mysqli_stmt_bind_param($stmt, "is", $admin_id, $searchParam); 

                                   
                                    mysqli_stmt_execute($stmt);

                                 
                                    $result = mysqli_stmt_get_result($stmt);
                                    $count = 0;

                                  
                                    while ($getData = mysqli_fetch_assoc($result)) {
                                        $count++;
                                ?>
                                        <tr>
                                            <th scope="row" style="text-align: center;"><?php echo $count; ?></th>
                                            <td style="text-align: center;"><?php echo htmlspecialchars($getData['book_title']); ?></td>
                                            <td style="text-align: center;"><?php echo htmlspecialchars($getData['fullname']); ?></td>
                                            <td style="text-align: center;"><?php echo htmlspecialchars($getData['date']); ?></td>
                                        </tr>
                                <?php
                                    }
                                  
                                    mysqli_stmt_close($stmt);
                                }
                                ?>
                            </tbody>


                </table>
            </div>
        </div>
    </div>
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
     
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
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