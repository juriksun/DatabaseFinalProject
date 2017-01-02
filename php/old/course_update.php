<html>
    <head>
        <title>Update a Course Record in Database</title>
    </head>
    <body>
    <?php
        if(isset($_POST['update'])) {
        $dbhost = 'localhost:3036';
        $dbuser = 'root';
        $dbpass = '';

        $conn = mysqli_connect($dbhost, $dbuser, $dbpass);

        if(! $conn ) {
            die('Could not connect: ' . mysqli_error());
        }

    $lecturer_id = $_POST['lecturer_id'];
    $emp_salary = $_POST['emp_salary'];

    $sql = "UPDATE employee ".
            "SET emp_salary = $emp_salary ".
            "WHERE emp_id = $emp_id" ;
    mysqli_select_db('class_calendar');
    $retval = mysqli_query( $sql, $conn );

    if(! $retval ) {
        die('Could not update data: ' . mysqli_error());
    }
    echo "Updated data successfully\n";

    mysqli_close($conn);
}else {
    ?>
    <form method = "post" action = "<?php $_PHP_SELF ?>">
        <table width = "400" border =" 0" cellspacing = "1"
               cellpadding = "2">

            <tr>
                <td width = "100">Employee ID</td>
                <td><input name = "emp_id" type = "text"
                           id = "emp_id"></td>
            </tr>

            <tr>
                <td width = "100">Employee Salary</td>
                <td><input name = "emp_salary" type = "text"
                           id = "emp_salary"></td>
            </tr>

            <tr>
                <td width = "100"> </td>
                <td> </td>
            </tr>

            <tr>
                <td width = "100"> </td>
                <td>
                    <input name = "update" type = "submit"
                           id = "update" value = "Update">
                </td>
            </tr>

        </table>
    </form>
    <?php
}
?>

</body>
</html>

/**
 * Created by PhpStorm.
 * User: Shamir
 * Date: 18-Dec-16
 * Time: 17:56
 */