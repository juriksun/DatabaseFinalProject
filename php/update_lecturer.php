<?php
    require_once("mysqli_connect.php");
    $entered = false;
    $sql = 'UPDATE lecturer SET ' ;
         //  l_id:lecturer_id, f_name:first_name, l_name:last_name, phone_num:phone, b_date:birthdate, address: address
    if(empty($_POST['l_id'])){
        // Adds name to array
        $data_missing[] = 'Lecturer id';
    } else {
        // Trim white space from the name and store the name
        $lecturer_id = trim($_POST['l_id']);
    }
    if(!empty($_POST['f_name'])){
        // Adds name to array
        if(!$entered){
            $entered = true;
        }
        $sql .='first_name="'.trim($_POST['f_name']).'"';
    }
    if(!empty($_POST['l_name'])){
        if($entered){
            $sql .=', ';
        }else {
            $entered = true;
        }
        $sql .='last_name="'.trim($_POST['l_name'].'"');
    }

    if(!empty($_POST['b_date'])){
        if($entered){
            $sql .=', ';
        }
        $sql .='birthdate="'.trim($_POST['b_date']).'"';
    }
    if(!empty($_POST['address'])){
        if($entered){
            $sql .=', ';
        }
        $sql .='address="'.trim($_POST['address']).'"';
    }

    $sql .=' WHERE lecturer_id='.$lecturer_id;
    $sqlQ1 = mysqli_query($dbc, $sql);
    
    if (mysqli_query($dbc, $sql)) {
            echo "true";
    } else {
            echo "Error updating record: " . mysqli_error($dbc);
    }

    if (mysqli_query($dbc, $sql)) {
            echo "true";
    } else {
            echo "Error updating record: " . mysqli_error($dbc);
    }

    if(!empty($_POST['phone_num'])){
        $query2 = "INSERT INTO phone (lecturer_id, phone_num) VALUES (?, ?)";
        $sql .='phone='.trim($_POST['phone_num']);
    }



?>