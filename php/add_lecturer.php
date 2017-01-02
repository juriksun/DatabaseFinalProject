<?php
     $data_missing = array();

     if(empty($_POST['l_id'])){
         // Adds name to array
         $data_missing[] = 'Lecturer id';
     } else {
         // Trim white space from the name and store the name
         $l_id = trim($_POST['l_id']);
     }

     if(empty($_POST['f_name'])){
         // Adds name to array
         $data_missing[] = 'First name';

     } else {
         // Trim white space from the name and store the name
         $f_name = trim($_POST['f_name']);
     }

     if(empty($_POST['l_name'])){
         // Adds name to array
         $data_missing[] = 'Last name';
     } else{
         // Trim white space from the name and store the name
         $l_name = trim($_POST['l_name']);
     }

     if(empty($_POST['phone_num'])){
         // Adds name to array
         $data_missing[] = 'Phone number';
     } else {
         // Trim white space from the name and store the name
         $phone_number = trim($_POST['phone_num']);
     }

     if(empty($_POST['b_date'])){
         // Adds name to array
         $data_missing[] = 'Birth date';
     } else {
         // Trim white space from the name and store the name
         $b_date = trim($_POST['b_date']);
     }

     if(empty($_POST['address'])){
              // Adds name to array
              $data_missing[] = 'Address';
     } else {
              // Trim white space from the name and store the name
              $address = trim($_POST['address']);
     }

     if(empty($data_missing)) {
        require_once('mysqli_connect.php');

        mysqli_query($dbc,"START TRANSACTION");


        $query = "INSERT INTO lecturer (lecturer_id, first_name, last_name, birthdate, address) VALUES (?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($dbc, $query) or die('Error: ' .mysqli_error());

        mysqli_stmt_bind_param($stmt, "sssss", $l_id, $f_name, $l_name, $b_date, $address);

        mysqli_stmt_execute($stmt);
        $affected_rows = mysqli_stmt_affected_rows($stmt);

        $query2 = "INSERT INTO phone (lecturer_id, phone_num) VALUES (?, ?)";

        $stmt2 = mysqli_prepare($dbc, $query2) or die('Error: ' .mysqli_error());

        mysqli_stmt_bind_param($stmt2, "ss", $l_id, $phone_number);

        mysqli_stmt_execute($stmt2);

        $affected_rows2 = mysqli_stmt_affected_rows($stmt2);

         if($affected_rows == 1 && $affected_rows2 == 1){
            mysqli_query($dbc,"COMMIT");
            echo 'true';
            mysqli_stmt_close($stmt);
            mysqli_stmt_close($stmt2);
             //mysqli_close($dbc);
         } else {
            mysqli_query($dbc,"ROLLBACK");
            echo 'Error Occurred<br/>';
            echo mysqli_error($dbc);
            mysqli_stmt_close($stmt);
            mysqli_stmt_close($stmt2);
            //mysqli_close($dbc);
         }
     } else {
         echo 'You need to enter the following data<br/>';
         foreach($data_missing as $missing){
             echo "$missing<br/>";
         }
     }
?>