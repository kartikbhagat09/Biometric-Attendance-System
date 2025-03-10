<?php
session_start();
  if(!isset($_SESSION['username']) && !isset($_SESSION['id']))
  {
    header("location: login.php");
  }
?>
<!-- For To and Form Date by using Modal -->


<!-- Modal -->
<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Datewise Attendence</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form action="../Mega_project/pdf.php" method="post">
            <label class="font-weight-bold font-italic ml-4">From : </label>
            <input type="date" class="btn border border-primary ml-4" name="fromDate" id="fromDate" placeholder="MM-DD-YYYY" />
            <br>
            <label class="font-weight-bold font-italic ml-4 mt-3">To : </label>
            <input type="date" class="btn border border-primary ml-5 mt-3" name="toDate" id="toDate" placeholder="MM-DD-YYYY" />
        </div>
        <div class="modal-footer">
            <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
            <button type="submit" class="btn btn-primary" name="export_data">Export</button>
        </div>
    </form>
    </div>
  </div>
</div>

<!Doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="../assets/img/favicon.png" rel="icon">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Attendence Details</title>
    
    <style>
    body{
        width: 100%;
        height: 100%;
        background: url('assets/img/hero-bg.jpg');
    }
</style>
</head>
<div class="m-b6badge text-wrap container-fluid" style="background-color:rgb(235, 242, 250); border: 1px solid rgb(168, 199, 255);">
        <h1 class="text-center">Attendence Details</h1>
      </div>
    <br>
