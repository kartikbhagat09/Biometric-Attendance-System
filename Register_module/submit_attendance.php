<?php
require "../db_conn.php";
$current_date=date('Y-m-d');
session_start();
  if(!isset($_SESSION['username']) && !isset($_SESSION['id']))
  {
    header("location: ../login.php");
  }
  else
  {
    if(isset($_POST['submit']))
    {
        $user_id=$_POST['user_id'];
        $fingerprint= $_POST['txtIsoTemplate'];
        $sql = "SELECT * from register_info WHERE id = '$user_id'";
        // echo $sql;
        $result = mysqli_query($conn, $sql);
        // var_dump($result);
        if($result && (mysqli_num_rows($result)>0))
        {
            // echo "43";
            foreach ($result as $res)
            {
                $roll_number=$res['roll_no'];
                $enrollment_no=$res['enrollment_no'];
                $name=$res['name'];
                $class=$res['class'];
                $batch=$res['batch'];
                // $phone_number=$res['phone'];
                // $email_address=$res['email'];
            }
            
            
            $sql="SELECT * FROM `attendance_details` WHERE user_id='$user_id' AND cast(date as date) = '$current_date'";
            // echo $sql;
            $result = mysqli_query($conn, $sql); 
            // var_dump($result);
            if($result && (mysqli_num_rows($result)>0)){
            
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Attendance Already Recorded!</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
            }
            else{
                $sql = "INSERT INTO `attendance_details`(`roll_number`,`enrollment_number`,`name`,`class`,`batch`,`user_id`,`status`) VALUES('$roll_number','$enrollment_no','$name','$class','$batch','$user_id','Present')";
                
                // echo $sql;
                $result = mysqli_query($conn, $sql);        
                
            
                if($result){
                    
                    echo '<div class="alert alert-success alert-dismissible fade show" id="myAlert" role="alert">
                        <strong>Successfull!</strong> Attendance Has Been Recorded Successfully For ['.$name.']. With Enrollment No['.$enrollment_no.'] for Today..
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
                }
                else {
                                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> Your data has not Registered Because ' . mysqli_error($conn) . '
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
                }
            }
            
            
            
            
        }
        else{
         echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>The Given fingerprint Not Exists!</strong> The Given Fingerprint is not registered with any username , please try to register this Fingerprint with Student Registration <a href="register.php">Here</a>.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';   
        }
        
        
            
    }
  }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Submit Attendance </title>

    <link href="../assets/img/favicon.png" rel="icon">
    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="vendor/jquery-ui/jquery-ui.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.5/css/selectize.bootstrap4.css" integrity="sha512-M0fkc9GMhTLHze2/hto0+HPuXk8rCHCCAsDDyX4IqUB62nrKFlFgFtzy3pjrsi/GZM4gWKo7jxigM3U6Sh4xtQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

</head>
<style>
    body{
        /* width: 100%;
        height: 100%; */
        margin-top : -115px;
        background: url('../assets/img/hero-bg.jpg');
    }
</style>
<body>
    
    <div class="main" style="margin-top: 80px;">

        <section class="signup">

            <!-- <img src="images/signup-bg.jpg" alt=""> -->
            <div class="container">
                <h6><a href="..\admin_index.php" class="btn btn-primary">Home</a></h6>
                <div class="signup-content">
                    <form action="submit_attendance.php" method="POST" id="submit-attendance-form" class="signup-form" >
                    <h2> Submit Attendance </h2>
                        
                        <!-- <div class="form-row"> -->
                            <div class="form-row">
                            
                                <div class="form-group">
                                    <label for="captureButton">Scan Via Biometric MFS 100</label>
                                    <button id="captureButton" class="btn btn-outline-success">Click To Scan</button>
                                    <input type="hidden" id="user_biometric" name="user_biometric" >
                                </div>

                                <div class="form-group">
                                    <label for="rollno">Status</label>
                                    <p><b>Error Code : </b> <span id="ErrorCode"></span></p>
                                    <p><b>Error Description : </b> <span id="ErrorDescription"></span></p>
                                </div>

                            </div>
                        
                        <div class="form-group">
                            <input type="submit" name="submit" id="submit" class="form-submit" style="visibility: hidden;" value="Submit"/>
                        </div>
                    </form>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <!--<script src="vendor/jquery/jquery.min.js"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="vendor/jquery-ui/jquery-ui.min.js"></script>
    <script src="vendor/jquery-validation/dist/jquery.validate.min.js"></script>
    <script src="vendor/jquery-validation/dist/additional-methods.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/mfs100-9.0.2.6.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <!--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>-->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>

