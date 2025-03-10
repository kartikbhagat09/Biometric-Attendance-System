<?php
    require "assets/header.php";
    session_start();
    // var_dump($_SESSION);
    if(isset($_SESSION)){
        if(isset($_SESSION['role']))
        {
            if($_SESSION['role']=='admin')
            header("Location: /Mega_project/admin_index.php");
        }
    }
    $showError = False;
  
     require "db_conn.php";
        if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['role']))
        {
            function test_input($data)
            {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
    
            $username = test_input($_POST['username']);
            $password = test_input($_POST['password']);
            $role = test_input($_POST['role']);
    
            if(empty($username))
            {
               $showError = "Username is Require";
             
            }
            else if(empty($password))
            {
                $showError = "Password is Required";
            }
            else
            {
               
                // Hashing the password
                $password = ($password);
    
                $sql = "SELECT * FROM `users` WHERE username = '$username' AND password = '$password'";
    
                $result = mysqli_query($conn, $sql);
    
                if(mysqli_num_rows($result) === 1)
                {
                    //the user name must be unique
                    $row = mysqli_fetch_assoc($result);
                    
                    // echo "<pre>";
                    // print_r($row);
    
                    if($row['password'] === $password && $row ['role'] == $role)
                    {
                        $_SESSION['id'] = $row['id'];
                        $_SESSION['role'] = $row['role'];
                        $_SESSION['username'] = $row['username'];
                        $_SESSION['name'] = $row['name'];
    
                        header("Location: php/home.php");
                    }
                    else
                    {
                        $showError = "Incorrect Username or Password";
                    }
                }
                else
                {
                    $showError = "Incorrect Username or Password";
                }
                
            }
        }
        else{
            // header('Location: ../login.php');
        }
        
?>        

        <!DOCTYPE html>
        <html lang="en">
            <!-- <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Login</title>
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
            </head> -->
            <!-- For DKTE image -->
            <style>
                body{
                    background-image: url(assets/img/hero-bg.jpg);
                    background-attachment: fixed;
                    background-size: cover;
                    width: 100%;
                    height: 100%;
                    opacity: 1;
                    overflow-y: hidden;
                }
            </style>
            
            <body>
            
                <br><br>
                <?php
                if($showError)
                {
                    echo '  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> ' . $showError . '
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
                }
            ?>
            <br>
                <div class="container d-flex justify-content-center align-items-center" style="min-height: 82vh"> 
                    <form class="border shadow p-5 rounded" action="login.php" method="POST" style="width: 450px;background-color: #e6ebef;">
                        <!-- <div class="alert alert-danger alert-dismissible d-flex align-items-center fade show">
                            <i class="bi-exclamation-octagon-fill"></i>
                            <strong class="mx-2">Error!</strong> A problem has been occurred while submitting your data.
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div> -->
                        
                        <h1 class="text-center p-3">LOGIN</h1>
                       
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" id="username">
                        </div>
                        
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="password">
                        </div>
                    
                        <div class="mb-1">
                            <label class="form-label">Select User Type:</label>                    
                        </div>
                        <select class="form-select mb-3" name="role" aria-label="Default select example">
                            <option selected value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                        <br>
                        <center><button type="submit" class="btn btn-primary">Submit</button></center>
                    </form>
                </div>
                
            </body>
        </html>
       
<?php

    require "assets/footer.php";
?>