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
        <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
        <script src="bower_components/jquery/dist/jquery.min.js"></script>
        <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <link rel='shortcut icon' type='image/x-icon' href='resources/favicon.ico' />
    </head>
    <body>
        <nav class="navbar navbar-default navbar-fixed-toP navbar-inverse">
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
                        <li class="active"><a href="index.php">Home</a></li>
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
<!--*****************************************CENTRAL BIG LOGO HERE*******************************-->
        <div style="margin-top:90px;">
            <center>
                <img src="resources/carelogo.png" style="color:black;">
            </center>
        </div>
<!-- ******************************************SEARCH TABLE FEATURE******************************-->
        <div class="row">
            <div class="col-sm-3"></div>
            <div style="background-color:#F59C00;margin-top:40px" class="col-sm-6">
                <center>
                    <table>
                        <tr>
                            <td>
                                <a href="#" class="btn-block">
                                    <span class="glyphicon glyphicon-search" style="color:#ff9900;"></span>
                                </a>
                            </td>
                            <td colspan="5"><input class="form-control" size="120px" placeholder="Search" type="text"></td>
                            <td>&nbsp;</td>
                            <td><a href="#" class="btn-block"><center>
                                <span class="glyphicon glyphicon-search" style="color:#000000;"></span></center>
                                </a>
                            </td>
                        </tr>
                    </table>
                </center>
            </div>
            <div class="col-sm-3"></div>
        </div>
    </body>
</html>                                                  
