<?php

include '../conn.php'; 

$bookId = isset($_GET['bookid']) ? intval($_GET['bookid']) : 0;

$sql = "SELECT story_pdf FROM lend_books WHERE book_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $bookId);
$stmt->execute();
$result = $stmt->get_result();
$story = $result->fetch_assoc();

if ($story) {
    $file = $story['story_pdf'];

    $sqlUpdate = "UPDATE books SET download = download + 1 WHERE id = $bookId";
    mysqli_query($conn,$sqlUpdate);
  
    if (file_exists($file)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="'.basename($file).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        readfile($file);
        exit;
    } else {
        echo "File does not exist.";
    }
} else {
    echo "No file found for this book.";
}
?>
