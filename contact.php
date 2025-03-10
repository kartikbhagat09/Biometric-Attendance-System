<?php
  require "db_conn.php";

      $name = $_POST['name'];
      $email = $_POST['email'];
      $subject = $_POST['subject'];
      $message = $_POST['message'];

          $sql = "INSERT INTO `contact`(`name`,`email`,`subject`,`message`) VALUES('$name','$email','$subject','$message')";
          $result = mysqli_query($conn,$sql);

          if($result === TRUE)
          {
            echo "Your message has been sent. Thank you!";
          }
          else
          {
            echo "Error: " . mysqli_error($conn,$result);
          }      
?>