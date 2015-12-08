<?php
session_start();
include_once 'dbconfig.php';
$username = $_SESSION['user'];
$rrol = $_SESSION['permission'];
if (!isset($username)){
    header('location:login.php');
}
?>
<html>
    <head>
        <title>CARE Knowledge</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="shortcut icon" href="resources/index.png"> 
        <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
        <script src="bower_components/jquery/dist/jquery.min.js"></script>
        <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <link href='resources/strength/src/strength.css' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="resources/style.css">
        <link rel="stylesheet" href="resources/font-awesome.css">
        <link href='resources/PRINC/font.css' rel='stylesheet' type='text/css'>
        <!--...............................This is the DATATABLE.js SECTION LIBRARY IMPORTATION..................-->
        <link rel="stylesheet" type="text/css" href="DataTables-1.10.7/media/css/jquery.dataTables.css">
        <script type="text/javascript" charset="utf8" src="DataTables-1.10.7/media/js/jquery.dataTables.js"></script>
        <script type="text/javascript" src="resources/customjs.js"></script>
        <link rel="stylesheet" type="text/css" href="resources/login.css">
        <script type="text/javascript" src="resources/strength/src/strength.min.js"></script>
    </head>
    <body>
        <div class="container" style="margin-top:70px;">
            <p class="fontsforweb_fontid_494">First time <strong>Login</strong>&nbsp;&nbsp;<span style="font-size:25px;"><?php echo $username;?> | </span><a href="logout.php" style="font-size:20px;">Logout</a></p>
            <hr style="margin-top:-11px;margin-left:-1%;margin-right:2%;">          
        </div><div class="container">
        <?php 
        //  $mysqli =  mysqli_connect('localhost','root','locked','ims');
        $result = $mysqli->query("SELECT password FROM user WHERE username='$username'")
            or die(mysqli_warning());
        while ( $db_field = $result->fetch_assoc() ) {

            $current_hash = $db_field['password'];

        }
        $activate = 'Active';
        //...........................................HERE I START THE PASSWORD CHANGE  OPERATION...................................
        if(isset($_POST['btnUpdate'])){
            $newpas = trim($_POST['pwd1']);
            $conpas = trim($_POST['pwd2']);
            $cname = hash("sha256",$newpas); 

            if (strlen($newpas)<8) {

                echo ('<div class="alert alert-danger fade in">');
                echo ('<a href="" class="close" data-dismiss="alert">&times;</a>');
                echo ('<strong>Error!</strong> Password must be at least 8 characters long (try again).');
                echo ('</div>');

            }elseif (strcmp ($newpas, $conpas) !== 0) {

                echo ('<div class="alert alert-danger fade in">');
                echo ('<a href="" class="close" data-dismiss="alert">&times;</a>');
                echo ('<strong>Error!</strong> Passwords not matching (try again).');
                echo ('</div>');

            }elseif (strcmp($current_hash,$cname)==0){
                echo ('<div class="alert alert-danger fade in">');
                echo ('<a href="" class="close" data-dismiss="alert">&times;</a>');
                echo ('<strong>Error!</strong> Old password and New password are the same (try again).');
                echo ('</div>');
            }else{

                $sql="UPDATE user SET password='$cname',status='$activate' WHERE username='$username'";
                $rst = $mysqli->query($sql);
                if($rst){
                    echo ('<div class="alert alert-success fade in">');
                    echo ('<a href="logout.php" class="close" data-dismiss="alert">&times;</a>');
                    echo ('<strong>Success!</strong> Password changed successfully.');
                    echo ('</div>');
                }else{
                    print 'Error : ('. $mysqli->errno .') '. $mysqli->error;
                }
            } 
        }    
        ?></div>
        <div class="container">
            <div id="accordion" class="panel-group">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4 class="panel-title">
<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"><span class="glyphicon glyphicon-cog"></span>&nbsp;&nbsp;Set new password</a>
                        </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse in">
                        <div class="panel-body" id="brands">
                            <center> 
                                <form action="" method="post">
                                    <table class="albums">
                                        <tr>
                                            <td>New Password:&nbsp;&nbsp;</td>
                                            <td>
                                    <input id="password1" type="password" class="strength" data-toggle-title="Display Password" required name="pwd1">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="font-size:6px;color:transparent;">clear text here</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Confirm Password:&nbsp;&nbsp;</td>
                                            <td>
                                    <input id="password2" type="password" class="strength" data-toggle-title="Display Password" required name="pwd2">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="font-size:6px;color:transparent;">clear text here</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>
                                                <center>
                                                    <button type="submit" name="btnUpdate" class="btn btn-primary btn-block">Set New Password</button>
                                                </center>
                                            </td>
                                        </tr>
                                    </table>
                                </form>
                                <script type="text/javascript">
                                    $('#password1').strength();
                                </script>
                            </center>  
                        </div>
                        <div class="container">
                            <div class="logobar">
                                <center>
                                   <!-- <img src="resources/logobig.png">-->
                                </center> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
