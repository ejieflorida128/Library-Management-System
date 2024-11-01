<?php
    include("../conn.php");
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_SESSION['id'];  
        $bookTitle = $_POST['bookTitle'];
        $uploadedBy = $_POST['uploadedBy']; 
        $stock = $_POST['stock'];
        $remain = $_POST['stock'];
    
        $targetDir = "../storage/";
        $fileName = basename($_FILES["bookPdf"]["name"]);
        $targetFilePath = $targetDir . $fileName;
    
      
        if (move_uploaded_file($_FILES["bookPdf"]["tmp_name"], $targetFilePath)) {
          
            $sqlUploadStory = "INSERT INTO books (admin_id, story_pdf, stock, remain, book_title, uploaded_by) VALUES ('$id', '$targetFilePath', '$stock', '$remain', '$bookTitle', '$uploadedBy')";

            if (mysqli_query($conn, $sqlUploadStory)) {
                header("Location: books.php");
            } else {
                echo "Database insertion failed: " . mysqli_error($conn);
            }
        } else {
            echo "Failed to upload PDF.";
        }
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
                <a href="books.php" class="nav-item nav-link active"><i class="fa fa-book me-2"></i>Available Books</a>
                <a href="logs.php" class="nav-item nav-link"><i class="fa fa-download me-2"></i>My Library </a>
                
                
                   
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
                    <input class="form-control border-0" type="search" name="search" placeholder="Search" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
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
                 


                        <section id="pricing" class="section">
      <div class="container">
    



        <div class="row pricing-tables" style = "margin-top: 20px; ">
          
       
         <?php
$id = $_SESSION['id'];

$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';


$sqlGetStory = "
    SELECT books.*, accounts.fullname 
    FROM books 
    JOIN accounts ON books.uploaded_by = accounts.id 
    WHERE (LOWER(books.book_title) LIKE LOWER('%$search%') OR LOWER(accounts.fullname) LIKE LOWER('%$search%'))";
$queryGetStory = mysqli_query($conn, $sqlGetStory);



while ($Story = mysqli_fetch_assoc($queryGetStory)) {
    $isOutOfStock = $Story['remain'] <= 0;
?>
    <div class="col-lg-4 col-md-4 col-xs-12" 
         style="box-shadow: 0px 4px 8px rgba(0.5, 0.5, 0.5, 0.5); border-radius: 10px; margin: 10px; width: 300px; 
                <?php echo $isOutOfStock ? 'filter: grayscale(100%); opacity: 0.6;' : ''; ?>">
                
        <div class="pricing-table text-center" style="padding: 10px; position: relative;">
            <h6>
                <?php echo htmlspecialchars($Story['book_title']); ?>
            </h6>

            <?php if ($isOutOfStock) : ?>
                <div style="
                    background-color: red; 
                    color: white; 
                    font-weight: bold; 
                    font-size: 14px; 
                    padding: 8px; 
                    position: absolute; 
                    top: 50%; 
                    left: 50%; 
                    transform: translate(-50%, -50%);
                    width: 100%;
                    text-align: center;
                    z-index: 10;">
                    Out of Stock
                </div>
            <?php endif; ?>

            <div class="pricing-details">
                <iframe src="<?php echo $Story['story_pdf']; ?>" class="no-scroll-iframe" width="90%" height="200px"></iframe>
            </div>
            <div>
                <div class="info" style="text-align: left;">
                    <p style="margin: 0; padding: 2px 0; font-size: 12px;">
                        <i class="fa fa-user" style="color: #888; margin-right: 6px; font-size: 14px;"></i>
                        Uploaded By: <?php echo htmlspecialchars($Story['fullname']); ?>
                    </p>
                    <p style="margin: 0; padding: 2px 0; font-size: 12px;">
                        <i class="fa fa-box" style="color: #888; margin-right: 6px; font-size: 14px;"></i>
                        Stock: <strong><?php echo $Story['stock']; ?></strong>
                    </p>
                    <p style="margin: 0; padding: 2px 0; font-size: 12px;">
                        <i class="fa fa-box-open" style="color: #888; margin-right: 6px; font-size: 14px;"></i>
                        Remain: <strong><?php echo $Story['remain']; ?></strong>
                    </p>
                    <p style="margin: 0; padding: 2px 0; font-size: 12px;">
                        <i class="fa <?php echo $Story['download'] > 0 ? 'fa-download' : 'fa-download'; ?>" style="color: #888; margin-right: 6px; font-size: 14px;"></i>
                        Downloads: <strong><?php echo $Story['download']; ?></strong>
                    </p>

                    <a href="lend.php?bookid=<?php echo $Story['id']; ?>&&admin_id=<?php echo $Story['admin_id']; ?>&&story_pdf=<?php echo $Story['story_pdf']; ?>&&book_title=<?php echo $Story['book_title']; ?>&&uploaded_by=<?php echo $Story['uploaded_by']; ?>" class="btn btn-success" style="display: flex; justify-content: center; align-items: center; text-align: center;">Lend</a>

                </div>
            </div>
        </div>
    </div>
<?php
}
?>







    
        </div>
      
      </div>
    </section>

                 
            </div>
        

       
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="../index.php">Library Management System</a>, All Right Reserved. 
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