<?php
session_start();
?>
<html>
    <head>
        <title>CARE Knowledge</title>
        <link href='resources/Volstead/font.css' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
        <script src="bower_components/jquery/dist/jquery.min.js"></script>
        <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    </head>
    <body>
        <form method="post">
          <center>
           <table style="margin-top:15%;">
               <tr>
                   <td>
                       <p>Username:&nbsp;&nbsp;&nbsp;</p>
                   </td>
                   <td>
                       <input type="text" name="login" placeholder="username" required>
                   </td>
               </tr>
               <tr>
                   <td>
                       <p>Password:</p>
                   </td>
                   <td>
                       <input type="password" name="password" placeholder="password" required>
                   </td>
               </tr>
               <p></p>
               <tr>
                   <td colspan="2">
                       <button type="submit" name="submit" class="btn-block btn-info">Login</button>
                   </td>
               </tr>
           </table>
        </center>
        </form>
        <div class="container">
            <center><?php
                if (isset($_POST["submit"])) {
                    $usernem=$_POST['login'];
                    $passwd= $_POST['password'];
                    $psd= hash("sha256",$passwd);
                    include_once("dbconfig.php");   
                    
                    $qry= mysqli_query($mysqli,"SELECT * FROM user WHERE username = '".$usernem."' AND password ='".$psd."'");
                    $numrows = mysqli_num_rows($qry);
                    if ($numrows==1) {
                        $_SESSION['user']=$usernem;
                        include_once("dbconfig.php");
                        $results = $mysqli->query("SELECT status,role FROM user WHERE username='".$usernem."'");
                        while ( $db_field = $results->fetch_assoc() ) {
                            $_SESSION['status'] = $db_field['status'];
                            $_SESSION['permission']= $db_field['role'];
                        }
                        //..........................the above section grabs user PERMISSION AND account status to display RIGHTFUL PAGES.
                        if ($_SESSION['status']=='Disabled'){
                            header("location:passwordchange.php");
                        }else{
                            header("location:index.php");
                        }
                        //.............the above lines force a user to redirect to PASSWORD CHANGING PAGE if logging in 4 e 1st time.
                    }else{
                        echo ('<div class="alert alert-danger fade in">');
                        echo ('<a href="" class="close" data-dismiss="alert">&times;</a>');
                        echo ('<strong>Error!</strong> Invalid credentials (try again).');
                        echo ('</div>');
                    } 
                }
                ?></center>
        </div>
        <div class="logobar" style="margin-top:8%;">
            <center>
            <!--    <img src="#"> -->
            </center>
            <p class="fontsforweb_fontid_50908" style="color:#000;">by care it</p> 
        </div>
    </body>
</html>
