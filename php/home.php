<?php

        session_start();
        require "../db_conn.php";
    
        // For admin
        $_SESSION['role'] == 'admin';

        // For user
        $_SESSION['role'] == 'user';

        if($_SESSION['role'] == 'admin')
        {
            header('Location: ../admin_index.php');
        }
        elseif($_SESSION['role'] == 'user'){
            
            header('Location: ../user_index.php');
        }
?>