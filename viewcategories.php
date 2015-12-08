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
        <script type="text/javascript" src="bower_components/jquery-ui/jquery-ui.min.js"></script>
        <script type="text/javascript" src="resources/paging.js"></script>
        <script>
            $(document).ready(function () { "use strict";
                                           $('#allcats').paging({limit:8}); });            
        </script>
        <style>
            /*body { background: url('resources/esce.png');}
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
                <p class="fontsforweb_fontid_494">Category <strong>List</strong></p>
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
            <div id="accordion" class="panel-group">
                <!--.........................................................START OF THE BEAUTIFUL ACCORDION-->
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                            <span class="glyphicon glyphicon-cog"></span>&nbsp;&nbsp;Manage</a>
                        </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse in">
                        <div class="panel-body" id="brands">
                            <form action="" method="post">
                                <div style="float:right;">
                                    <input class="search form-control" placeholder="Quick Search"  />
                                </div>  <br><br>                 
                                <table id="allcats" class="table table-condensed table-hover table-bordered table-striped" style="font-size:12px;">
                                    <thead>
                                        <tr>
                                            <td><strong>Category</strong></td>
                                            <td><strong>Description</strong></td> 
                                            <td colspan="2"><center><strong>Action</strong></center></td>                      
                                        </tr>
                                    </thead>
                                    <tbody class="list">                       
                                        <?php 
                                        //  $mysqli =  mysqli_connect('localhost','root','locked','odzi');
                                        $results = $mysqli->query("SELECT category,description FROM upload_category");
                                        while ( $db_field = $results->fetch_assoc() ) {
                                            $categor = $db_field['category'];
                                            $shotnem = $db_field['description'];
                                        ?>      
                                        <tr>
                                            <td class="name"><?php echo $categor; ?></td>
                                            <td class="shot"><?php echo $shotnem;?></td>
                                            <td>
                                                <center>
                                                    <a title="Edit Category" class="btn glyphicon glyphicon-pencil" style="font-size:12px;" href="editcategory.php?categoryname=<?php echo $categor; ?>">&nbsp;Edit</a>
                                                </center>
                                            </td>
                                            <td>
                                                <center>
        <a title="Delete Category" class="btn glyphicon glyphicon-trash" style="color:red;font-size:12px;" href="deletecat.php?categoryname=<?php echo $categor; ?>">&nbsp;Delete</a>
                                                </center>
                                            </td>
                                        </tr><?php }?></tbody>
                                </table>
                            </form>
                            <script src="bower_components/list.js/dist/list.min.js"></script>
                            <script>
                                var options = {
                                    valueNames: [ 'name', 'shot' ]
                                };

                                var userList = new List('brands', options);
                            </script>
                        </div>
                    </div>
                </div>
                <!--.........................................................END OF THE BEAUTIFUL ACCORDION-->
            </div>
        </div>
    </body>
</html>
