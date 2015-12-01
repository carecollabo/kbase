<?php
session_start();
include_once 'dbconfig.php';
$username = $_SESSION['user'];
$rrol = $_SESSION['permission'];
if (!isset($username)){
    header('location:login.php');
}
?>
<?php
include('dbconfig.php');
if(isset($_POST['btn-upload']))
{  
    $file_type = $_FILES['file']['type']; //returns the mimetype

    $allowed = array("image/jpeg","application/msword","text/plain", "application/pdf");
    if(!in_array($file_type, $allowed)) {
?>
<script>
    window.location.href='upload.php?failedformat';
</script>
<?php
    }else{
        $subj=$_POST['category'];
        $prlvl=$_POST['project'];
        $filestatus = 'tba'; //+++++++++++++++ (Status Translate: tba = to be approved,pa = post approved )

        $file = rand(1000,100000)."-".$_FILES['file']['name'];
        // $file = $_FILES['file']['name'];
        $file_loc = $_FILES['file']['tmp_name'];
        $file_size = $_FILES['file']['size'];
        $file_type = $_FILES['file']['type'];
        $folder="uploads/";

        // new file size in KB
        $new_size = $file_size/1024;  
        // new file size in KB

        // make file name in lower case
        $new_file_name = strtolower($file);
        // make file name in lower case

        $final_file=str_replace(' ','-',$new_file_name);

        if(move_uploaded_file($file_loc,$folder.$final_file))
        {
            $myhash = md5_file($folder.$final_file);
            $hashres = $mysqli->query("SELECT * FROM upload WHERE md5_signature= '".$myhash."'");
            $nurowz = mysqli_num_rows($hashres);

            if($nurowz==1){
?>
<script>
    window.location.href='upload.php?fileexist';
</script>
<?php
            }else{
                $sql="INSERT INTO upload(file,md5_signature,type,size,upload_category,view_level,status,upload_by,upload_date) VALUES('$final_file','$myhash','$file_type','$new_size','$subj','$prlvl','$filestatus','$username',curDate())";
                mysqli_query($mysqli,$sql); 
?>
<script>
    window.location.href='upload.php?success';
</script>
<?php 
            }
        }else{
?>
<script>
    alert('error while uploading file');
    window.location.href='upload.php?fail';
</script>
<?php
        }
    }
}
?>