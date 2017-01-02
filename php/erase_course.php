<?php
    $data_missing = array();
    require_once("mysqli_connect.php");
    $sql = 'DELETE FROM course WHERE course_num=';
    if(empty($_POST['c_num'])){
        // Adds name to array
        $data_missing[] = 'Course number';
    } else {
        // Trim white space from the name and store the name
       $sql .= trim($_POST['c_num']);
    }

    if(empty($data_missing)) {
        if (mysqli_query($dbc, $sql)) {
            echo "true";
        } else {
            echo 'Error Occurred<br/>';
            echo mysqli_error($dbc);
        }
    } else {
        echo 'You need to enter the following data<br/>';
        foreach($data_missing as $missing){
            echo "$missing<br/>";
        }
    }
?>