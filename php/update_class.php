<?php
    require_once("mysqli_connect.php");
    $entered = false;
    $sql = 'UPDATE class SET ';

    if(empty($_POST['c_num'])){
        // Adds name to array
        $data_missing[] = 'Class number';
    } else {
        // Trim white space from the name and store the name
        $c_num = trim($_POST['c_num']);
    }
    if(!empty($_POST['b_name'])){
        // Adds name to array
        if(!$entered){
            $entered = true;
        }
        $sql .='building_name="'.trim($_POST['b_name']).'"';
    }
    if(!empty($_POST['f_num'])){
        if($entered){
            $sql .=', ';
        }else {
            $entered = true;
        }
        $sql .='floor_num="'.trim($_POST['f_num'].'"');
    }

    $sql .=' WHERE class_num='.$c_num;

    if (mysqli_query($dbc, $sql)) {
        echo "true";
    } else {
        echo "Error updating record: " . mysqli_error($dbc);
    }
?>