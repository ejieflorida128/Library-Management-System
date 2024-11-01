<?php
include '../conn.php'; 


if (isset($_GET['bookid']) && isset($_GET['id'])) {
    $bookId = intval($_GET['bookid']);
    $id = intval($_GET['id']);


    echo $id;

    $SqlReturn = "UPDATE books SET remain = remain + 1 WHERE id = $bookId";
    mysqli_query($conn,$SqlReturn);

    $sqlDelete = "DELETE FROM lend_books WHERE lend_id = $id";
    mysqli_query($conn,$sqlDelete);

    header("Location: logs.php");
}
?>