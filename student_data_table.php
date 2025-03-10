<?php
session_start();
  if(!isset($_SESSION['username']) && !isset($_SESSION['id']))
  {
    header("location: login.php");
  }
?>


<?php
    // 
    $delete = false;
    $update = false;
    include 'db_conn.php';


    // for delete data from the database
    if(isset($_GET['delete']))
    {
        $roll_data = $_GET['delete'];
        $sql = "DELETE FROM `register_info` WHERE `roll_no` = '$roll_data'";
        $result = mysqli_query($conn,$sql);
        if($result)
        {
            $delete = true;
        }
    }


    // Update the record
    if(isset($_POST['submit_change']))
    {
            $roll_ch = $_POST['roll_ch'];
            $store_data = $_POST['store_data'];
            $enroll_ch = $_POST['enroll_ch'];
            $name_ch = $_POST['name_ch'];
            $class_ch = $_POST['class_ch'];
            $batch_ch = $_POST['batch_ch'];
            $contact_ch = $_POST['contact_ch'];

            $sql3 = "UPDATE `register_info` SET `name`='$name_ch',`class`='$class_ch',`batch`='$batch_ch',`enrollment_no`='$enroll_ch',`roll_no`='$roll_ch',`phone`='$contact_ch' WHERE `roll_no`='$store_data'   ";
            $result3 = mysqli_query($conn,$sql3);

            if($result3){
                $update = true;
            }
    }
   
?>


<!doctype html>
<html lang="en">
    <style>
        body{
            width: 100%;
            height: 100%;
            background: url('assets/img/hero-bg.jpg');
        }
    </style>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="assets/img/favicon.png" rel="icon">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Registered Student's</title>
</head>











<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#changeModal">
  Launch demo modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="changeModal" tabindex="-1" aria-labelledby="changeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="changeModalLabel">Update Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


        <form action="#" method="post">




            <div class="mb-3 row">
                <label for="exampleInputEmail1" class="form-label" style="margin:5px 0px 0px 10px; font-weight:bold;">Roll No.</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="roll_ch" id="roll_ch">
                    <input type="hidden" class="form-control" name="store_data" id="store_data">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="exampleInputEmail1" class="form-label" style="margin:5px 0px 0px 10px; font-weight:bold;">Enr. No.</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="enroll_ch" id="enroll_ch">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="exampleInputEmail1" class="form-label" style="margin:5px 14px 0px 10px; font-weight:bold;">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="name_ch" id="name_ch">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="exampleInputEmail1" class="form-label" style="margin:5px 20px 0px 10px; font-weight:bold;">Class</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="class_ch" id="class_ch">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="exampleInputEmail1" class="form-label" style="margin:5px 17px 0px 10px; font-weight:bold;">Batch</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="batch_ch" id="batch_ch">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="exampleInputEmail1" class="form-label" style="margin:5px 0px 0px 10px; font-weight:bold;">Contact</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control"  name="contact_ch" id="contact_ch">
                </div>
            </div>

            <button type="submit" name="submit_change" class="btn btn-primary">Save changes</button>

        </form>






        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<?php
 
?>












<div class="m-b6badge text-wrap container-fluid" style="background-color:rgb(235, 242, 250); border: 1px solid rgb(168, 199, 255);">
        <h1 class="text-center">Registered Student's</h1>
      </div>
    <br>
