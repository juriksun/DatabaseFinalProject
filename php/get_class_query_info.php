<?php
    if(empty($_POST['c_num'])){
        // Adds name to array
        echo 'Missing Class Number';
    } else {
        // Trim white space from the name and store the name
        $xxx = trim($_POST['c_num']);
    }
// Get a connection for the database
    require_once('mysqli_connect.php');
    // Create a query for the database
    $query = "SELECT lecturer.last_name, lecturer.first_name, course.course_name, class.class_num
              FROM lecturer
              INNER JOIN teaches
              ON lecturer.lecturer_id=teaches.lecturer_id
              INNER JOIN takes_place
              ON teaches.course_num=takes_place.course_num 
              INNER JOIN course
              ON course.course_num=takes_place.course_num
              INNER JOIN class
              ON class.class_num=takes_place.class_num
              WHERE class.class_num=".$xxx."
              ORDER BY class.class_num";

    // Get a response from the database by sending the connection
    // and the query
    $response = @mysqli_query($dbc, $query);
    // If the query executed properly proceed
    if($response){
        echo '<h3>Schedule</h3>
                    <table cellpadding="8">
                    <tr><td><b>Last Name</b></td>
                    <td><b>First Name</b></td>
                    <td><b>Course Name</b></td>
                    <td><b>Class Number</b></td></tr>';

        // mysqli_fetch_array will return a row of data from the query
        // until no further data is available
        while($row = mysqli_fetch_array($response)){
            echo '<tr><td>' .
                $row['last_name'] . '</td><td>' .
                $row['first_name'] . '</td><td>' .
                $row['course_name'] . '</td><td>' .
                $row['class_num'] . '</td>';
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
 * Date: 25-Dec-16
 * Time: 17:11
 */
?>