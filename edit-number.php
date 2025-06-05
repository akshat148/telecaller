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


if (isset($_POST['submit'])) {
    $uploadDir = "recordings/";
    $audioFile = $uploadDir . basename($_FILES["recording"]["name"]);
    $allowedExtensions = ['mp3', 'wav', 'ogg', 'aac'];
    $output = $_POST['output'];
    $status = $_POST['status'];
    $fileExtension = strtolower(pathinfo($audioFile, PATHINFO_EXTENSION));

    // Check if the file extension is allowed
    if (isset($_POST['submit'])) {
        $output = $_POST['output'];
        $status = $_POST['status'];
    
        // Check if a file is selected for uploading
        if (!empty($_FILES["recording"]["name"])) {
            $uploadDir = "recordings/";
            $audioFile = $uploadDir . basename($_FILES["recording"]["name"]);
            $allowedExtensions = ['mp3', 'wav', 'ogg', 'aac'];
            $fileExtension = strtolower(pathinfo($audioFile, PATHINFO_EXTENSION));
    
            // Check if the file extension is allowed
            if (in_array($fileExtension, $allowedExtensions)) {
                // Move the uploaded file to the specified directory
                if (move_uploaded_file($_FILES["recording"]["tmp_name"], $audioFile)) {
                    // File uploaded successfully
    
                    // Update the data in the database with recording information
                    $sql = "UPDATE data SET output=:output, status=:status, recording=:recording WHERE number_id=:stid";
                    $query = $dbh->prepare($sql);
                    $query->bindParam(':recording', $audioFile, PDO::PARAM_STR);
                } else {
                    $error = "Error uploading file.";
                }
            } else {
                $error = "Invalid file format. Allowed formats: " . implode(', ', $allowedExtensions);
            }
        } else {
            // Update the data in the database without recording information
            $sql = "UPDATE data SET output=:output, status=:status WHERE number_id=:stid";
            $query = $dbh->prepare($sql);
        }
    
        // Common part for both cases
        if (!isset($error)) {
            // Continue with common code for updating other fields
            $query->bindParam(':output', $output, PDO::PARAM_STR);
            $query->bindParam(':status', $status, PDO::PARAM_STR);
            $query->bindParam(':stid', $stid, PDO::PARAM_STR);
            $query->execute();
    
            $msg = "Request info updated successfully";
        }
    }

}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Telecaller| Request Data< </title>
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
  <?php include('includes/topbar2.php');?> 
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
                                    <h2 class="title">Request Data</h2>
                                
                                </div>
                                
                                <!-- /.col-md-6 text-right -->
                            </div>
                            <!-- /.row -->
                            <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
                                    <?php
$sql = "SELECT data.output, data.status, data.id, data.recording FROM data WHERE data.number_id=:stid";
$query = $dbh->prepare($sql);
$query->bindParam(':stid', $stid, PDO::PARAM_STR);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);
$cnt = 1;
if ($query->rowCount() > 0) {
    foreach ($results as $result) {
        echo '<li><a href="tele-dash.php?stid2=' . htmlentities($result->id) . '"><i class="fa fa-home"></i> Home</a></li>';
    }
}
?>
                                        <li class="active">Request Data</li>
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
                                                    <h5>Update The Request Info</h5>
                                                </div>
                                            </div>
                                            <div class="panel-body">
<?php if($msg){?>
<div class="alert alert-success left-icon-alert" role="alert">
 <strong>Well done!</strong><?php echo htmlentities($msg); ?>
 </div><?php } 
else if($error){?>
    <div class="alert alert-danger left-icon-alert" role="alert">
                                            <strong>Oh snap!</strong> <?php echo htmlentities($error); ?>
                                        </div>
                                        <?php } ?>



                                





                                        <form class="form-horizontal" method="post" enctype="multipart/form-data">

<?php
$sql = "SELECT data.output, data.status,data.id, data.recording FROM data WHERE data.number_id=:stid";
$query = $dbh->prepare($sql);
$query->bindParam(':stid', $stid, PDO::PARAM_STR);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);
$cnt = 1;
if ($query->rowCount() > 0) {
    foreach ($results as $result) {
?>
        <div class="form-group">
            <label for="default" class="col-sm-2 control-label">Output</label>
            <div class="col-sm-10">
                <input type="text" name="output" class="form-control" id="output" value="<?php echo htmlentities($result->output) ?>" required="required" autocomplete="off">
            </div>
        </div>

        <div class="form-group">
            <label for="default" class="col-sm-2 control-label">Recording</label>
            <div class="col-sm-10">
                <!-- Change input type to file -->
                <input type="file" name="recording" class="form-control" id="recording"  autocomplete="off">
            </div>
        </div>

        <div class="form-group">
            <label for="default" class="col-sm-2 control-label">Status</label>
            <div class="col-sm-10">
                <?php $stats = $result->status;
                if ($stats == "1") {
                ?>
                    <input type="radio" name="status" value="1" required="required" checked>Active
                    <input type="radio" name="status" value="0" required="required">complete
                <?php } ?>
                <?php
                if ($stats == "0") {
                ?>
                    <input type="radio" name="status" value="1" required="required">Active
                    <input type="radio" name="status" value="0" required="required" checked>Complete
                <?php } ?>
            </div>
        </div>
<?php
    }
}
?>
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" name="submit" class="btn btn-primary">UPDATE</button>
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
