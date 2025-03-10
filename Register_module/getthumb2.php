<?php 
// var_dump($_POST);
require "../db_conn.php";
// $user_id=$_POST['user_id'];
// $batch=$_POST['batch'];

$sql="SELECT * FROM register_info";
$result=mysqli_query($conn,$sql);
$thumbs=[];
$users=[];
$i=0;
foreach ($result as $res)
{
    $users[$i]=$res['id'];
    $thumbs[$i]= $res['fingerprint'];
    $i++;
    // Key = user id   // value == thumb
}
$final['users']=$users;
$final['thumbs']=$thumbs;
echo json_encode($final);
?>