<body class="bg-light mt-5">
    <div class="container-fluid" style="background-color:rgb(235, 242, 250); border: 1px solid rgb(168, 199, 255);">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <!-- lavender,lightsteelblue,rgb(203, 223, 248) -->  
            <a href="../Mega_project/admin_index.php" class="btn btn-primary">Home</a>
          <select class="m-2 btn" name="class_name" id="class_name">
            <option value="" disabled selected>Select Class</option>
            <option value="all">All Classes</option>
            <option value="FY">First Year</option>
            <option value="SY">Second Year</option>
            <option value="TY">Third Year</option>
            
          </select>

          <select class="m-2 btn" name="batch_name" id="batch_name"> <!-- custom-select -->
            <option value="" disabled selected>Select Batch</option>
            <option value="all">All Batches</option>
            <option value="First">1st</option>
            <option value="Second">2<sup>nd</sup></option>
            <option value="Third">3<sup>rd</sup></option>
          </select>

          <input type="date" class="btn" name="current_date" id="current_date" placeholder="MM-DD-YYYY" />
          <input type="submit" name="show_data" value="Show" id="show_data" class="m-2 btn btn-outline-primary" />
          <a href="" class="m-2 btn btn-outline-primary" data-toggle="modal" data-target="#exampleModal">Export</a> 
          <!-- <input type="submit" name="clear_data" value="Clear Attendance" id="clear_data" class="m-2 btn btn-outline-primary" />-->
          
        </form>
    </div>

        <!-- show data -->

            <?php
            if(isset($_POST['show_data']))
            {

                function executeQuerys($result,$result2,$counts_result2){
                    if($result) {
                        if(mysqli_num_rows($result) > 0) {
                            echo '
                                <div class="container-fluid">
                                    <div class="table-responsive bg-white mt-2" id="table_body">
                                        <table class="table table-striped mb-0" id="myTable">
                                            <thead>
                                            <tr>
                                                <th scope="col">Roll Number</th>
                                                <th scope="col">Enrollment Number</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Class</th>
                                                <th scope="col">Batch</th>
                                                <th scope="col">Status</th>
                                            </tr>
                                            </thead>
                                            <tbody>';
                            while($row = mysqli_fetch_array($result)) {
                                echo'
                                    <tr>
                                        <th scope="row">' . $row['roll_number'] . '</th>
                                        <th scope="row">' . $row['enrollment_number'] . '</th>
                                        <th scope="row">' . $row['name'] . '</th>
                                        <th scope="row">' . $row['class'] . '</th>
                                        <th scope="row">' . $row['batch'] . '</th>';
                                        
                                            if($row['status'] == 'Present')
                                            {
                                                echo '
                                                <th scope="row"> 
                                                    <button class="btn btn-success">P</button>
                                                </th>';
                                            }
                                        echo '
                                            </tr>';
                                }
                                if($counts_result2>0)
                                {
                                    while($row = mysqli_fetch_assoc($result2))
                                    {
                                        echo '<tr>
                                        <th scope="row">' . $row['roll_no'] . '</th>
                                        <th scope="row">' . $row['enrollment_no'] . '</th>
                                        <th scope="row">' . $row['name'] . '</th>
                                        <th scope="row">' . $row['class'] . '</th>
                                        <th scope="row">' . $row['batch'] . '</th>
                                        <th scope="row"> <button class="btn btn-danger">A</button> </th>';
                                    }           
                                }

                                echo '
                                </tbody>
                                </table>
                                </div>  
                            </div>'; 
                                    
                    }
                    else{
                        echo '
                        <div class="mx-5 mt-3">
                            <div class="alert alert-dark" role="alert">
                        <h4 class="alert-heading">Empty!</h4>
                        <hr>
                        <p class="mb-0">Data is not available for this date</p>
                    </div>
                    </div>';
                    }
                 }
                }

                if($_SERVER['REQUEST_METHOD']=='POST')
                {
                    
                    
                    if(!(empty($_POST['class_name']) || empty($_POST['batch_name']) || empty($_POST['current_date']) ) )
                    { 
                                $class_name = $_POST['class_name'];
                                $batch_name = $_POST['batch_name'];
                                $current_date = $_POST['current_date'];
                                include 'db_conn.php'; 
                                // echo $class_name;
                                // echo $batch_name;
                            
                                // For all class and batch
                                if($class_name == 'all' && $batch_name == 'all'){
                                    $sql = "SELECT * FROM `attendance_details` WHERE cast(date as date) = '$current_date'";
                                    // echo $sql;
                                    $result=mysqli_query($conn,$sql);

                                    $sql2 = "SELECT `roll_no`,`enrollment_no`,`name`,`class`,`batch` FROM `register_info` WHERE `id` NOT IN (SELECT `user_id` FROM `attendance_details` WHERE cast(date as date) = '$current_date')";
                                    $result2 = mysqli_query($conn,$sql2);
                                    // $counts_result2 = mysqli_
                                    $counts_result2 = mysqli_num_rows($result2);
                                    executeQuerys($result,$result2,$counts_result2);
                                }

                                // For all class and first batch
                                else if($class_name == 'all' && $batch_name == 'First'){
                                    $sql = "SELECT * FROM `attendance_details` WHERE batch='First' AND cast(date as date) = '$current_date'";
                                    // echo $sql;
                                    $result=mysqli_query($conn,$sql);

                                    $sql2 = "SELECT `roll_no`,`enrollment_no`,`name`,`class`,`batch` FROM `register_info` WHERE  batch='First' AND `id` NOT IN (SELECT `user_id` FROM `attendance_details` WHERE cast(date as date) = '$current_date' AND batch='First')";
                                    $result2 = mysqli_query($conn,$sql2);
                                    // $counts_result2 = mysqli_
                                    $counts_result2 = mysqli_num_rows($result2);
                                    executeQuerys($result,$result2,$counts_result2);
                                }

                                // For all class and Second batch
                                else if($class_name == 'all' && $batch_name == 'Second'){
                                    $sql = "SELECT * FROM `attendance_details` WHERE batch='Second' AND cast(date as date) = '$current_date'";
                                    // echo $sql;
                                    $result=mysqli_query($conn,$sql);

                                    $sql2 = "SELECT `roll_no`,`enrollment_no`,`name`,`class`,`batch` FROM `register_info` WHERE  batch='Second' AND `id` NOT IN (SELECT `user_id` FROM `attendance_details` WHERE cast(date as date) = '$current_date' AND batch='Second')";
                                    $result2 = mysqli_query($conn,$sql2);
                                    // $counts_result2 = mysqli_
                                    $counts_result2 = mysqli_num_rows($result2);
                                    executeQuerys($result,$result2,$counts_result2);
                                }

                                // For all class and third batch
                                else if($class_name == 'all' && $batch_name == 'Third'){
                                    $sql = "SELECT * FROM `attendance_details` WHERE batch='Third' AND cast(date as date) = '$current_date'";
                                    // echo $sql;
                                    $result=mysqli_query($conn,$sql);

                                    $sql2 = "SELECT `roll_no`,`enrollment_no`,`name`,`class`,`batch` FROM `register_info` WHERE  batch='Second' AND `id` NOT IN (SELECT `user_id` FROM `attendance_details` WHERE cast(date as date) = '$current_date' AND batch='Third')";
                                    $result2 = mysqli_query($conn,$sql2);
                                    // $counts_result2 = mysqli_
                                    $counts_result2 = mysqli_num_rows($result2);
                                    executeQuerys($result,$result2,$counts_result2);
                                }

                                // For fy class and third batch
                                else if($class_name == 'FY' && $batch_name == 'all'){
                                    $sql = "SELECT * FROM `attendance_details` WHERE class='FY' AND cast(date as date) = '$current_date'";
                                    // echo $sql;
                                    $result=mysqli_query($conn,$sql);

                                    $sql2 = "SELECT `roll_no`,`enrollment_no`,`name`,`class`,`batch` FROM `register_info` WHERE  class='FY' AND `id` NOT IN (SELECT `user_id` FROM `attendance_details` WHERE cast(date as date) = '$current_date' AND class='FY')";
                                    $result2 = mysqli_query($conn,$sql2);
                                    // $counts_result2 = mysqli_
                                    $counts_result2 = mysqli_num_rows($result2);
                                    executeQuerys($result,$result2,$counts_result2);
                                }

                                // For sy class and third batch
                                else if($class_name == 'SY' && $batch_name == 'all'){
                                    $sql = "SELECT * FROM `attendance_details` WHERE class='SY' AND cast(date as date) = '$current_date'";
                                    // echo $sql;
                                    $result=mysqli_query($conn,$sql);

                                    $sql2 = "SELECT `roll_no`,`enrollment_no`,`name`,`class`,`batch` FROM `register_info` WHERE  class='SY' AND `id` NOT IN (SELECT `user_id` FROM `attendance_details` WHERE cast(date as date) = '$current_date' AND class='SY')";
                                    $result2 = mysqli_query($conn,$sql2);
                                    // $counts_result2 = mysqli_
                                    $counts_result2 = mysqli_num_rows($result2);
                                    executeQuerys($result,$result2,$counts_result2);
                                }

                                // For sy class and third batch
                                else if($class_name == 'TY' && $batch_name == 'all'){
                                    $sql = "SELECT * FROM `attendance_details` WHERE class='TY' AND cast(date as date) = '$current_date'";
                                    // echo $sql;
                                    $result=mysqli_query($conn,$sql);

                                    $sql2 = "SELECT `roll_no`,`enrollment_no`,`name`,`class`,`batch` FROM `register_info` WHERE  class='TY' AND `id` NOT IN (SELECT `user_id` FROM `attendance_details` WHERE cast(date as date) = '$current_date' AND class='TY')";
                                    $result2 = mysqli_query($conn,$sql2);
                                    // $counts_result2 = mysqli_
                                    $counts_result2 = mysqli_num_rows($result2);
                                    executeQuerys($result,$result2,$counts_result2);
                                }
                                
                                else{

                                        $sql = "SELECT * FROM `attendance_details` WHERE class='$class_name' AND batch='$batch_name' AND cast(date as date) = '$current_date'";
                                        // echo $sql;
                                        $result=mysqli_query($conn,$sql);
                                        

                                        // for absent
                                        $sql2 = "SELECT `roll_no`,`enrollment_no`,`name`,`class`,`batch` FROM `register_info` WHERE class='$class_name' AND batch='$batch_name' AND `id` NOT IN (SELECT `user_id` FROM `attendance_details` WHERE cast(date as date) = '$current_date' AND batch='$batch_name')";
                                        $result2 = mysqli_query($conn,$sql2);
                                        // $counts_result2 = mysqli_
                                        $counts_result2 = mysqli_num_rows($result2);
                                        // echo $counts_result2;
                                        // print_r(mysqli_fetch_assoc($result2));
                                        executeQuerys($result,$result2,$counts_result2);
                                        
                                        
                                }
                            
                    }
                    else{
                        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Empty fields !</strong> Please Fill / Select All Required Information From Above Form
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
                        
                    }




                    
                }
            }
            ?>

            <!--clear data  -->

        <?php

        // if(isset($_POST['clear_data']))
        // {

        //     if(!(empty($_POST['class_name']) || empty($_POST['batch_name']) || empty($_POST['current_date']) ) )
        //     { 
        //                 $class_name = $_POST['class_name'];
        //                 $batch_name = $_POST['batch_name'];
        //                 $current_date = $_POST['current_date'];

        //                 include 'db_conn.php'; 
        //                 $sql3 = "DELETE FROM `attendance_details` WHERE class='$class_name' AND batch='$batch_name' AND cast(date as date) = '$current_date' ";
                        
        //                 $result3 = mysqli_query($conn,$sql3);
                        
        //                 if($result3)
        //                 {
        //                         echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        //                             <strong>Success !</strong> Data is deleted successfully.
        //                             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        //                             <span aria-hidden="true">&times;</span>
        //                             </button>
        //                             </div>';
        //                 }    
                    
        //     }
        //     else{
        //         echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        //         <strong>Empty fields !</strong> Please Fill / Select All Required Information From Above Form
        //         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        //         <span aria-hidden="true">&times;</span>
        //         </button>
        //     </div>';
                
        //     }
        // }
        ?>
        
    



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>


        <!-- Data-Table for table showing -->
        <link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
        <script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script>    
            $(document).ready( function () {
            $('#myTable').DataTable();
            } );
        </script>

</body>

</html>