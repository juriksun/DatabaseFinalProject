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
    $query =    'SELECT lecturer.last_name, lecturer.first_name, lecturer.lecturer_id,
                course.course_name, takes_place_plus.class_num, takes_place_plus.day, takes_place_plus.hour,
                DATE_ADD(takes_place_plus.hour, INTERVAL course.num_of_hours HOUR) as end_hour
                FROM lecturer INNER JOIN course ON lecturer.lecturer_id = course.lecturer_id
                INNER JOIN
                (
                  SELECT takes_place.class_num AS class_num, takes_place.day AS day,
					takes_place.hour AS hour, takes_place.course_num AS course_num,
                   (takes_place.day*100 + (TIME_TO_SEC(takes_place.hour)/3600)) as s_dayhour,
                   (takes_place.day*100 + (TIME_TO_SEC(DATE_ADD(takes_place.hour, INTERVAL course.num_of_hours HOUR))/3600)) as e_dayhour
                   FROM
                  takes_place INNER JOIN course ON course.course_num=takes_place.course_num
                ) AS takes_place_plus
                ON takes_place_plus.course_num = course.course_num
                WHERE (takes_place_plus.s_dayhour<=("'.($s_day*100).'"+ (TIME_TO_SEC("'.$s_hour.'")/3600))
				  AND takes_place_plus.e_dayhour>("'.($s_day*100).'"+ (TIME_TO_SEC("'.$s_hour.'")/3600)))
				OR (takes_place_plus.s_dayhour<("'.($e_day*100).'"+ (TIME_TO_SEC("'.$e_hour.'")/3600))
				  AND takes_place_plus.e_dayhour>=("'.($e_day*100).'"+ (TIME_TO_SEC("'.$e_hour.'")/3600)))
				OR (takes_place_plus.s_dayhour>=("'.($s_day*100).'"+ (TIME_TO_SEC("'.$s_hour.'")/3600))
				  AND (takes_place_plus.e_dayhour<=("'.($e_day*100).'"+ (TIME_TO_SEC("'.$e_hour.'")/3600))))
 				ORDER BY (takes_place_plus.s_dayhour)';


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
