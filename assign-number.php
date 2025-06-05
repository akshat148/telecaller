<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])=="")
    {   
    header("Location: index.php"); 
    }
    else{
$stid=intval($_GET['stid']);

if(isset($_POST['submit']))
{
$name=$_POST['fullname'];
$phone=$_POST['phone'];
$comment=$_POST['comment']; 
$sql="INSERT INTO data (id,name,phone,comment) VALUES (:stid, :name, :phone,:comment);
";
$query = $dbh->prepare($sql);
$query->bindParam(':name',$name,PDO::PARAM_STR);
$query->bindParam(':phone',$phone,PDO::PARAM_STR);
$query->bindParam(':comment',$comment,PDO::PARAM_STR);
$query->bindParam(':stid',$stid,PDO::PARAM_STR);

$query->execute();
header("Location: ".$_SERVER['PHP_SELF']."?stid=".$stid );
    
$msg="Student info updated successfully";
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Admin| Assign Number </title>
        <link rel="stylesheet" href="css/bootstrap.min.css" media="screen" >
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen" >
        <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen" >
        <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen" >
        <link rel="stylesheet" href="css/prism/prism.css" media="screen" >
        <link rel="stylesheet" href="css/select2/select2.min.css" >
        <link rel="stylesheet" href="css/main.css" media="screen" >
        <script src="js/modernizr/modernizr.min.js"></script>
    </head>
    <body class="top-navbar-fixed">
        <div class="main-wrapper">

            <!-- ========== TOP NAVBAR ========== -->
  <?php include('includes/topbar.php');?> 
            <!-- ========== WRAPPER FOR BOTH SIDEBARS & MAIN CONTENT ========== -->
            <div class="content-wrapper">
                <div class="content-container">

                    <!-- ========== LEFT SIDEBAR ========== -->
                   <?php include('includes/leftbar.php');?>  
                    <!-- /.left-sidebar -->

                    <div class="main-page">

                     <div class="container-fluid">
                            <div class="row page-title-div">
                                <div class="col-md-6">
                                    <h2 class="title">Assign The Number To Telecaller</h2>
                                    <?php

    // Display stid within an HTML element
    echo "<p>Telecaller ID: $stid</p>";
    ?>
                                </div>
                                
                                <!-- /.col-md-6 text-right -->
                            </div>
                            <!-- /.row -->
                            <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
                                        <li><a href="admin-dash.php"><i class="fa fa-home"></i> Home</a></li>
                                
                                        <li class="active">Assign The Number</li>
                                    </ul>
                                </div>
                             
                            </div>
                            <!-- /.row -->
                        </div>
                        <div class="container-fluid">
                           
                        <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel">
                                            <div class="panel-heading">
                                                <div class="panel-title">
                                                    <h5>Assign The Number</h5>
                                                </div>
                                            </div>
                                            <div class="panel-body">
                                            <?php if(isset($msg) && $msg) { ?>
    <div class="alert alert-success left-icon-alert" role="alert">
        <strong>Well done!</strong><?php echo htmlentities($msg); ?>
    </div>
<?php } else if(isset($error) && $error) { ?>
    <div class="alert alert-danger left-icon-alert" role="alert">
        <strong>Oh snap!</strong> <?php echo htmlentities($error); ?>
    </div>
<?php } ?>



                                





                                        <form class="form-horizontal" method="post">


                                        



<div class="form-group">
<label for="default" class="col-sm-2 control-label">Full Name</label>
<div class="col-sm-10">
<input type="text" name="fullname" class="form-control" id="fullname" required="required" autocomplete="off">
</div>
</div>

<input type="hidden" name="stid" value="<?php echo $stid; ?>">


<div class="form-group">
<label for="default" class="col-sm-2 control-label">Number</label>
<div class="col-sm-10">
<input type="number" name="phone" class="form-control" id="phone"  required="required" autocomplete="off">
</div>
</div>
<div class="form-group">
<label for="default" class="col-sm-2 control-label">Comment</label>
<div class="col-sm-10">
<input type="text" name="comment" class="form-control" id="comment" required="required" autocomplete="off">
</div>
</div>



</div>
</div>


 

                                                    
                                                    <div class="form-group">
                                                        <div class="col-sm-offset-2 col-sm-10">
                                                            <button type="submit" name="submit" class="btn btn-primary">Assign</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-md-12 -->
                                </div>
                    </div>
                </div>
                <!-- /.content-container -->
            </div>
            <!-- /.content-wrapper -->
        </div>
        <!-- /.main-wrapper -->
        <script src="js/jquery/jquery-2.2.4.min.js"></script>
        <script src="js/bootstrap/bootstrap.min.js"></script>
        <script src="js/pace/pace.min.js"></script>
        <script src="js/lobipanel/lobipanel.min.js"></script>
        <script src="js/iscroll/iscroll.js"></script>
        <script src="js/prism/prism.js"></script>
        <script src="js/select2/select2.min.js"></script>
        <script src="js/main.js"></script>
        <script src="js/scripts.js"></script>

        <script>
            $(function($) {
                $(".js-states").select2();
                $(".js-states-limit").select2({
                    maximumSelectionLength: 2
                });
                $(".js-states-hide").select2({
                    minimumResultsForSearch: Infinity
                });
            });
        </script>
    </body>
</html>
<?PHP } ?>
