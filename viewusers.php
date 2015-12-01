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
        <meta name="viewport" content="width=device-width, initial-scale=1">
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
                                           $('#allusers').paging({limit:10}); });            
        </script>
        <style>
            body { background: url('resources/esce.png'); }
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
                        <li><a href="#">Library</a></li>
                        <li><a href="#">Info & Support</a></li> 
                        <li class="dropdown"><a data-toggle="dropdown" class="dropdown-toggle" href="#">Actions <b class="caret"></b></a>
                            <ul role="menu" class="dropdown-menu">
                                <li><a href="newpost.php"><span class="glyphicon glyphicon-cog"></span>&nbsp;&nbsp;New Universal Post</a></li>
                                <li><a href="upload.php"><span class="glyphicon glyphicon-cog"></span>&nbsp;&nbsp;New Post + Upload</a></li>
                                <li class="divider"></li>
                                <li><a href="viewcategories.php"><span class="glyphicon glyphicon-cog"></span>&nbsp;&nbsp;Upload Categories</a></li>    
                                <li><a href="newcategory.php"><span class="glyphicon glyphicon-plus-sign"></span>&nbsp;&nbsp;Add Category</a></li>
                                <li class="divider"></li>
                                <li><a href="viewprojects.php"><span class="glyphicon glyphicon-cog"></span>&nbsp;&nbsp;Manage Projects</a></li>           
                                <li><a href="newproject.php"><span class="glyphicon glyphicon-plus-sign"></span>&nbsp;&nbsp;Add Project</a></li>
                            </ul>
                        </li>
                        <li class="active"><a data-toggle="dropdown" class="dropdown-toggle" href="#">Users <b class="caret"></b></a>
                            <ul role="menu" class="dropdown-menu">
                                <li><a href=""><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;System Users</a></li>
                                <li><a href="newuser.php"><span class="glyphicon glyphicon-plus-sign"></span>&nbsp;&nbsp;Add User</a></li>
                            </ul>
                        </li> 
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
                <p class="fontsforweb_fontid_494">User <strong>List</strong></p><!--..............IT'S A BEAUTIFUL HEADER TADIWA.......-->
                <hr style="margin-top:-11px;margin-left:-1%;margin-right:2%;">          
            </div>
        </div>
        <div class="container">
            <!--.........................................................ALERTING THE USER HERE-->
            <div id="accordion" class="panel-group">
                <!--.........................................................START OF THE BEAUTIFUL ACCORDION-->
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"><span class="glyphicon glyphicon-cog"></span>&nbsp;&nbsp;Manage</a>
                        </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse in">
                        <div class="panel-body" id="uzers">
                            <form>
                                <div style="float:right; margin-bottom:8px;">
                                    <input class="search form-control" placeholder="Quick Search"  />
                                </div>  <br><br>  
                                <table id="allusers" class="table table-hover table-striped" style="font-size:12px;">
                                    <thead>
                                        <tr>
                                            <td><strong>Username</strong></td>
                                            <td><strong>Firstname</strong></td>
                                            <td><strong>Surname</strong></td>
                                            <td><strong>Project</strong></td>
                                            <td><strong>Role</strong></td>
                                            <td><strong>Status</strong></td>
                                            <td><strong>Created by</strong></td>
                                            <td><strong>Date Created</strong></td>                                            
                                            <td colspan="2"><center><strong>Action</strong></center></td>
                                        </tr>
                                        <thead>
                                    <tbody class="list">
                                        <?php 
                    $results = $mysqli->query("SELECT username,firstname,surname,project,role,status,created_by,timestamp FROM user");
                                        while ( $db_field = $results->fetch_assoc() ) {
                                            $usernem = $db_field['username'];
                                            $fnem=$db_field['firstname'];
                                            $snem=$db_field['surname'];
                                            $project=$db_field['project'];
                                            $rol=$db_field['role'];
                                            $status=$db_field['status'];
                                            $creatd=$db_field['created_by'];
                                            $stamp=$db_field['timestamp']; 
                                        ?>
                                        <tr>
                                            <td class="uzrname"><?php echo $usernem ?></td>
                                            <td class="firstname"><?php echo $fnem ?></td>
                                            <td class="surname"><?php echo $snem ?></td>
                                            <td class="proj"><?php echo $project ?></td>
                                            <td class="uzrrole"><?php echo $rol ?></td>
                                            <td class="uzrstatus"><?php echo $status ?></td>
                                            <td class="criator"><?php echo $creatd ?></td>
                                            <td class="tym"><?php echo $stamp ?></td>
                    <td><a class="btn glyphicon glyphicon-pencil" title="Edit User" href="edituser.php?username=<?php echo $usernem ; ?>"></a></td>
        <td><a class="btn glyphicon glyphicon-trash" title="Delete User" style="color:red;" href="deluser.php?username=<?php echo $usernem ; ?>"></a></td>
                                        </tr><?php } ?>
                                    </tbody>
                                </table>
                            </form>
                            <script src="bower_components/list.js/dist/list.min.js"></script>
                            <script>
                                var options = {
                                    valueNames: [ 'uzrname','firstname','surname','uzrrole','uzrstatus','criator','tym','proj','addres' ]
                                };
                                var userList = new List('uzers', options);
                            </script>
                        </div>
                    </div>
                </div>
                <!--.........................................................END OF THE BEAUTIFUL ACCORDION-->
            </div>
        </div> 
    </body>
</html>
