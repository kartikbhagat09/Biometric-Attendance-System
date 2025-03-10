<?php
                
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {

    
        if(isset($_POST['export_data']))
        {

            if(empty($_post['fromDate']) && empty($_POST['toDate']))
            {
                echo "Something wrong";
            }
            else
            {

                
                $fromDate = $_POST['fromDate'];
                $toDate = $_POST['toDate'];

        
                require('../fpdf/fpdf.php');
                $pdf=new FPDF();
                $pdf->AddPage();
                $pdf->SetFont('arial','B',20);
                $pdf->Cell(62,7,"");
                $pdf->Cell(30,7,"Attendance Details");
                $pdf->Ln();
                $pdf->Ln();
                $pdf->SetFont('times','B',10);
                $pdf->Cell(22,7,"Roll No");
                $pdf->Cell(30,7,"Enrollment No");
                $pdf->Cell(30,7,"Name");
                $pdf->Cell(20,7,"Class");
                $pdf->Cell(30,7,"Batch");
                $pdf->Cell(30,7,"Date");
                $pdf->Cell(30,7,"Status");
                $pdf->Ln();
                $pdf->Cell(450,7,"----------------------------------------------------------------------------------------------------------------------------------------------------------------------");
                $pdf->Ln();
                        
                        require('../Mega_project/db_conn.php'); 
                        $sql = "SELECT `roll_number`,`enrollment_number`,`name`,`class`,`batch`,`date`,`status` from `attendance_details` WHERE cast(date as date) BETWEEN '$fromDate' AND '$toDate' ";
                        // WHERE cast(date as date) BETWEEN $fromDate AND $toDate

                        $result = mysqli_query($conn,$sql);
                        if($result) {
                            if(mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_array($result)) 
                                {
                                    // $sql2 = "SELECT  FROM `attendance_details`";
                                    // $result_sql2 = mysqli_query($conn,$sql2);
                                    // $row2 = mysqli_fetch_assoc($result_sql2);
                                    // print_r($row2);

                                    // $name = $row['name'];
                                    // $enroll = $row['enrollment_no'];
                                    // $roll = $row['roll_no']
                                    // $class = $row['class'];
                                    // $batch = $row['batch'];
                                    
                                    // $pdf->Cell(18,7,$row['id']);
                                    $pdf->Cell(20,7,$row['roll_number']);
                                    $pdf->Cell(28,7,$row['enrollment_number']);
                                    $pdf->Cell(33,7,$row['name']);
                                    $pdf->Cell(19,7,$row['class']); 
                                    $pdf->Cell(20,7,$row['batch']); 
                                    $pdf->Cell(40,7,$row['date']); 
                                    $pdf->Cell(30,7,$row['status']); 
                                    $pdf->Ln(); 
                                }
                                // $pdf->Cell(18,7,'Absent Students');
                                    // $sql2 = "SELECT cast(date as date) FROM `attendance_details` ";
                                    // $result2 = mysqli_query($conn,$sql2);
                                    // if($result2)
                                    // {
                                    //     if(mysqli_num_rows($result2) > 0)
                                    //     {
                                    //         while($row2 = mysqli_fetch_assoc($result2))
                                    //         {
                                    //             $cur_date = $row2['date'];
                                    //             $crr_date = substr($cur_date,0,10);
                                    //             // $pdf->Cell(20,7,$cur_date);
                                    //             // $pdf->Ln(); 
                                    //             $sql3 = "SELECT `roll_no`,`enrollment_no`,`name`,`class`,`batch` FROM `register_info` WHERE `id` NOT IN (SELECT `user_id` FROM `attendance_details` WHERE cast(date as date) = '$crr_date' BETWEEN '$fromDate' AND '$toDate')  ";
                                    //             $result3 = mysqli_query($conn,$sql3);
                                    //             if($result3)
                                    //             {
                                    //                 if(mysqli_num_rows($result3)>0)
                                    //                 {
                                    //                     while($row3 = mysqli_fetch_assoc($result3))
                                    //                     {
                                    //                         $pdf->Cell(20,7,$row3['roll_no']);
                                    //                         $pdf->Cell(28,7,$row3['enrollment_no']);
                                    //                         $pdf->Cell(33,7,$row3['name']);
                                    //                         $pdf->Cell(19,7,$row3['class']); 
                                    //                         $pdf->Cell(20,7,$row3['batch']); 
                                    //                         $pdf->Cell(40,7,$cur_date);
                                    //                         $pdf->Cell(30,7,'Absent'); 
                                    //                         $pdf->Ln(); 
                                    //                     }
                                    //                 }
                                    //             }
                                    //         }
                                    //     }
                                    // }
                                    
                            }
                        }
                $pdf->Output();
            }
        }
    }
                
?>