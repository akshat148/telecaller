
<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])=="")
    {   
    header("Location: index.php"); 
    }
    else{

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Admin Manage Clients Requests</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" media="screen" >
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen" >
        <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen" >
        <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen" >
        <link rel="stylesheet" href="css/prism/prism.css" media="screen" > <!-- USED FOR DEMO HELP - YOU CAN REMOVE IT -->
        <link rel="stylesheet" type="text/css" href="js/DataTables/datatables.min.css"/>
        <link rel="stylesheet" href="css/main.css" media="screen" >
        <script src="js/modernizr/modernizr.min.js"></script>
          <style>
        .errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}

/* Custom CSS to hide Gender column on mobile */
@media (max-width: 767px) {
    #example th:nth-child(4),
    #example td:nth-child(4) {
        display: none;
    }
    #example th:nth-child(5),
    #example td:nth-child(5) {
        display: none;
    }
    #example th:nth-child(7),
    #example td:nth-child(7) {
        display: none;
    }
    #example th:nth-child(8),
    #example td:nth-child(8) {
        display: none;
    }
    #example th:nth-child(9),
    #example td:nth-child(9) {
        display: none;
    }
    @media (max-width: 500px) {
    #example th:nth-child(4),
    #example td:nth-child(4) {
        display: none;
    }
    #example th:nth-child(5),
    #example td:nth-child(5) {
        display: none;
    }
    #example th:nth-child(6),
    #example td:nth-child(6) {
        display: none;
    }
    #example th:nth-child(7),
    #example td:nth-child(7) {
        display: none;
    }
    #example th:nth-child(8),
    #example td:nth-child(8) {
        display: none;
    }
    #example th:nth-child(9),
    #example td:nth-child(9) {
        display: none;
    }
}


        </style>
    </head>
    <body class="top-navbar-fixed">
        <div class="main-wrapper">

            <!-- ========== TOP NAVBAR ========== -->
   <?php include('includes/topbar.php');?> 
            <!-- ========== WRAPPER FOR BOTH SIDEBARS & MAIN CONTENT ========== -->
            <div class="content-wrapper">
                <div class="content-container">
<?php include('includes/leftbar.php');?>  

                    <div class="main-page">
                        <div class="container-fluid">
                            <div class="row page-title-div">
                                <div class="col-md-6">
                                    <h2 class="title">Manage Quote Requests</h2>
                                
                                </div>
                                
                                <!-- /.col-md-6 text-right -->
                            </div>
                            <!-- /.row -->
                            <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
            							<li><a href="callback.php"><i class="fa fa-home"></i> Home</a></li>
                                        <li> Requests</li>
            							<li class="active">Manage Quote Requests</li>
            						</ul>
                                </div>
                             
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.container-fluid -->

                      <section class="section">
                            <div class="container-fluid">

                             

                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="panel">
                                            <div class="panel-heading">
                                                <div class="panel-title">
                                                    <h5>View Request Info</h5>
                                                </div>
                                            </div>
<?php if($msg){?>
<div class="alert alert-success left-icon-alert" role="alert">
 <strong>Well done!</strong><?php echo htmlentities($msg); ?>
 </div><?php } 
else if($error){?>
    <div class="alert alert-danger left-icon-alert" role="alert">
                                            <strong>Oh snap!</strong> <?php echo htmlentities($error); ?>
                                        </div>
                                        <?php } ?>
                                            <div class="panel-body p-20">

                                                 <table id="example" class="display table table-striped table-bordered " cellspacing="0" width="100%" >
                                                    <thead>
                                                        <tr width="95%" >
                                                            <th width="5%" >#</th>
                                                            <th width="15%" >Clients Name</th>
                                                            <th width="5%" >Request Id</th>
                                                            
                                                            <th width="15%" >Email</th>
                                                            <th width="10%" >Contact No.</th>
                                                            <th width="15%" >Address</th>
                                                            <th width="20%" >Reg Date</th>
                                                            <th width="5%">Status</th>

                                                            <th width="5%" >Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tfoot>
                                                        <tr>
                                                        <tr width="95%" >
                                                            <th width="5%" >#</th>
                                                            <th width="15%" >Clients Name</th>
                                                            <th width="5%" >Request Id</th>
                                                            
                                                            <th width="15%" >Email</th>
                                                            <th width="10%" >Contact No.</th>
                                                            <th width="15%" >Address</th>
                                                            <th width="20%" >Reg Date</th>
                                                            <th width="5%">Status</th>

                                                            <th width="5%" >Action</th>
                                                        </tr>
                                                    </tfoot>
                                                    <tbody>
                                                    <?php
