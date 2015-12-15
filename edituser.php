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
?>
<html>
    <head>
        <title>CARE Knowledge</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
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
            /*body { background: url('resources/esce.png'); }
            /* .container { background: ; }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#Navibar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">CARE International</a>
                </div>
                <div class="collapse navbar-collapse" id="Navibar">
                    <ul class="nav navbar-nav">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="library.php">Library</a></li>
                        <li><a href="infonsupport.php">Info & Support</a></li>
                        <li><a data-toggle="dropdown" class="dropdown-toggle" href="#">Actions <b class="caret"></b></a>
                            <ul role="menu" class="dropdown-menu">
                                <li><a href="newpost.php"><span class="glyphicon glyphicon-plus-sign"></span>&nbsp;&nbsp;New Universal Post</a></li>
                                <li><a href="upload.php"><span class="glyphicon glyphicon-plus-sign"></span>&nbsp;&nbsp;New Post + Upload</a></li>
                                <li class="divider"></li>
                                <li><a href="viewcategories.php"><span class="glyphicon glyphicon-cog"></span>&nbsp;&nbsp;Upload Categories</a></li>    
                                <li><a href="newcategory.php"><span class="glyphicon glyphicon-plus-sign"></span>&nbsp;&nbsp;Add Category</a></li>
                                <li class="divider"></li>
                                <li><a href="viewprojects.php"><span class="glyphicon glyphicon-cog"></span>&nbsp;&nbsp;Manage Projects</a></li>           
                                <li><a href="newproject.php"><span class="glyphicon glyphicon-plus-sign"></span>&nbsp;&nbsp;Add Project</a></li>
                            </ul>
                        </li>
                        <?php if($rrol =='Admin') { ?>
                        <li class="active"><a data-toggle="dropdown" class="dropdown-toggle" href="#">Users <b class="caret"></b></a>
                            <ul role="menu" class="dropdown-menu">
                                <li><a href="viewusers.php"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;System Users</a></li>
                                <li><a href="newuser.php"><span class="glyphicon glyphicon-plus-sign"></span>&nbsp;&nbsp;Add User</a></li>
                            </ul>
                        </li> 
                        <?php }?>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
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
                <p class="fontsforweb_fontid_494">Edit <strong>User</strong></p><!--..............IT'S A BEAUTIFUL HEADER .......-->
                <hr style="margin-top:-11px;margin-left:-1%;margin-right:2%;">          
            </div>
        </div>
        <div class="container">

            <?php 

            $fname ='';
            $sname ='';
            $usrole ='';
            if ($mysqli->connect_error) {
                die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
            }
            if (isset($_GET['username'])){
                $id = $_GET['username'];
                $result = $mysqli->query("SELECT firstname,surname,role,project FROM user WHERE username='$id'")
                    or die(mysqli_warning());
                while ( $db_field = $result->fetch_assoc() ) {
                    $one = $db_field['firstname'];
                    $two = $db_field['surname'];
                    $three = $db_field['role'];
                    $four = $db_field['project'];
                }
            }
            if(isset($_POST['btnUpdate'])){
                $fname = trim($_POST['firstname']);
                $sname = trim($_POST['lastname']);
                $usrname = trim($_POST['username']);
                $usrole  = trim($_POST['role']);
                $project  = trim($_POST['project']);
                
                if (!empty($fname)) {
                    $sql="UPDATE user SET firstname='$fname',surname='$sname',role='$usrole',project='$project',username='$usrname' WHERE username='$id'";
                    $rst = $mysqli->query($sql);
                    if($rst){
                        //print 'Successfully updated record';
                        // header('location:viewusers.php');
                        echo ('<div class="alert alert-success fade in">');
                        echo ('<a href="" class="close" data-dismiss="alert">&times;</a>');
                        echo ('<strong>Success!</strong> Record successfully updated.');
                        echo ('</div>');
                    }else{
                        //print 'Error : ('. $mysqli->errno .') '. $mysqli->error;
                        echo ('<div class="alert alert-danger fade in">');
                        echo ('<a href="" class="close" data-dismiss="alert">&times;</a>');
                        echo ('<strong>Error!</strong> ('. $mysqli->errno .') '.$mysqli->error);
                        echo ('</div>');
                    }
                } else {
                    echo ('<div class="alert alert-danger fade in">');
                    echo ('<a href="" class="close" data-dismiss="alert">&times;</a>');
                    echo ('<strong>Error!</strong> Record update failed!');
                    echo ('</div>');
                }
            }
            ?>   
            <div id="accordion" class="panel-group">
                <!--.........................................................START OF THE BEAUTIFUL ACCORDION-->
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"><span class="glyphicon glyphicon-plus-sign"></span>&nbsp;&nbsp;Manage</a>
                        </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse in">
                        <div class="panel-body" id="cats">
                            <form action="" method="post">
                                <table class="table table table-condensed " style="font-size:15px;">
                                    <tr>
                                        <td>First Name</td>
                                        <td>
                                            <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $two; ?>" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Last Name</td>
                                        <td>
                                        <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $two; ?>" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Username</td>
                                        <td>
                                            <input type="text" class="form-control" id="username" name="username" value="<?php echo $two; ?>" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Password</td>
                                        <td>
                        <input type="password" class="form-control" id="password" name="password" value="<?php echo $two; ?>" readonly value="user123">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Role</td>
                                        <td>
                                            <select class="form-control" name="role" required>
                                                <option value="<?php echo $three; ?>"><?php echo $three; ?></option>
                                                <option value="Admin">Admin</option>
                                                <option value="Regular">PM</option>
                                                <option value="Regular">User</option>
                                            </select> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Project</td>
                                        <td>
                                            <?php
                                            $result = $mysqli->query("SELECT project_name FROM project")or die(mysqli_warning());
                                            echo '<select class="form-control" name="project" required>';
                                            while($row = $result->fetch_assoc())
                                            {
                                                $dropdata = $row['project_name'];                              
                                                echo '<option value='.$dropdata.'>'.$dropdata.'</option>';                              
                                            }echo '</select>';
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><center style="margin-top:8px;"><a href="viewusers.php">All users</a></center></td>
                                        <td><button type="submit" name="btnUpdate" class="btn btn-primary btn-block">Update Record</button></td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
