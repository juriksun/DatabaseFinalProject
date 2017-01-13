<?php
    $data_missing = array();

    if(empty($_POST['l_id'])){
    // Adds name to array
    $data_missing[] = 'Lecturer ID';
    } else {
        // Trim white space from the name and store the name
        $l_id= trim($_POST['l_id']);
    }

    if(empty($data_missing)) {
        require_once("mysqli_connect.php");
        if(empty($_POST['phone_num'])){
            $sql = 'DELETE FROM lecturer WHERE lecturer_id="'.$l_id.'"';
            if (mysqli_query($dbc, $sql)) {
                echo "true1";
            } else {
                echo 'Error Occurred<br/>';
                echo mysqli_error($dbc);
            }
        } else {
            // Trim white space from the name and store the name
            $phone_num= trim($_POST['phone_num']);
            $sql = 'DELETE FROM phone WHERE phone_num="'.$phone_num.'" AND lecturer_id = "'.$l_id.'"';
            mysqli_query($dbc, $sql);
            if (mysqli_affected_rows($dbc)>0) {
                echo "true2";
            } else {
                echo 'Error Occurred<br/>';
                echo mysqli_error($dbc);
            }
        }
        mysqli_close($dbc);
    } else {
        echo 'You need to enter the following data<br/>';
        foreach($data_missing as $missing){
            echo "$missing<br/>";
        }
    }
?>
