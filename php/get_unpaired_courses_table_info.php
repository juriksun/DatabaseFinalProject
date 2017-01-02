<?php
    // Get a connection for the database
    require_once('mysqli_connect.php');
    // Create a query for the database
    $query =    "SELECT course.course_name, course.course_num, teaches.lecturer_id, takes_place.class_num
                FROM course
                LEFT OUTER JOIN takes_place
                ON takes_place.course_num=course.course_num
                LEFT JOIN teaches
                ON course.course_num=teaches.course_num
                WHERE (teaches.course_num IS NULL) OR (takes_place.class_num IS NULL)
                ORDER BY course.course_num";

    // Get a response from the database by sending the connection
    // and the query
    $response = @mysqli_query($dbc, $query);
    // If the query executed properly proceed
    if($response){
        echo '<h3>Schedule</h3>
                    <table cellpadding="8">
                    <tr><td><b>Course Name</b></td>
                    <td><b>Course Number</b></td>
                    <td><b>Lecturer ID</b></td>
                    <td><b>Class Number</b></td></tr>';

        // mysqli_fetch_array will return a row of data from the query
        // until no further data is available
        while($row = mysqli_fetch_array($response)){
            echo '<tr><td>' .
                $row['course_name'] . '</td><td>' .
                $row['course_num'] . '</td><td>' .
                $row['lecturer_id'] . '</td><td>' .
                $row['class_num'] .'</td>';
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
 * Time: 18:28
 */
?>