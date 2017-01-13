<?php
    $data_missing = array();

    if(empty($_POST['c_num'])){
        // Adds name to array
        $data_missing[] = 'Class number';
    } else {
        // Trim white space from the name and store the name
        $class_num = trim($_POST['c_num']);
    }

    if(empty($_POST['b_name'])){
        // Adds name to array
        $data_missing[] = 'Building name';
    } else {
        // Trim white space from the name and store the name
        $building_name = trim($_POST['b_name']);
    }

    if(empty($_POST['f_num'])){
        // Adds name to array
        $data_missing[] = 'Floor number';
    } else{
        // Trim white space from the name and store the name
        $floor_num = trim($_POST['f_num']);
    }

    if(empty($data_missing)) {
        require_once('mysqli_connect.php');
        $query = "INSERT INTO class (floor_num, class_num, building_name) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($dbc, $query);

        mysqli_stmt_bind_param($stmt, "sss", $floor_num, $class_num, $building_name);
        mysqli_stmt_execute($stmt);
        $affected_rows = mysqli_stmt_affected_rows($stmt);
        if($affected_rows == 1){
            echo 'true';
            mysqli_stmt_close($stmt);
            mysqli_close($dbc);
        } else {
            echo 'Error Occurred<br/>';
            echo mysqli_error();
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