<?php
    $data_missing = array();

    if(empty($_POST['c_num'])){
        // Adds name to array
        $data_missing[] = 'Course number';
    } else {
        // Trim white space from the name and store the name
        $course_num = trim($_POST['c_num']);
    }

    if(empty($_POST['c_name'])){
        // Adds name to array
        $data_missing[] = 'Course name';

    } else {
        // Trim white space from the name and store the name
        $course_name = trim($_POST['c_name']);
    }

    if(empty($_POST['c_semester'])){
        // Adds name to array
        $data_missing[] = 'Semester';
    } else{
        // Trim white space from the name and store the name
        $semester = trim($_POST['c_semester']);
    }
    if(empty($_POST['c_year'])){
        // Adds name to array
        $data_missing[] = 'Year';
    } else {
        // Trim white space from the name and store the name
        $year = trim($_POST['c_year']);
    }
    if(empty($_POST['c_hours'])){
        // Adds name to array
        $data_missing[] = 'Number of hours';
    } else {
        // Trim white space from the name and store the name
        $num_of_hours = trim($_POST['c_hours']);
    }

    if(empty($data_missing)) {
        require_once('mysqli_connect.php');
        $query = "INSERT INTO course (course_num, course_name, semester, year, num_of_hours) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($dbc, $query);

        mysqli_stmt_bind_param($stmt, "sssss", $course_num, $course_name,
            $semester, $year, $num_of_hours);
        mysqli_stmt_execute($stmt);
        $affected_rows = mysqli_stmt_affected_rows($stmt);
        if($affected_rows == 1){
            echo 'true';
            mysqli_stmt_close($stmt);
            //mysqli_close($dbc);
        } else {
            echo 'Error Occurred<br/>';
            echo mysqli_error();
            mysqli_stmt_close($stmt);
            //mysqli_close($dbc);
        }
    } else {
        echo 'You need to enter the following data<br/>';
        foreach($data_missing as $missing){
            echo "$missing<br/>";
        }
    }
?>