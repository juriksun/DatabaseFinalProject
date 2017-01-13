<?php
    // Get a connection for the database
    require_once('mysqli_connect.php');
    // Create a query for the database
    $query = "SELECT course_num, course_name, semester, year, num_of_hours, lecturer_id FROM course";
    // Get a response from the database by sending the connection
    // and the query
    $response = @mysqli_query($dbc, $query);
    // If the query executed properly proceed
    if($response){
        echo '<h3>Courses</h3>
            <table cellpadding="8">
            <tr><td><b>Course number</b></td>
            <td><b>Course name</b></td>
            <td><b>Semester</b></td>
            <td><b>Year</b></td>
            <td><b>Number of_hours</b></td>
             <td><b>Lecturer id</b></td></tr>';

        // mysqli_fetch_array will return a row of data from the query
        // until no further data is available
        while($row = mysqli_fetch_array($response)){
            echo '<tr><td>' .
                $row['course_num'] . '</td><td>' .
                $row['course_name'] . '</td><td>' .
                $row['semester'] . '</td><td>' .
                $row['year'] . '</td><td style="text-align:center;">' .
                $row['num_of_hours'] . '</td><td>'.
                 $row['lecturer_id'] . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo "Couldn't issue database query<br>";
        echo mysqli_error($dbc);
    }
    mysqli_close($dbc);
?>