<body class="bg-light mt-5">
    <div class="container-fluid" style="background-color:rgb(235, 242, 250); border: 1px solid rgb(168, 199, 255);">
        <form method="post" action="#">
            <!-- lavender,lightsteelblue,rgb(203, 223, 248) -->  
            <a href="../Mega_project/admin_index.php" class="btn btn-primary">Home</a>
          <select class="m-2 btn" name="class_name" id="class_name">
            <option value="" disabled selected>Select Class</option>
            <option value="FY">First Year</option>
            <option value="SY">Second Year</option>
            <option value="TY">Third Year</option>
          </select>

          <select class="m-2 btn" name="batch_name" id="batch_name"> <!-- custom-select -->
            <option value="" disabled selected>Select Batch</option>
            <option value="First">1st</option>
            <option value="Second">2<sup>nd</sup></option>
            <option value="Third">3<sup>rd</sup></option>
          </select>

          <input type="submit" name="show_data" value="Show" id="show_data" class="m-2 btn btn-outline-primary" />
          
        </form>
    </div>


    <?php
        // Displaying alerts
        if($delete)
        {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success !</strong> Your data has been deleted successfully
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
        }
        if($update)
        {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success !</strong> Your data has been changed successfully.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
        }
    ?>





        <?php
            if($_SERVER['REQUEST_METHOD'] =='POST')
            {
                
                if(isset($_POST['show_data']))
                {

                
                            if(! (empty($_POST['class_name'])  || empty($_POST['batch_name']) ) )
                            { 
                                    $class_name = $_POST['class_name'];
                                    $batch_name = $_POST['batch_name'];
                                    
                                    include 'db_conn.php'; 
                                    $sql = "SELECT * FROM `register_info` WHERE class='$class_name' AND batch='$batch_name'";
                                    // echo $sql;
                                    $result=mysqli_query($conn,$sql);
                                    
                                if($result) {
                                if(mysqli_num_rows($result) > 0) {
                                    echo '
                                    <div class="container-fluid">
                                        <div class="table-responsive bg-white mt-2" id="table_body">
                                            <table class="table table-striped mb-0 pe-0" id="myTable">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Roll Number</th>
                                                        <th scope="col">Enrollment Number</th>
                                                        <th scope="col">Name</th>
                                                        <th scope="col">Class</th>
                                                        <th scope="col">Batch</th>
                                                        <th scope="col">Contact</th>
                                                        <th scope="col">Delete</th>
                                                        <th scope="col">Update</th>
                                                    </tr>
                                                </thead>
                                                <tbody>';
                                        
                                    while($row = mysqli_fetch_array($result)) {
                                        
                                        
                                        echo '
                                        <tr>
                                            <th scope="row">' . $row['roll_no'] . '</th>
                                            <th scope="row">' . $row['enrollment_no'] . '</th>
                                            <th scope="row">' . $row['name'] . '</th>
                                            <th scope="row">' . $row['class'] . '</th>
                                            <th scope="row">' . $row['batch'] . '</th>
                                            <th scope="row">' . $row['phone'] . '</th>
                                            <th scope="row">
                                                <button class="btn btn-outline-danger delete" name="delete" id="' . $row['roll_no'] . '">Delete</button>
                                            </th>
                                            <th scope="row">
                                                <button class="btn btn-outline-success update" name="update" id="' . $row['roll_no'] . '">Update</button>
                                            </th>
                                        </tr>';

                            
                                        }
                                        echo '
                                        </tbody>
                                    </table>
                                </div>   
                            </div> ';

                                    }
                                    else{
                                        echo '
                                        <div class="mx-5 mt-3">
                                            <div class="alert alert-dark" role="alert">
                                        <h4 class="alert-heading">Empty!</h4>
                                        <hr>
                                        <p class="mb-0">Data is not available for this class and batch</p>
                                    </div>
                                    </div>';
                                    }

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

        








        <script>
                    update = document.getElementsByClassName('update');
                    Array.from(update).forEach((element)=>{
                        element.addEventListener("click",(e)=>{
                            console.log("update");
                            tr = e.target.parentNode.parentNode;
                            roll_change = tr.getElementsByTagName("th")[0].innerText;
                            enroll_change = tr.getElementsByTagName("th")[1].innerText;
                            name_change = tr.getElementsByTagName("th")[2].innerText;
                            class_change = tr.getElementsByTagName("th")[3].innerText;
                            batch_change = tr.getElementsByTagName("th")[4].innerText;
                            contact_change = tr.getElementsByTagName("th")[5].innerText;

                            // for display
                            console.log(roll_change)
                            console.log(enroll_change)
                            console.log(name_change)
                            console.log(class_change)
                            console.log(batch_change)
                            console.log(contact_change)
                            
                           
                            // setting values
                            roll_ch.value = roll_change;
                            store_data.value = roll_change;
                            enroll_ch.value = enroll_change;
                            name_ch.value = name_change;
                            class_ch.value = class_change;
                            batch_ch.value = batch_change;
                            contact_ch.value = contact_change;

                            $('#changeModal').modal('toggle');

                        })
                    })

                    deletes = document.getElementsByClassName('delete');
                    Array.from(deletes).forEach((element)=>{
                        element.addEventListener("click",(e)=>{
                            roll_data = e.target.id;
                            console.log(roll_data);
                            if(confirm('Are you sure you want to delete this note!'))
                            {
                                console.log('yes');
                                window.location = `/mega_project/student_data_table.php?delete=${roll_data}`;
                            }
                            // else
                            // {
                            //     console.log('no');
                            // }
                        })
                    })
        </script>
        
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
