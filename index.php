<?php

// Database connection details
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'tele';

// Create a database connection
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to validate admin login
function validateAdminLogin($username, $password, $conn) {
    $sql = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    return $result->num_rows > 0;
}

// Function to validate telecaller login
function validateTelecallerLogin($username, $password, $conn) {
    $sql = "SELECT * FROM telecaller WHERE id = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    return $result->num_rows > 0;
}



// Check if the login form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $_SESSION['data'] = $username;

    // Check if admin checkbox is checked
    if (isset($_POST['role']) && $_POST['role'] == 'admin') {
        if (validateAdminLogin($username, $password, $conn)) {
            echo "<script type='text/javascript'> document.location = 'admin-dash.php'; </script>";
        } else {
            echo "Invalid admin login credentials";
        }
    }
    // Check if telecaller checkbox is checked
    elseif (isset($_POST['role']) && $_POST['role'] == 'telecaller') {
        if (validateTelecallerLogin($username, $password, $conn)) {
            header("Location: tele-dash.php?username=" . urlencode($username));
            exit();
        } else {
            echo "Invalid telecaller login credentials";
        }
    } else {
        echo "Please select a role (admin/telecaller)";
    }
}

// Close the database connection
$conn->close();

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" media="screen" >
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen" >
        <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen" >
        <link rel="stylesheet" href="css/prism/prism.css" media="screen" > <!-- USED FOR DEMO HELP - YOU CAN REMOVE IT -->
        <link rel="stylesheet" href="css/main.css" media="screen" >
        <script src="js/modernizr/modernizr.min.js"></script>
        <style>
    .form-horizontal .control-label {
    text-align: left;
    margin-bottom: 0;
    padding-top: 0px;
}
body {
    margin: 0;
    padding: 0;
    background-image: url('images/back2.jpg'); /* Replace 'your-image.jpg' with the path to your image file */
    background-size: cover; /* Cover the entire background */
    background-position: center; /* Center the background image */
    background-repeat: no-repeat; /* Do not repeat the background image */
    font-family: 'Arial', sans-serif; /* Optional: Choose a suitable font-family for your content */
}
</style>
    </head>
    <body class="">
        <div class="main-wrapper">

            <div class="">
                <div class="row">
                    
                         <div class="col-lg-3"></div>
                    <div class="col-lg-6">
                        <section class="section">
                            <div class="row mt-40">
                                <div class="col-md-10 col-md-offset-1 pt-50">

                                    <div class="row mt-30 ">
                                        <div class="col-md-11">
                                            <div class="panel">
                                                <div class="panel-heading">
                                                    <div class="panel-title text-center">
                                                        <h4>User Login</h4>
                                                    </div>
                                                </div>
                                                <div class="panel-body p-20">

                                                    <form class="form-horizontal" method="post">
                                                    	<div class="form-group">
                                                    		<label for="inputEmail3" class="col-sm-2 control-label">Username</label>
                                                    		<div class="col-sm-10">
                                                    			<input type="text" name="username" class="form-control" id="inputEmail3" placeholder="UserName">
                                                    		</div>
                                                    	</div>
                                                    	<div class="form-group">
                                                    		<label for="inputPassword3" class="col-sm-2 control-label">Password</label>
                                                    		<div class="col-sm-10">
                                                    			<input type="password" name="password" class="form-control" id="inputPassword3" placeholder="Password">
                                                    		</div>
                                                    	</div>
                                                        <div class="form-group">
                                                        <label for="role" class="col-sm-2 control-label">Role:</label>
                                                          <input type="radio" name="role" value="admin" required> Admin
                                                           <input type="radio" name="role" value="telecaller" required> Telecaller
                                                        </div>
                                                        
                                                        <div class="form-group mt-20">
                                                    		<div class="col-sm-offset-2 col-sm-10">
                                                    			<button type="submit" name="login" class="btn btn-success btn-labeled pull-right">Sign in<span class="btn-label btn-label-right"><i class="fa fa-check"></i></span></button>
                                                    		</div>
                                                    	</div>
                                                    </form>

                                            

                                                 
                                                </div>
                                            </div>
                                            <!-- /.panel -->
                                        </div>
                                        <!-- /.col-md-11 -->
                                    </div>
                                    <!-- /.row -->
                                </div>
                                <!-- /.col-md-12 -->
                            </div>
                            <!-- /.row -->
                        </section>

                    </div>
                    <!-- /.col-md-6 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /. -->

        </div>
        <!-- /.main-wrapper -->

        <!-- ========== COMMON JS FILES ========== -->
        <script src="js/jquery/jquery-2.2.4.min.js"></script>
        <script src="js/jquery-ui/jquery-ui.min.js"></script>
        <script src="js/bootstrap/bootstrap.min.js"></script>
        <script src="js/pace/pace.min.js"></script>
        <script src="js/lobipanel/lobipanel.min.js"></script>
        <script src="js/iscroll/iscroll.js"></script>

        <!-- ========== PAGE JS FILES ========== -->

        <!-- ========== THEME JS ========== -->
        <script src="js/main.js"></script>
        <script>
            $(function(){

            });
        </script>

        <!-- ========== ADD custom.js FILE BELOW WITH YOUR CHANGES ========== -->
    </body>
</html>
