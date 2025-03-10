<?php 
// var_dump($_POST);
require "../db_conn.php";
$user_id=$_POST['user_id'];
// $batch=$_POST['batch'];

$sql="SELECT * FROM register_info WHERE id='$user_id'";
$result=mysqli_query($conn,$sql);

foreach ($result as $res)
{
    echo $res['fingerprint'];
}

?>