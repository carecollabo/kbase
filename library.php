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
                        <li class="active"><a href="library.php">Library</a></li>
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
                            <table border="0px" class="table" style="font-size:12px;">
                                <?php
                                $sql="SELECT * FROM upload";
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
                                            <img src="resources/user-avatar.png" width="60px" height="60px"><br>
        <span style="font-size:12px;"><?php echo $row['upload_by']; ?></span><br><span style="font-size:9px;"><?php echo $row['upload_date'];?></span>   
                                        </td>
                                        <td>
                                            <table border="1px" class="table">
                                                <tr>
                                                    <td>File:</td>
                                                    <td>
                                                        <?php $actualname = substr_replace($row['file'],"",0,6); echo $actualname;?><span style="font-size:10px;"> ( <?php echo $row['upload_category'];?> )</span>                                                
                                                        <div class="pull-right">
<a title="Download file" style="font-size:12px;border-radius:45px;" href="download.php?id=<?php echo $row['id'];?>">
                                                                <i class="glyphicon glyphicon-download-alt"></i>                                            
</a>
<a title="View File" style="font-size:12px;border-radius:45px;" href="uploads/<?php echo $row['file'];?>" target="_blank">
    <i class="glyphicon glyphicon-chevron-right"></i>
</a>
                                                        </div>
                                                    </td> 
                                                </tr>
                                                <tr>
                                                    <td>Description:</td>
                                                    <td><?php echo "Type: ".$row['type'] ." - upload by: ".$firstname." ".$surname;?></td>   
                                                </tr>
                                                <tr>
                                                    <td>Size:</td>
                                                    <td><?php echo $row['size']."kb";?></td>      
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td>
                                                    <div class="pull-right">
<a title="View File" style="font-size:12px;border-radius:45px;" href="uploads/<?php echo $row['file'];?>" target="_blank" class="btn btn-default">view</a>
<a title="Download file" style="font-size:12px;border-radius:45px;" href="download.php?id=<?php echo $row['id'];?>" class="btn btn-default">download</a>    
                                                    </div>
                                                    </td>   
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <?php
                                }  ?>
                                </tbody>
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
                    <div class="col-sm-2" id="links">
                        <table>
                            <div style="float:right; margin-bottom:2px;">
                                <form>
                                    <input type="text" class="search form-control" placeholder="Quick Search" id="search"/>
                                </form>
                            </div><br><br><br>
                            <?php
                            $sql2="SELECT * FROM upload";
                            $result_set2=mysqli_query($mysqli,$sql2);
                            while($row2=mysqli_fetch_array($result_set2))
                            {
                            ?>
                            <tbody class="list">
                                <tr>
                                    <td class="linktitle">
                                        <p class="fontsforweb_fontid_494" style="color:#03A89E;font-weight:bold;font-size:17px;margin-left:-2px;">
                                            <a href="explodepost.php?id=<?php echo $row2['id'];?>">
<?php $actualname = substr_replace($row2['file'],"",0,6); echo $actualname;?><span style="font-size:15px;"> - <?php echo $row2['upload_category'];?></span>
                                            </a>    
                                        </p> 

                                    </td>
                                    <td class="titleby" style="font-size:2px;color:#fff;"><!--++++++++++( WHITE COLOR TO HIDE IT )++++-->
                                        <?php echo $row2['upload_by'];?>
                                    </td>
                                </tr>
                                <?php
                            }  ?>
                            </tbody>
                        </table>
                        <script type="text/javascript" src="resources/quicksearch/jquery.quicksearch.js"></script>
                        <script type="text/javascript">
                            $('input#search').quicksearch('table tbody tr');
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

