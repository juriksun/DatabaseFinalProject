<?php
    if(empty($_POST['c_num'])){
        // Adds name to array
        echo 'Missing Class Number';
    } else {
        // Trim white space from the name and store the name
        $xxx = trim($_POST['c_num']);
    }

    require_once('mysqli_connect.php');
    // Create a query for the database
    $query = "SELECT lecturer.last_name, lecturer.first_name, course.course_name, takes_place.class_num
              FROM class
              INNER JOIN takes_place ON class.class_num = takes_place.class_num
              INNER JOIN course ON takes_place.course_num = course.course_num
              INNER JOIN lecturer ON course.lecturer_id = lecturer.lecturer_id
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
    mysqli_close($dbc);
?>