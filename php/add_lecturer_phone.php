<?php
     $data_missing = array();

     if(empty($_POST['l_id'])){
         // Adds name to array
         $data_missing[] = 'Lecturer id';
     } else {
         // Trim white space from the name and store the name
         $l_id = trim($_POST['l_id']);
     }

     if(empty($_POST['phone_num'])){
              // Adds name to array
              $data_missing[] = 'Phone number';
     } else {
              // Trim white space from the name and store the name
              $phone_number = trim($_POST['phone_num']);
     }

     if(empty($data_missing)) {
             require_once('mysqli_connect.php');

             $query = "INSERT INTO phone (lecturer_id, phone_num) VALUES (?, ?)";

             $stmt = mysqli_prepare($dbc, $query) or die('Error: ' .mysqli_error());

             mysqli_stmt_bind_param($stmt, "ss", $l_id, $phone_number);

             mysqli_stmt_execute($stmt);

              if(mysqli_stmt_affected_rows($stmt) == 1){

                 echo 'true';
                 mysqli_stmt_close($stmt);
                 mysqli_close($dbc);
              } else {

                 echo 'Error Occurred<br/>';
                 echo mysqli_error($dbc);
                 mysqli_stmt_close($stmt);
                 mysqli_close($dbc);
              }
          } else {
              echo 'You need to enter the following data<br/>';
              foreach($data_missing as $missing){
                  echo "$missing<br/>";
              }
          }
     ?>