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
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
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
            /* body { background: url('resources/esce.png'); }
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
                        <li class="active"><a href="infonsupport.php">Info & Support</a></li>
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
                        <li><a data-toggle="dropdown" class="dropdown-toggle" href="#">Users <b class="caret"></b></a>
                            <ul role="menu" class="dropdown-menu">
                                <li><a href="viewusers.php"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;System Users</a></li>
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
        </nav><!--+++++++++++++++++++++++++++++++++++++++++++++++++END OF THE NAVIGATION BAR+++++++++++++++++++++++++++++++++++++ -->
        <div class="container">
            <div class="container" style="margin-top:10px;">
                <p class="fontsforweb_fontid_494">Current <strong> Posts</strong></p>
                <hr style="margin-top:-11px;margin-left:-1%;margin-right:2%;">
            </div>
        </div>
        <div class="container">
            <div class="margin-top">
                <div class="row">
                    <div class="col-sm-10">
                        <div class="span12 table-responsive" id="uzers">
                            <table cellpadding="0" cellspacing="0" border="0" class="table  table-bordered" id="example" style="font-size:15px;">
                                <div style="float:right; margin-bottom:8px;">
                                    <input class="search form-control" placeholder="Quick Search"/>
                                </div><br><br>
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Post by</th>
                                        <th>Post Category</th>
                                        <th>View Level</th>
                                        <th>Content</th>
                                        <th>Post Date</th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    <?php
                                    $sql="SELECT * FROM post";
                                    $result_set=mysqli_query($mysqli,$sql);
                                    while($row=mysqli_fetch_array($result_set))
                                    {
                                    ?>
                                    <tr>
                                        <td class="title"><?php $actualname = substr_replace($row['title'],"",0,6); echo $actualname; ?></td>
                                        <td class="cat"><?php echo $row['post_by'] ?></td>
                                        <td class="sub"><?php echo $row['post_category'] ?></td>
                                        <td class="vl"><?php echo $row['view_level'] ?></td>
                                        <td><?php echo $row['content'] ?></td>
                                        <td class="det"><?php echo $row['post_date'] ?></td>
                                    </tr>
                                    <?php
                                    }  ?>
                                </tbody>
                            </table>
                            <script src="bower_components/list.js/dist/list.min.js"></script>
                            <script>
                                var options = {
                                    valueNames: [ 'title','cat','author','det','vl','sub']
                                };

                                var userList = new List('uzers', options);
                            </script>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        Links to be placed here.
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

