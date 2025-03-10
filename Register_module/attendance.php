
<?php 
// var_dump($_POST);
require "../db_conn.php";
$user_id=$_POST['user_id'];
$current_date=date('Y-m-d');
// $batch=$_POST['batch'];

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
            
                echo 'Attendance Already Recorded For The User : '.$name;
                $attendace_taken = True;
                
                
            }
            else{
                $sql = "INSERT INTO `attendance_details`(`roll_number`,`enrollment_number`,`name`,`class`,`batch`,`user_id`,`status`) VALUES('$roll_number','$enrollment_no','$name','$class','$batch','$user_id','Present')";
            
            // echo $sql;
            $result = mysqli_query($conn, $sql);        
            if($result){
                echo ' Attendance Has Been Recorded Successfully For ['.$name.']. With Enrollment No['.$enrollment_no.'] for Today..';
                $attendace_name = $name;
                $attendace_enroll = $enrollment_no;
                $attendace = True;
               

                
            }
            else {
                            echo '<strong>Error!</strong> Your data has not Registered Because ' . mysqli_error($conn);
                            $finger_error = True;
                            
                            
            }
            }
            
               
        }
        else{
         echo 'The Given Fingerprint is not registered with any username , please try to register this Fingerprint with Student Registration';  
         $not_register = True;
         
        } 
        
?>