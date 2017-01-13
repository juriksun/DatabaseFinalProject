<?php
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
    if(!empty($_POST['l_id'])){
        if($entered){
            $sql .=', ';
        }
        $sql .='lecturer_id="'.trim($_POST['l_id']).'"';
    }

    $sql .=' WHERE course_num='.$c_num;

    require_once("mysqli_connect.php");
    if (mysqli_query($dbc, $sql)) {
        echo "true";

    } else {
        echo "Error updating record: " . mysqli_error($dbc);
    }
    mysqli_close($dbc);
?>