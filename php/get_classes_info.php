<?php
    // Get a connection for the database
    require_once('mysqli_connect.php');
    // Create a query for the database
    $query = "SELECT floor_num, class_num, building_name FROM class";
    // Get a response from the database by sending the connection
    // and the query
    $response = @mysqli_query($dbc, $query);
    // If the query executed properly proceed
    if($response){
        echo '<h3>Classes</h3>
            <table cellpadding="8">
            <tr><td><b>Floor number</b></td>
            <td><b>Class number</b></td>
            <td><b>Building</b></td></tr>';

        // mysqli_fetch_array will return a row of data from the query
        // until no further data is available
        while($row = mysqli_fetch_array($response)){
            echo '<tr><td>' .
                $row['floor_num'] . '</td><td>' .
                $row['class_num'] . '</td><td>' .
                $row['building_name'] .'</td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo "Couldn't issue database query<br>";
        echo mysqli_error($dbc);
    }
    mysqli_close($dbc);
?>