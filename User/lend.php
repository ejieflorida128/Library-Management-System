<?php

session_start();

include("../conn.php");

if (isset($_GET['bookid'], $_GET['admin_id'], $_GET['story_pdf'], $_GET['book_title'], $_GET['uploaded_by'])) {
   
    $userId = $_SESSION['id'];
    $bookId = htmlspecialchars($_GET['bookid']);
    $adminId = htmlspecialchars($_GET['admin_id']);
    $storyPdf = htmlspecialchars($_GET['story_pdf']);
    $bookTitle = htmlspecialchars($_GET['book_title']);
    $uploadedBy = htmlspecialchars($_GET['uploaded_by']);



    $sqlInsertData = "INSERT INTO lend_books (book_id,user_id,admin_id,story_pdf,book_title,uploaded_by) VALUES ('$bookId','$userId','$adminId','$storyPdf','$bookTitle','$uploadedBy')";
    mysqli_query($conn,$sqlInsertData);

    $sqlUpdate = "UPDATE books SET remain = remain - 1 WHERE id = $bookId";
    mysqli_query($conn,$sqlUpdate);

    header("Location: logs.php");
    exit();

}
?>
