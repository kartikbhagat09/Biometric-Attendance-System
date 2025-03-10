<?php
session_start();
if (!isset($_SESSION['username']) && !isset($_SESSION['id'])) {
    header("location: ../login.php");
} else {
    if (isset($_POST['submit'])) {
        // var_dump($_POST); die();
        require "../db_conn.php";
        $name = $_POST['name'];
        
        $class = isset($_POST['class']);
        if ($class == 1) {
            $class = $_POST['class'];
        } else {
            // if you want something then type
        }
        $batch = isset($_POST['batch']);
        if ($batch == 1) {
            $batch = $_POST['batch'];
        } else {
            // if you want something then type
        }
        
        
        $enrollment_no = $_POST['enrollment_no'];
        $roll_no = $_POST['roll_no'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $fingureprint = mysqli_real_escape_string($conn, $_POST['txtIsoTemplate']);
        $fg = isset($_POST['txtIsoTemplate']);
        
        
        $sql = "SELECT * from register_info WHERE batch = '$batch' AND class = '$class' AND roll_no = '$roll_no'";
            $result = mysqli_query($conn, $sql);
            if ( ($result) && ( mysqli_num_rows($result) > 0 ) ){
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Roll No Already Exists For given Batch and Class!</strong> Unique ROll NO + Batch + Class Combination required .
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
            }
        
        else{
        
            $sql = "SELECT * from register_info WHERE enrollment_no = '$enrollment_no' ";
            $result = mysqli_query($conn, $sql);

            // for fingerprint
            $sql2 = "SELECT * from register_info WHERE `fingerprint` = '$fg' ";
            $result2 = mysqli_query($conn, $sql2);

            if ( ($result) && ( mysqli_num_rows($result) > 0 ) )
            {
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Enrollment Number ['.$enrollment_no.'] Already Exists !</strong> Please try to register again with unique Enrollment Number.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
            } 

            //  for fingerprint
            else if ( ($result2) && ( mysqli_num_rows($result2) > 0 ) )
            {
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Fingerprint Already Exists !</strong> Please try to register again with unique Fingerprint
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
            } else {
                    if (
                        empty($_POST['name']) || empty($_POST['class']) || empty($_POST['batch']) || empty($_POST['enrollment_no']) || empty($_POST['roll_no']) || empty($_POST['txtIsoTemplate'])
                    ) {
                        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Empty Fields!</strong> You are not fullfilled all the requirements.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
                    } else {
                        $sql = "INSERT INTO `register_info`(`name`,`class`,`batch`,`enrollment_no`,`roll_no`,`phone`,`email`,`fingerprint`) VALUES('$name','$class','$batch','$enrollment_no','$roll_no','$phone','$email','$fingureprint')";
                        $result = mysqli_query($conn, $sql);
                        if ($result) {
                            
                            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Successfull!</strong> Data has been successfully saved.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
                        } else {
                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> Your data has not Registered Because ' . mysqli_error($conn) . '
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
                        }
                    }
            }
            
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
    <title> New Registration </title>

    <link href="../assets/img/favicon.png" rel="icon">
    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="vendor/jquery-ui/jquery-ui.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">
</head>
<style>
    body {
        /* width: 100%;
        height: 100%; */
        margin-top: -115px;
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
                    <form name="form1" action="register.php" method="POST" id="signup-form" class="signup-form">
                        <h2> Register </h2>
                        <div class="form-group">
                            <label for="name">Name <span style="color:red">*</span></label>
                            <input type="text" class="form-input" name="name" id="alpha-only-input" maxlength="100" required/>
                        </div>
                        <div class="form-row">
                            <div class="form-radio">
                                <label for="class">Class <span style="color:red">*</span></label>
                                <div class="form-flex">
                                    <input type="radio" name="class" value="FY" id="FY" required/>
                                    <label for="FY">FY</label>

                                    <input type="radio" name="class" value="SY" id="SY" required/>
                                    <label for="SY">SY</label>

                                    <input type="radio" name="class" value="TY" id="TY" required/>
                                    <label for="TY">TY</label>
                                </div>
                            </div>

                            <div class="form-radio">
                                <label for="batch">Batch <span style="color:red">*</span></label>
                                <div class="form-flex">
                                    <input type="radio" name="batch" value="First" id="first" required/>
                                    <label for="first">1 <sup>st</sup></label>

                                    <input type="radio" name="batch" value="Second" id="second" required/>
                                    <label for="second">2 <sup>nd</sup></label>

                                    <input type="radio" name="batch" value="Third" id="third" required/>
                                    <label for="third">3 <sup>rd</sup></label>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="enrollmen_no">Enrollment number <span style="color:red">*</span></label>
                                <input type="text" class="form-input" name="enrollment_no" id="numberField" maxlength="10" required/>
                            </div>
                            <div class="form-group">
                                <label for="rollno">Roll No <span style="color:red">*</span></label>
                                <input type="number" class="form-input" name="roll_no" id="roll_no"maxlength="10" required/>
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="enrollmen_no">Scan Via Biometric MFS 100</label>
                                <button id="captureButton" class="btn btn-outline-primary">Click To Scan</button>
                            </div>
                            <div class="form-group">
                                <label for="rollno">Status</label>
                                <p><b>Error Code : </b> <span id="ErrorCode"></span></p>
                                <p><b>Error Description : </b> <span id="ErrorDescription"></span></p>
                            </div>

                            <div class="form-group">
                                <input type="hidden" id="txtIsoTemplate" class="form-input" name="txtIsoTemplate" required/>
                            </div>

                        </div>
                        <div class="form-text">
                            <a href="#" class="add-info-link"><i class="zmdi zmdi-chevron-right"></i>Additional info</a>
                            <div class="add_info">
                                <div class="form-group">
                                    <label for="phone">Phone number</label>
                                    <input type="number" class="form-input" name="phone" id="phone" />
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-input" name="email" id="email" maxlength="55" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" id="submit" class="form-submit" value="Submit" />
                        </div>
                    </form>
                </div>
            </div>
        </section>

    </div>

    <script>
        const alphaOnlyInput = document.getElementById('alpha-only-input'),
        alphaOnlyPattern = new RegExp('^[a-zA-Z ]+$')

        let previousValue = ''

        alphaOnlyInput.addEventListener('input', (e) => {
        let currentValue = alphaOnlyInput.value

        if (e.inputType.includes('delete') || alphaOnlyPattern.test(currentValue)) {
            previousValue = currentValue
        }

        alphaOnlyInput.value = previousValue
    })

    var userName = document.querySelector('#numberField');

    userName.addEventListener('input', restrictNumber);
    function restrictNumber (e) {  
    var newValue = this.value.replace(new RegExp(/[^\d]/,'ig'), "");
    this.value = newValue;
    }

    </script>
   
    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/jquery-ui/jquery-ui.min.js"></script>
    <script src="vendor/jquery-validation/dist/jquery.validate.min.js"></script>
    <script src="vendor/jquery-validation/dist/additional-methods.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/mfs100-9.0.2.6.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
        $("#captureButton").click(function(event) {
            event.preventDefault();
            console.log('clicked');
            Capture();
        });

        var flag = 1;
        var quality = 60; //(1 to 100) (recommanded minimum 55)
        var timeout = 10; // seconds (minimum=10(recommanded), maximum=60, unlimited=0 )
        function Capture() {
             try {
                 
                 document.getElementById('ErrorCode').innerHTML = "";
                 document.getElementById('ErrorDescription').innerHTML ="";
                 document.getElementById('txtIsoTemplate').value = "";
                 
                 var res = CaptureFinger(quality, timeout);
                 if (res.httpStaus) {
                    
                     document.getElementById('ErrorCode').innerHTML= res.data.ErrorCode;
                     document.getElementById('ErrorDescription').innerHTML= res.data.ErrorDescription;
                     
         
                     if (res.data.ErrorCode == "0") {
                         var currentthumb=res.data.IsoTemplate;
                         document.getElementById('txtIsoTemplate').value = res.data.IsoTemplate;
                         
                         $.ajax({
         url: "getthumb.php", 
         type: "POST",
         //   dataType: "formData",
         //   contentType: "application/json; charset=utf-8",
         //   data: { class1: class1, batch: batch },
         success: function (result) {
        //  alert(result);
         var thumbs=JSON.parse(result);
          for (var i = 0; i < thumbs.length; i++) {
          
            //   alert(thumbs[i]);
             var res= VerifyFinger(thumbs[i],currentthumb);
             if(res.data.Status)
             { 
                 flag=0;
                 alert('This Fingerprint is already Captured, Please try register with proper data');
                 document.getElementById('txtIsoTemplate').value = null;
                 document.getElementById('enrollment_no').value = null;
                 document.getElementById('roll_no').value = null;
                 document.getElementById('name').value = null;
                 
             }
          }
          console.log(flag);
          if(flag==1)
          { 
               alert('Fingureprit Captured successfully');
          }
         //   $('#user_id').html(result);
         //   $('#user_id').select2();
         //   $('#user_id').trigger('change.select2');
         //   $('#user_id').val(user_id);
         
         
         // when call is sucessfull
         },
         error: function (err) {
         // check the err for error details
         }
         });
         
         
         
         
             
                     }
                 } else {
                     alert(res.err);
                 }
             } catch (e) {
                 alert(e);
             }
             return false;
         }
    </script>
</body>

</html>

<?php

// require "../assets/footer.php";
?>