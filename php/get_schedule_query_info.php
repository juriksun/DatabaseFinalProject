<?php
    if(empty($_POST['s_day'])){
        // Adds name to array
        echo 'Start day';
    } else {
        // Trim white space from the name and store the name
        $s_day = trim($_POST['s_day']);
    }
    if(empty($_POST['e_day'])){
        // Adds name to array
        echo 'End day';
    } else {
        // Trim white space from the name and store the name
        $e_day = trim($_POST['e_day']);
    }
    if(empty($_POST['s_hour'])){
        // Adds name to array
        echo 'Start hour';
    } else {
        // Trim white space from the name and store the name
        $s_hour = trim($_POST['s_hour']);
    }
    if(empty($_POST['e_hour'])){
        // Adds name to array
        echo 'End hour';
    } else {
        // Trim white space from the name and store the name
        $e_hour = trim($_POST['e_hour']);
    }
// Get a connection for the database
    require_once('mysqli_connect.php');
    // Create a query for the database
    $query =    "SELECT lecturer.last_name, lecturer.first_name, lecturer.lecturer_id,
                course.course_name, takes_place.class_num, takes_place.day, takes_place.hour,
                DATE_ADD(takes_place.hour, INTERVAL course.num_of_hours HOUR) as end_hour
                FROM lecturer INNER JOIN course ON lecturer.lecturer_id = course.lecturer_id
                INNER JOIN takes_place ON takes_place.course_num = course.course_num
                WHERE (day between ".$s_day." and ".$e_day.") and (hour between '".$s_hour."' and '".$e_hour."')";

    // Get a response from the database by sending the connection
    // and the query
    //AND ('$s_hour' >= takes_place.hour AND takes_place.hour <= '$e_hour')";
    $response = @mysqli_query($dbc, $query);
    // If the query executed properly proceed
    if($response){
        echo '<h3>Lecturer</h3>
                    <table cellpadding="8">
                    <tr><td><b>Last Name</b></td>
                    <td><b>First Name</b></td>
                    <td><b>ID</b></td>
                    <td><b>Course Name</b></td>
                    <td><b>Class Number</b></td>
                    <td><b>Day</b></td>
                    <td><b>From</b></td>
                    <td><b>To</b></td></tr>';

        // mysqli_fetch_array will return a row of data from the query
        // until no further data is available
        while($row = mysqli_fetch_array($response)){
            echo '<tr><td>' .
                $row['last_name'] . '</td><td>' .
                $row['first_name'] . '</td><td>' .
                $row['lecturer_id'] . '</td><td>' .
                $row['course_name'] . '</td><td>' .
                $row['class_num'] . '</td><td>' .
                $row['day'] . '</td><td>' .
                $row['hour'] . '</td><td>' .
                $row['end_hour'] .'</td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo "Couldn't issue database query<br>";
        echo mysqli_error($dbc);
    }
/**
 * Created by PhpStorm.
 * User: Shamir
 * Date: 27-Dec-16
 * Time: 17:27
 */
?>
