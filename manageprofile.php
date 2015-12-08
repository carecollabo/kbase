<?php 
session_start();
$username = $_SESSION['user'];
$rrol = $_SESSION['permission'];
$stetas = $_SESSION['status'];
if (!isset($username)){
    header('location:login.php');
}
?>
<?php 
include('dbconfig.php'); 
?>
<html>
    <head>
        <title>Odzi Library</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="shortcut icon" href="resources/index.png">
        <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
        <script src="bower_components/jquery/dist/jquery.min.js"></script>
        <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="resources/style.css">
        <link rel="stylesheet" href="resources/font-awesome.css">
        <link href='resources/PRINC/font.css' rel='stylesheet' type='text/css'>
        <!--...............................This is the DATATABLE.js SECTION LIBRARY IMPORTATION..................-->
        <link rel="stylesheet" type="text/css" href="DataTables-1.10.7/media/css/jquery.dataTables.css">
        <script type="text/javascript" charset="utf8" src="DataTables-1.10.7/media/js/jquery.dataTables.js"></script>
        <script type="text/javascript" src="resources/customjs.js"></script>
        <style>
            /*  body { background: url('resources/esce.png'); }
            /* .container { background: ; }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-default">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">CARE International</a>
                </div>
                <div>
                    <ul class="nav navbar-nav">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="library.php">Library</a></li>
                        <li><a href="infonsupport.php">Info & Support</a></li>
                        <li class="dropdown"><a data-toggle="dropdown" class="dropdown-toggle" href="#">Actions <b class="caret"></b></a>
                            <ul role="menu" class="dropdown-menu">
                                <li><a href="newpost.php"><span class="glyphicon glyphicon-plus-sign"></span>&nbsp;&nbsp;New Universal Post</a></li>
                                <li><a href="upload.php"><span class="glyphicon glyphicon-plus-sign"></span>&nbsp;&nbsp;New Post + Upload</a></li>
                                <?php if($rrol =='Admin') { ?>
                                <li class="divider"></li>
                                <li><a href="viewcategories.php"><span class="glyphicon glyphicon-cog"></span>&nbsp;&nbsp;Upload Categories</a></li>    
                                <li><a href="newcategory.php"><span class="glyphicon glyphicon-plus-sign"></span>&nbsp;&nbsp;Add Category</a></li>
                                <li class="divider"></li>
                                <li><a href="viewprojects.php"><span class="glyphicon glyphicon-cog"></span>&nbsp;&nbsp;Manage Projects</a></li>           
                                <li><a href="newproject.php"><span class="glyphicon glyphicon-plus-sign"></span>&nbsp;&nbsp;Add Project</a></li>
                                <?php }?>
                            </ul>
                        </li>
                        <?php if($rrol =='Admin') { ?>
                        <li><a data-toggle="dropdown" class="dropdown-toggle" href="#">Users <b class="caret"></b></a>
                            <ul role="menu" class="dropdown-menu">
                                <li><a href="viewusers.php"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;System Users</a></li>
                                <li><a href="newuser.php"><span class="glyphicon glyphicon-plus-sign"></span>&nbsp;&nbsp;Add User</a></li>
                            </ul>
                        </li> 
                        <?php }?>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="active">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;<?php echo $username; ?>  
                                <b class="caret"></b>
                            </a>
                            <ul role="menu" class="dropdown-menu">
                                <li><a href="manageprofile.php"><span class="glyphicon glyphicon-cog"></span>&nbsp;&nbsp;Manage Profile</a></li>
                                <li class="divider"></li>
                                <li><a href="logout.php"><span class="glyphicon glyphicon-off"></span> Logout</a></li>
                            </ul>
                        </li> 
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">   
            <div class="container" style="margin-top:10px;">
                <p class="fontsforweb_fontid_494">Your <strong>Profile</strong></p><!--..............IT'S A BEAUTIFUL HEADER TADIWA.......-->
                <hr style="margin-top:-11px;margin-left:-1%;margin-right:2%;">          
            </div>
        </div>
        <div class="container">
            <!--.........................................................ALERTING THE USER HERE-->
            <!--
<div class="alert alert-success fade in">
<a href="#" class="close" data-dismiss="alert">&times;</a>
<strong>Success!</strong> Your message has been sent successfully.
</div>    --> 
            <?php 
            // $mysqli =  mysqli_connect('localhost','root','locked','ims');
            $result = $mysqli->query("SELECT firstname,surname,password FROM user WHERE username='$username'")
                or die(mysqli_warning());
            while ( $db_field = $result->fetch_assoc() ) {

                $first = $db_field['firstname'];
                $second = $db_field['surname'];
                $current_hash = $db_field['password'];
                $fullnem = $first." ".$second;
            } //..................................................................IT IS GETTING BORING (SAME CODE OVER AND OVER)
            //...........................................HERE I START THE PASSWORD CHANGE  OPERATION...................................
            if(isset($_POST['btnChange'])){
                $newpas = trim($_POST['pass1']);
                $conpas = trim($_POST['pass2']);
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

                    $sql="UPDATE user SET password='$cname' WHERE username='$username'";
                    $rst = $mysqli->query($sql);
                    if($rst){
                        echo ('<div class="alert alert-success fade in">');
                        echo ('<a href="" class="close" data-dismiss="alert">&times;</a>');
                        echo ('<strong>Success!</strong> Password changed successfully.');
                        echo ('</div>');
                    }else{
                        print 'Error : ('. $mysqli->errno .') '. $mysqli->error;
                    }
                } 
            }    
            ?>             
            <div id="accordion" class="panel-group">
                <!--.........................................................START OF THE BEAUTIFUL ACCORDION-->
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"><span class="glyphicon glyphicon-cog"></span>&nbsp;&nbsp;Manage</a>
                        </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse in">
                        <div class="panel-body" id="brands">
                            <center>
                                <table class="table" style="font-size:15px;">
                                    <tr><td>Fullname:&nbsp;&nbsp;</td><td><input type="text" class="form-control" name="uzrname" readonly value="<?php echo $fullnem;?>"></td></tr>
                                    <tr><td>Current Password (hash):&nbsp;&nbsp;</td><td><input type="text" onCopy="return false" class="form-control" name="crpwd" readonly value="<?php echo $current_hash;?>"></td></tr> 
                                </table>
                            </center>

                            <form action="" method="post">
                                <table id="allprod" class="table " style="font-size:15px;">
                                    <tr><td>New Password:</td><td><input type="password" class="form-control" name="pass1" required ></td></tr>
                                    <tr><td>Confirm Password:</td><td><input type="password" class="form-control" name="pass2" required ></td></tr>
                                    <tr>
                                        <td><center style="margin-top:8px;"><a href="newpost.php">Cancel</a></center></td>
                                        <td><button type="submit" name="btnChange" class="btn btn-primary btn-block">Change</button></td></tr>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
                <!--.........................................................END OF THE BEAUTIFUL ACCORDION-->
            </div>
        </div>
    </body>
</html>
