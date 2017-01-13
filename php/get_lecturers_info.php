<?php
    // Get a connection for the database
    require_once('mysqli_connect.php');
    // Create a query for the database
    $query =    "SELECT lecturer_id, first_name, last_name, birthdate,".
                " TIMESTAMPDIFF(YEAR,birthdate,CURDATE()) AS age, address".
                " FROM lecturer";
    // Get a response from the database by sending the connection
    // and the query
    $response = @mysqli_query($dbc, $query);
    // If the query executed properly proceed
    if($response){
        echo '<h3>Lecturers</h3>
            <table cellpadding="8">
            <tr><td><b>Lecturer id</b></td>
            <td><b>First name</b></td>
            <td><b>Last name</b></td>
            <td><b>Birth date</b></td>
            <td><b>Age</b></td>
            <td><b>Address</b></td>
            <td><b>Phone 1</b></td>
            <td><b>Phone 2</b></td>
            <td><b>Phone 3</b></td></tr>';

        // mysqli_fetch_array will return a row of data from the query
        // until no further data is available
        while($row = mysqli_fetch_array($response)){
            echo '<tr><td>' .
                $row['lecturer_id'] . '</td><td>' .
                $row['first_name'] . '</td><td>' .
                $row['last_name'] . '</td><td>' .
                $row['birthdate'] . '</td><td>'.
                $row['age'] . '</td><td>'.
                $row['address'] . '</td>';

                $query2 = "SELECT phone.phone_num".
                          " FROM".
                          " lecturer INNER JOIN phone".
                          " ON lecturer.lecturer_id = phone.lecturer_id".
                          " WHERE lecturer.lecturer_id = ".$row['lecturer_id'];
                    // Get a response from the database by sending the connection
                    // and the query
                    $response2 = @mysqli_query($dbc, $query2);
                    // If the query executed properly proceed
                    if($response2){

                        // mysqli_fetch_array will return a row of data from the query
                            // until no further data is available
                        for($i=0;$i<3;$i++){
                            if($row2 = mysqli_fetch_array($response2)){
                                echo '<td><b>'. $row2['phone_num'].'</b></td>';
                            } else {
                                 echo '<td><b></b></td>';
                            }
                        }
                    } else {
                        echo "Couldn't issue database query<br>";
                        echo mysqli_error($dbc);
                    }
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo "Couldn't issue database query<br>";
        echo mysqli_error($dbc);
    }
    mysqli_close($dbc);
?>