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
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">CARE International</a>
                </div>
                <div>
                    <ul class="nav navbar-nav">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="library.php">Library</a></li>
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
        </nav><!--+++++++++++++++++++++++++++++++++++++++++++++++++END OF THE NAVIGATION BAR+++++++++++++++++++++++++++++++++++++ -->
        <div class="container">
            <div class="container" style="margin-top:70px;">
                <p class="fontsforweb_fontid_494">Current <strong> Posts</strong></p>
                <hr style="margin-top:-11px;margin-left:-1%;margin-right:2%;">
            </div>
        </div>
        <div class="container">
            <div class="margin-top">
                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-9">
                        <div class="span12 table-responsive" id="uzers">
                            <table border="0px" class="table">
                                <?php
                                if (isset($_GET['id'])){
                                    $id = $_GET['id'];
                                    $sql="SELECT * FROM post WHERE id=$id";
                                    $result_set=mysqli_query($mysqli,$sql);
                                    
                    //..................................... getting the user's firstname and surname below......
                                    $searchuser="SELECT firstname,surname FROM user WHERE username='$username'";
                                    $user_result=mysqli_query($mysqli,$searchuser);                                    
                                    while ( $db_field = $user_result->fetch_assoc() ) {
                                        $firstname = $db_field['firstname'];
                                        $surname = $db_field['surname'];
                                    }
                    //..................................... THE CODE ENDS HERE .................................                
                                    while($row=mysqli_fetch_array($result_set))
                                    {
                                ?>
                                <tbody class="list">
                                    <tr>
                                        <td class="cat">
                                            <img src="resources/user-avatar.png" width="60px" height="60px">&nbsp;
                                            <center>
                                                <span style="font-size:12px;"><?php echo $row['post_by']; ?></span><br><span style="font-size:9px;"><?php echo $row['post_date'];?></span>
                                            </center>
                                        </td>
                                        <td class="title">
                                            <p>&nbsp;</p>
                                            <p class="fontsforweb_fontid_494" style="color:#525C65;font-weight:bold;font-size:30px;margin-left:8px;">
                                                <?php echo $row['title'];?><span style="font-size:16px;"> ( <?php echo $row['post_category'];?> )</span>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            &nbsp;&nbsp;
                                        </td>
                                        <td class="content">
                                            <p style="margin-left:8px;text-align:justify;margin-right:8px;font-size:12px;">
                                                <?php echo $row['content']; ?>.....<b>by <?php echo $firstname." ".$surname;?></b>  
                                            </p>
                                        </td>
                                    </tr>
                                    <?php
                                    }  ?>
                                </tbody><?php
                                }else{
                                    echo "<b>Post not available: SORRY :(</b>";
                                } ?>                              
                            </table>
                            <script src="bower_components/list.js/dist/list.min.js"></script>
                            <script>
                                var options = {
                                    valueNames: [ 'title','cat','content','det','vl','sub']
                                };
                                var userList = new List('uzers', options);
                            </script>
                        </div>
                    </div>
                    <!--++++++++++++++++++++++++++++++++++++++++++++++++++++LINK SIDE BAR CODE PANO APA+++++++++++++++++++++++++++++-->
                    <div class="col-sm-2" id="links" style="background-color:#F8F8F8;border-radius:9px;">
                        <table>
                            <div style="float:right; margin-bottom:2px;">
                                <input class="search form-control" placeholder="Quick Search"/>
                            </div><br><br><br>
                            <?php
                            $sql2="SELECT * FROM post";
                            $result_set2=mysqli_query($mysqli,$sql2);
                            while($row2=mysqli_fetch_array($result_set2))
                            {
                            ?>
                            <tbody class="list">
                                <tr>
                                    <td class="linktitle">

                                        <p style="color:#03A89E;font-size:12px;margin-left:-2px;">
                                            <a href="explodepost.php?id=<?php echo $row2['id'];?>">
                                                <?php echo $row2['title'];?><span style="font-size:12px;"> - <?php echo $row2['post_category'];?></span>
                                            </a>    
                                        </p> 

                                    </td>
                                    <td class="titleby" style="font-size:2px;color:#fff;"><!--++++++++++( WHITE COLOR TO HIDE IT )++++-->
                                        <?php echo $row2['post_by'];?>
                                    </td>
                                </tr>
                                <?php
                            }  ?>
                            </tbody>
                        </table>
                        <script src="bower_components/list.js/dist/list.min.js"></script>
                        <script>
                            var options = {
                                valueNames: [ 'linktitle','titleby']
                            };
                            var userList = new List('links', options);
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

