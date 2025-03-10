<?php 
    // var_dump($_POST);
    require "../db_conn.php";
    $class1=$_POST['class1'];
    $batch=$_POST['batch'];

    $sql="SELECT * FROM register_info WHERE class='$class1' AND batch='$batch'";
    $result=mysqli_query($conn,$sql);
    echo "<option value=''>Please Select Student</option>";
    $htm='';
    foreach ($result as $res)
    {
        $htm.= "<option value='".$res['id']."'>".$res['name']."[".$res['enrollment_no']."]</option>";
    }

    echo $htm;
?>