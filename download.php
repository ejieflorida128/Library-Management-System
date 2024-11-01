<?php
include("conn.php");


$file = 'storage/HIDE-AND-SEEK.pdf';


if (file_exists($file)) {
   
    // $query = "UPDATE your_table SET download_count = download_count + 1 WHERE file_name = 'HIDE-AND-SEEK.pdf'";
    // mysqli_query($conn, $query); 


    header('Content-Description: File Transfer');
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="' . basename($file) . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    readfile($file);
    exit;
} else {
    echo "File not found.";
}
?>
