<?php
    // Get a connection for the database
    require_once('mysqli_connect.php');
    // Create a query for the database
    $query = "SELECT lecturer.last_name, lecturer.first_name, course.course_name, class.class_num, takes_place.day, takes_place.hour,
              DATE_ADD(takes_place.hour, INTERVAL course.num_of_hours HOUR) as end_hour
              FROM lecturer
              INNER JOIN course
              ON lecturer.lecturer_id=course.lecturer_id
              INNER JOIN takes_place
              ON course.course_num=takes_place.course_num
              INNER JOIN class
              ON takes_place.class_num = class.class_num
              ORDER BY lecturer.last_name";

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
                $row['course_name'] . '</td><td>' .
                $row['class_num'] . '</td><td>' .
                $row['day'] . '</td><td>' .
                $row['hour'] .'</td><td>'.
                $row['end_hour'] .'</td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo "Couldn't issue database query<br>";
        echo mysqli_error($dbc);
    }
    mysqli_close($dbc);
?>