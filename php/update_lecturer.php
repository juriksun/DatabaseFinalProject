<?php
    require_once("mysqli_connect.php");

    $entered = false;
    $query1 = 'UPDATE lecturer SET ' ;

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
        $query1 .='first_name="'.trim($_POST['f_name']).'"';
    }
    if(!empty($_POST['l_name'])){
        if($entered){
            $query1 .=', ';
        }else {
            $entered = true;
        }
        $query1 .='last_name="'.trim($_POST['l_name'].'"');
    }

    if(!empty($_POST['b_date'])){
        if($entered){
            $query1 .=', ';
        }
        $query1 .='birthdate="'.trim($_POST['b_date']).'"';
    }
    if(!empty($_POST['address'])){
        if($entered){
            $query1 .=', ';
        }
        $query1 .='address="'.trim($_POST['address']).'"';
    }

    $query1 .=' WHERE lecturer_id="'.$lecturer_id.'"';

    if (mysqli_query($dbc, $query1)) {
        echo "true";
    } else {
        echo "Error updating record: " . mysqli_error($dbc);
    }
?>