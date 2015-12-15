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
        <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
        <script src="bower_components/jquery/dist/jquery.min.js"></script>
        <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <link href='resources/PRINC/font.css' rel='stylesheet' type='text/css'>
    </head>
    <body>
        <nav class="navbar navbar-default navbar-inverse">
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
                        <li class="dropdown"><a data-toggle="dropdown" class="dropdown-toggle" href="#">Actions <b class="caret"></b></a>
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
                <p class="fontsforweb_fontid_494">New <strong>User</strong></p><!--..............IT'S A BEAUTIFUL HEADER .......-->
                <hr style="margin-top:-11px;margin-left:-1%;margin-right:2%;">          
            </div>
        </div> 
        <div class="container">
            <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++PHP CODE TO ADD USER HERE -->
            <?php 

            $fname ='';
            $sname ='';
            $usrnm ='';
            $proj ='';
            $rol ='';
            $status ='';
            $created ='';
            $pass ='';
            $conpass ='';
            if (isset($_POST["btnCreate"])){

                $user=$_SESSION['user'];
                $fname = trim($_POST['firstname']);
                $sname = trim($_POST['lastname']);
                $proj = trim($_POST['project']);
                $usrnm  = trim($_POST['username']);
                $rol = trim($_POST['roll']);
                $status = trim($_POST['status']);
                $pass = 'carepass';
                $created = trim($_POST['creator']);
                $newacc='Disabled';

                //....................................................................further VALIDATION PROCESS HAPPENS HERE :)
                    //.....................................................................DATABASE ACTIONS
                    $encrytpa = hash("sha256",$pass);
                    $cstring= mysqli_connect('localhost','root','','kbase') or die("Failed to connect.");
                    $qry= mysqli_query($cstring,"SELECT * FROM user WHERE username = '".$usrnm."'");
                    $numrows = mysqli_num_rows($qry);
                    if($numrows==0){
$sql="INSERT INTO user (firstname,surname,username,password,role,project,created_by,status,timestamp) VALUES ('".$fname."','".$sname."','".$usrnm."','".$encrytpa."','".$rol."','".$proj."','".$user."','".$newacc."',now())";
                        $result=mysqli_query($cstring,$sql);
                        if ($result) {
                            echo ('<div class="alert alert-success fade in">');
                            echo ('<a href="" class="close" data-dismiss="alert">&times;</a>');
                            echo ('<strong>Success!</strong> User account successfully created.');
                            echo ('</div>');
                        }else{
                            echo ('<div class="alert alert-danger fade in">');
                            echo ('<a href="" class="close" data-dismiss="alert">&times;</a>');
                            echo ('<strong>Error!</strong> Account creation failed.'.mysqli_error($cstring));
                            echo ('</div>');
                            //    die('Error: ' . mysqli_error($cstring));
                        }
                    }else{
                        //echo "Username already exists. Please try another one.";
                        echo ('<div class="alert alert-danger fade in">');
                        echo ('<a href="" class="close" data-dismiss="alert">&times;</a>');
                        echo ('<strong>Error!</strong> Username already exist. Please try another one.');
                        echo ('</div>');
                    }
            }
            ?>     
            <div id="accordion" class="panel-group">
                <!--.........................................................START OF THE BEAUTIFUL ACCORDION-->
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"><span class="glyphicon glyphicon-plus-sign"></span>&nbsp;&nbsp;New user</a>
                        </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <form action="" method="post">
                                <table class="table table-condensed table-hover">
                                    <tr>
                                        <td>First Name</td>
                                        <td><input type="text" class="form-control" id="firstname" name="firstname" placeholder="firstname" required></td>
                                    </tr>
                                    <tr>
                                        <td>Last Name</td>
                                        <td><input type="text" class="form-control" id="lastname" name="lastname" placeholder="surname" required></td>
                                    </tr>
                                    <tr>
                                        <td>Username</td>
                                        <td><input type="text" class="form-control" id="username" name="username" placeholder="username" required></td>
                                    </tr>
                                    <tr>
                                        <td>Password</td>
                                        <td><input type="password" class="form-control" id="password" name="password" placeholder="password" readonly value="user123"></td>
                                    </tr>
                                    <tr>
                                        <td>Role</td>
                                        <td>
                                            <select class="form-control" name="roll">
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
                                        <td>Created by</td>
                                        <td><input type="text" class="form-control" name="creator" value="<?php if (isset($_SESSION['user'])){echo $_SESSION['user'];}else{echo "Empty";}?>" readonly></td>
                                    </tr>
                                    <tr>
                                        <td>Status</td>
                                        <td><input type="text" class="form-control" id="status" name="status" value="Disabled" readonly></td>
                                    </tr>
                                    <tr>
                                        <td><center style="margin-top:8px;"><a href="viewusers.php">All users</a></center></td>
                                        <td><button type="submit" name="btnCreate" class="btn btn-default btn-primary btn-block">Create user</button></td>
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
