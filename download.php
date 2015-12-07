<?php
//download.php
include_once 'dbconfig.php';
if (isset($_GET['id']))
{
    $id = $_GET['id'];
    $result = $mysqli->query("SELECT file FROM upload WHERE id=$id") or die(mysqli_warning());                                  
    while ( $db_field = $result->fetch_assoc()) {
        $file = $db_field['file'];
    }
    $filename=$file;
    $file="uploads\\$filename";
    $len = filesize($file); // Calculate File Size
    ob_clean();
    header("Pragma: public");
    header("Expires: 0");
    header("Cache-Control: must-revalidate,post-check=0, pre-check=0");
    header("Cache-Control: public"); 
    header("Content-Description: File Transfer");
    header("Content-Type:application/pdf"); // Send type of file
    $header="Content-Disposition: attachment; filename=$filename;"; // Send File Name
    header($header );
    header("Content-Transfer-Encoding: binary");
    header("Content-Length: ".$len); // Send File Size
    @readfile($file);
    exit;
}
else
{
    echo "Failed to download.";
}
?>