// Updated formatDate function to handle different date formats
function formatDate($dateString) {
    $date = DateTime::createFromFormat('Y-m-d H:i:s', $dateString);

    // If creating DateTime fails, attempt with 'Y-m-d' format
    if ($date === false) {
        $date = DateTime::createFromFormat('Y-m-d', $dateString);
    }

    // If successful, return formatted date; otherwise, return the original date
    return $date ? $date->format('d-m-Y') : $dateString;
}
?>
<?php $sql = "SELECT quote.first_name,quote.id,quote.phone,quote.email,quote.city,quote.country,quote.status,quote.RegDate,quote.comments, CONCAT(quote.city, ', ', quote.country) AS addr  from quote ";
$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{ 
      ?>
<tr>
                                                            <td width="5%"><?php echo htmlentities($cnt);?></td>
                                                            <td width="15%"><?php echo htmlentities($result->first_name);?></td>
                                                            <td width="5%"><?php echo htmlentities($result->id);?></td>
                                                            <td width="15%"><?php echo htmlentities($result->email);?></td>
                                                            <td width="10%"><?php echo htmlentities($result->phone);?></td>
                                                            <td width="15%"><?php echo htmlentities($result->addr);?></td>
                                                            <td width="20%"><?php echo htmlentities(formatDate($result->RegDate));?></td>
                                                            <td><?php if($result->status==1){
echo htmlentities('Active');
}
else{
    echo htmlentities('Completed'); 
 }
                                                                 ?></td>
                                                             
<td width="5%">
<a href="edit-quote.php?stid=<?php echo htmlentities($result->id);?>"><i class="fa fa-edit" title="Edit Record"></i> </a> 


</td>
</tr>
<?php $cnt=$cnt+1;}} ?>
                                                       
                                                    
                                                    </tbody>
                                                </table> 

                                         
                                                <!-- /.col-md-12 -->
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-md-6 -->

                                                               
                                                </div>
                                                <!-- /.col-md-12 -->
                                            </div>
                                        </div>
                                        <!-- /.panel -->
                                    </div>
                                    <!-- /.col-md-6 -->

                                </div>
                                <!-- /.row -->

                            </div>
                            <!-- /.container-fluid -->
                        </section>
                        <!-- /.section -->

                    </div>
                    <!-- /.main-page -->

                    

                </div>
                <!-- /.content-container -->
            </div>
            <!-- /.content-wrapper -->

        </div>
        <!-- /.main-wrapper -->

        <!-- ========== COMMON JS FILES ========== -->
        <script src="js/jquery/jquery-2.2.4.min.js"></script>
        <script src="js/bootstrap/bootstrap.min.js"></script>
        <script src="js/pace/pace.min.js"></script>
        <script src="js/lobipanel/lobipanel.min.js"></script>
        <script src="js/iscroll/iscroll.js"></script>

        <!-- ========== PAGE JS FILES ========== -->
        <script src="js/prism/prism.js"></script>
        <script src="js/DataTables/datatables.min.js"></script>

        <!-- ========== THEME JS ========== -->
        <script src="js/main.js"></script>
        <script>
            $(function($) {
                $('#example').DataTable();

                $('#example2').DataTable( {
                    "scrollY":        "300px",
                    "scrollCollapse": true,
                    "paging":         false
                } );

                $('#example3').DataTable();
            });
        </script>
    </body>
</html>
<?php } ?>

