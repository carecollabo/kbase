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
        <script type="text/javascript" src="bower_components/jquery-ui/jquery-ui.min.js"></script>
        <script type="text/javascript" src="resources/paging.js"></script>
        <script>
            $(document).ready(function () { "use strict";
                                           $('#allcats').paging({limit:8}); });            
        </script>
        <style>
            /*body { background: url('resources/esce.png'); }
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
<!--+++++++++++++++++++++++++++++++++++++++++++++++++END OF THE NAVIGATION BAR+++++++++++++++++++++++++++++++++++++ -->
        <div class="container">  
            <div class="container" style="margin-top:10px;">
                <p class="fontsforweb_fontid_494">Upload <strong>Material</strong></p>
                <hr style="margin-top:-11px;margin-left:-1%;margin-right:2%;">          
            </div>
            <?php
            if(isset($_GET['success']))
            {

                echo ('<div class="alert alert-success fade in">');
                echo ('<a href="" class="close" data-dismiss="alert">&times;</a>');
                echo ('<strong>Success!</strong> File Uploaded Successfully.');
                echo ('</div>');
            ?>
            <!-- <label>File Uploaded Successfully...  <a href="view.php">click here to view file.</a></label>  -->
            <?php
            }else if(isset($_GET['fail'])){
                echo ('<div class="alert alert-danger fade in">');
                echo ('<a href="" class="close" data-dismiss="alert">&times;</a>');
                echo ('<strong>Error!</strong> Error while uploading. Try Again.');
                echo ('</div>');
            ?>
            <!-- <label>Problem While File Uploading !</label> -->
            <?php
            }else if(isset($_GET['failedformat'])){
                echo ('<div class="alert alert-danger fade in">');
                echo ('<a href="" class="close" data-dismiss="alert">&times;</a>');
                echo ('<strong>Error!</strong> Invalid file format.');
                echo ('</div>');
            ?>
            <?php
            }else if(isset($_GET['fileexist'])){
                echo ('<div class="alert alert-danger fade in">');
                echo ('<a href="" class="close" data-dismiss="alert">&times;</a>');
                echo ('<strong>Error!</strong> Similar file already exists. (SAVE SPACE.)');
                echo ('</div>');
            ?>
            <!-- <label>Problem While File Uploading !</label> -->
            <?php
            }else{
            ?>
            <label>Upload files with (.PDF or .DOC or .TXT) extension only.</label>
            <br>
            <?php
            }
            ?>
            <div id="accordion" class="panel-group ">
                <!--.........................................................START OF THE BEAUTIFUL ACCORDION-->
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"><span class="glyphicon glyphicon-plus-sign"></span>&nbsp;&nbsp;Add Material (monitored version control)</a>
                        </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <form action="uploadprocess.php" method="post" enctype="multipart/form-data">
                                <center>
                                    <table class="table table-condensed table-hover" style="font-size:15px;">
                                        <tr>
                                            <td>File Title:</td>
                                            <td>
                                                <input type="file" name="file" required />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Upload Category:</td>
                                            <td>
                                                <?php
                                                $searchresult = $mysqli->query("SELECT category FROM upload_category")or die(mysqli_warning());
                                                echo '<select class="form-control" name="category" required>';
                                                while($rowinfo = $searchresult->fetch_assoc())
                                                {
                                                    $dropinfo = $rowinfo['category'];                              
                                                    echo '<option value='.$dropinfo.'>'.$dropinfo.'</option>';                              
                                                }echo '</select>';
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>View Level:</td>
                                            <td>
                                                <?php
                                                $result = $mysqli->query("SELECT project_name FROM project")or die(mysqli_warning());
                                                echo '<select class="form-control" name="project" required>';
                                                while($row = $result->fetch_assoc())
                                                {
                                                    $dropdata = $row['project_name']; 
                                                    echo '<option value='.$dropdata.'>'.$dropdata.'</option>';                              
                                                }
                                                echo '<option value="Universal">Universal</option>';
                                                echo '</select>';
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <?php if($rrol =='Admin') { ?>
                                                <center style="margin-top:8px;">
                                                    <a href="viewpost.php">Other Uploads</a>
                                                </center>
                                                <?php }else{?>
                                                <center style="margin-top:8px;">
                                                    <a href="library.php">Other Uploads</a>
                                                </center>
                                                <?php }?>
                                            </td>
                                            <td>
                                                <button type="submit" name="btn-upload" class="btn btn-primary btn-block">Upload</button>
                                            </td>
                                        </tr>
                                    </table></center>
                            </form>
                            </liv>
                      </div>
                </div>
            </div>
        </div>
    </body>
</html>
