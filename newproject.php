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
/*$reorder = $mysqli->query("SELECT reorder_point FROM rpoint WHERE id = 1")->fetch_object()->reorder_point;
$rezo = $mysqli->query("SELECT product_name,stock FROM products WHERE stock <=$reorder");
$rowcnt = mysqli_num_rows($rezo);*/
?>
<html>
    <head>
        <title>CARE Knowledge</title>
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
            /*body { background: url('resources/esce.png'); }
            /* .container { background: ; }
        </style>
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
                        <li class="active"><a data-toggle="dropdown" class="dropdown-toggle" href="#">Actions <b class="caret"></b></a>
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
                        <li><a data-toggle="dropdown" class="dropdown-toggle" href="#">Users <b class="caret"></b></a>
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
                <p class="fontsforweb_fontid_494">Add <strong>Project</strong></p><!--..............IT'S A BEAUTIFUL HEADER TADIWA.......-->
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

            if(isset($_POST['btnCreate'])){
                $project = trim($_POST['project']);
                $description = trim($_POST['desc']);
                $trimdname = preg_replace('/\s+/', '', $project);

                if (!empty($project)) {
                    $sql="INSERT INTO project (project_name,description) VALUES ('".$trimdname."','".$description."')";
                    $rst = $mysqli->query($sql);
                    if($rst){
                        echo ('<div class="alert alert-success fade in">');
                        echo ('<a href="" class="close" data-dismiss="alert">&times;</a>');
                        echo ('<strong>Success!</strong> Project added successfully.');
                        echo ('</div>');
                    }else{
                        print 'Error : ('. $mysqli->errno .') '. $mysqli->error;

                    }
                } else {
                    //echo 'Something went wrong';
                    echo ('<div class="alert alert-danger fade in">');
                    echo ('<a href="" class="close" data-dismiss="alert">&times;</a>');
                    echo ('<strong>Error!</strong> Project creation failed (try again).');
                    echo ('</div>');
                }
            }    
            ?>                              
            <div id="accordion" class="panel-group">
                <!--.........................................................START OF THE BEAUTIFUL ACCORDION-->
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"><span class="glyphicon glyphicon-plus-sign"></span>&nbsp;&nbsp;New project</a>
                        </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <form action="" method="post">
                                <table id="allprods" class="table table-condensed table-hover" style="font-size:15px;">
                                    <tr>
                                        <td>Project name</td>
                                        <td><input type="text" class="form-control" name="project" placeholder="project" required></td>
                                    </tr>
                                    <tr>
                                        <td>Description</td>
                                        <td><input type="text" class="form-control"  name="desc" placeholder="eg fund codes" required></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <center style="margin-top:8px;">
                                                <a href="viewprojects.php">All projects</a>
                                            </center>
                                        </td>
                                        <td>
                                            <button type="submit" name="btnCreate" class="btn btn-primary btn-block">Save Project</button>
                                        </td>
                                    </tr>
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
