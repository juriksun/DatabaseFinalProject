<?php
    $data_missing = array();
    $status = array();
    if(trim($_POST['do'])=="teaches"){
    //do:"teaches", co_num:course_num, l_id: lecturer_id
        if(empty($_POST['co_num'])){
            // Adds name to array
            $data_missing[] = 'Course number';
        } else {
            $course_num = trim($_POST['co_num']);
        }
        if(empty($_POST['l_id'])){
            // Adds name to array
            $data_missing[] = 'Lecturer ID';
        } else {
            // Trim white space from the name and store the name
            $lecturer_id = trim($_POST['l_id']);
        }
        if(empty($data_missing)) {
            require_once('mysqli_connect.php');
            $query = "INSERT INTO teaches (lecturer_id, course_num) VALUES ('$lecturer_id', '$course_num')";
                if (mysqli_query($dbc, $query)) {
                       echo "true";
                } else {
                       echo "Error updating record: " . mysqli_error($dbc);
                }
        } else {
            echo 'You need to enter the following data<br/>';
            foreach($data_missing as $missing){
                echo "$missing<br/>";
            }
        }
    }
    if(trim($_POST['do'])=="takes_place"){
        if(empty($_POST['co_num'])){
            // Adds name to array
            $data_missing[] = 'Course number';
        } else {
             $course_num = trim($_POST['co_num']);
        }

        if(empty($_POST['cl_num'])){
            // Adds name to array
            $data_missing[] = 'Class number';
        } else {
            // Trim white space from the name and store the name
            $class_num = trim($_POST['cl_num']);
        }

        if(empty($_POST['day'])){
            // Adds name to array
                $data_missing[] = 'Day';
        } else{
            // Trim white space from the name and store the name
            $day = trim($_POST['day']);
        }

        if(empty($_POST['hour'])){
            // Adds name to array
            $data_missing[] = 'Hour';
        } else{
            // Trim white space from the name and store the name
            $hour = trim($_POST['hour']);
        }

        if(empty($data_missing)) {
            require_once('mysqli_connect.php');
            $query = "INSERT INTO takes_place (class_num, course_num, day, hour) VALUES ('$class_num', '$course_num', '$day', '$hour')";
            if (mysqli_query($dbc, $query)) {
                echo "true";
            } else {
                    echo "Error updating record: " . mysqli_error($dbc);
            }
        } else {
            echo 'You need to enter the following data<br/>';
            foreach($data_missing as $missing){
                echo "$missing<br/>";
            }
        }
    }
?>