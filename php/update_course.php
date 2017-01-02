<?php
    require_once("mysqli_connect.php");
    $entered = false;
    $sql = 'UPDATE course SET ' ;

    if(empty($_POST['c_num'])){
        // Adds name to array
        $data_missing[] = 'Course number';
    } else {
        // Trim white space from the name and store the name
        $c_num = trim($_POST['c_num']);
    }
    if(!empty($_POST['c_name'])){
        // Adds name to array
        if(!$entered){
            $entered = true;
        }
        $sql .='course_name="'.trim($_POST['c_name']).'"';
    }
    if(!empty($_POST['c_semester'])){
        if($entered){
            $sql .=', ';
        }else {
            $entered = true;
        }
        $sql .='semester="'.trim($_POST['c_semester'].'"');
    }
    if(!empty($_POST['c_year'])){
         if($entered){
            $sql .=', ';
         }else {
            $entered = true;
         }
         $sql .='year="'.trim($_POST['c_year']).'"';
    }
    if(!empty($_POST['c_hours'])){
        if($entered){
            $sql .=', ';
        }
        $sql .='num_of_hours='.trim($_POST['c_hours']);
    }

    $sql .=' WHERE course_num='.$c_num;

    if (mysqli_query($dbc, $sql)) {
        echo "true";
    } else {
        echo "Error updating record: " . mysqli_error($dbc);
    }
?>