var final=[];
var flag =0;
var quality = 60; //(1 to 100) (recommanded minimum 55)
var timeout = 10; // seconds (minimum=10(recommanded), maximum=60, unlimited=0 )
var user_id = 0;
$( document ).ready(function() {
    console.log( "ready!" );
    $.ajax({
   url: "getthumb2.php", 
   type: "POST",
//   dataType: "formData",
//   contentType: "application/json; charset=utf-8",
   data: { },
   success: function (result) {
    //   alert(result);
      final=result;
    //   alert(thumbs);
    //   $('#user_id').select2();
    //   $('#user_id').trigger('change.select2');
    //   $('#user_id').val(user_id);
       

       // when call is sucessfull
    },
    error: function (err) {
    // check the err for error details
    }
 }); // ajax call closing

});
    
    $( "#captureButton" ).click(function( event ) {
  event.preventDefault();
  console.log('clicked');
  Capture();
  
    });
    
    
    
    function Capture() {
             try {
                 
                 document.getElementById('ErrorCode').innerHTML = "";
                 document.getElementById('ErrorDescription').innerHTML ="";
                //  document.getElementById('txtIsoTemplate').value = "";
                 
                 var res = CaptureFinger(quality, timeout);
                 if (res.httpStaus) {
                    
                     document.getElementById('ErrorCode').innerHTML= res.data.ErrorCode;
                     document.getElementById('ErrorDescription').innerHTML= res.data.ErrorDescription;
                     
         
                     if (res.data.ErrorCode == "0") {
                         var currentthumb=res.data.IsoTemplate;
                        //  console.log(thumbs);
                        //  var users = thumbs;
                         var final1=JSON.parse(final);
                         console.log(final1);
                         console.log(final1.users);
                         var users=final1.users;
                         console.log(final1.thumbs);
                         var thumbs=final1.thumbs;
                        //  console.log(users);
                         for(i=0; i<thumbs.length;i++)
                         {
                             
                            var thumb=thumbs[i];
                            var user=users[i];
                             console.log(user);
                              var res= VerifyFinger(thumb,currentthumb);
                             if(res.data.Status)
                             { 
                                 flag=1;
                                 user_id=user;
                                 console.log('User Found');
                                    console.log('user id'+user);
                                    
                                //   Set Ajax to Add attendance record without refreshing page if thumb matches
                             }
                         }
                        //   users.forEach(function(element, index) { 
                          
                        //       console.log(element);
                        //      var res= VerifyFinger(element,currentthumb);
                        //      if(res.data.Status)
                        //      { 
                        //          flag=1;
                        //          user_id=index;
                        //          console.log('User Found');
                        //             console.log('user id'+user_id);
                                    
                        //         //   Set Ajax to Add attendance record without refreshing page if thumb matches
                        //      }
                        //   });
                          console.log(flag);
                          if(flag==1)
                            {
                                $.ajax({
                         url: "attendance.php", 
                         type: "POST",
                         //   dataType: "formData",
                         //   contentType: "application/json; charset=utf-8",
                            data: { user_id: user_id },
                         success: function (result) {
                         alert(result);
                         

                         
                         
                         // when call is sucessfull
                         },
                         error: function (err) {
                         // check the err for error details
                         }
                         });
            }
                          else{
                              alert('This Fingure Print is not registered with any user, please try again with registered fingure print');
                          }
                        
         
         
         
         
             
                     }
                 } else {
                     alert(res.err);
                 }
             } catch (e) {
                 alert(e);
             }
            // location.reload();
            
             return false;
             
         }
    
    


</script>
</body>
</html>

<?php

    // require "../assets/footer.php";
?>  