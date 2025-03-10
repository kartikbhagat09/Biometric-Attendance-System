<?php 
// var_dump($_POST);
require "../db_conn.php";
// $user_id=$_POST['user_id'];
// $batch=$_POST['batch'];

$sql="SELECT * FROM register_info";
$result=mysqli_query($conn,$sql);
$thumbs=[];
foreach ($result as $res)
{
    $thumbs[]= $res['fingerprint'];
}

echo json_encode($thumbs);
?>