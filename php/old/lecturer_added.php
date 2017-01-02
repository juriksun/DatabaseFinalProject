<html>
    <head>
        <title>Shamir&Alex project</title>
        <link rel="stylesheet" ref="includes/style.css">
    </head>
    <body>
        <div id="wrapper>
            <section id = "course">
                <?php
                require_once('addcourse.php');
                ?>
            </section>
            <section id = "class">
                <?php
                require_once('addclassrom.php');
                ?>
            </section>
            <section id = "lecturer">
                <?php
                    if(isset($_POST['submit']))
                    {
                        $data_missing = array();

                        if(empty($_POST['lecturer_id'])){
                            // Adds id to array
                            $data_missing[] = 'ID';
                        }
                        else {
                            // Trim white space from the name and store the name
                             $id = trim($_POST['lecturer_id']);
                         }

                        if(empty($_POST['first_name'])){
                             // Adds name to array
                            $data_missing[] = 'First Name';
                        }
                        else {
                            // Trim white space from the name and store the name
                            $f_name = trim($_POST['first_name']);
                        }

                        if(empty($_POST['last_name'])){
                            // Adds name to array
                            $data_missing[] = 'Last Name';
                        }
                        else{
                            // Trim white space from the name and store the name
                            $l_name = trim($_POST['last_name']);
                        }

                        if(empty($_POST['phone'])){
                            // Adds name to array
                            $data_missing[] = 'Phone Number';
                        }
                        else {
                            // Trim white space from the name and store the name
                            $phone = trim($_POST['phone']);
                        }

                        if(empty($_POST['birthdate'])){
                            // Adds name to array
                            $data_missing[] = 'Birth Date';
                        }
                        else {
                            // Trim white space from the name and store the name
                            $b_date = trim($_POST['birthdate']);
                        }

                        if(empty($_POST['address'])){
                            // Adds name to array
                            $data_missing[] = 'Address';
                        }
                        else {
                            // Trim white space from the name and store the name
                            $address = trim($_POST['address']);
                        }

                        if(empty($data_missing)) {
                            require_once('mysqli_connect.php');

                            $query = "INSERT INTO lecturer (lecturer_id, first_name, last_name, phone, birthdate, address) VALUES (?, ?, ?, ?, ?, ?)";

                            $stmt = mysqli_prepare($dbc, $query);

                /*i Integers
                d Doubles
                b Blobs
                s Everything Else*/

                            mysqli_stmt_bind_param($stmt, "isssss", $id, $f_name, $l_name, $phone, $b_date, $address);

                            mysqli_stmt_execute($stmt);
                            $affected_rows = mysqli_stmt_affected_rows($stmt);

                            if ($affected_rows == 1) {
                                echo 'Lecturer Added';
                                mysqli_stmt_close($stmt);
                            }
                            else {
                                echo 'Error Occurred<br />';
                                echo mysqli_error();
                                mysqli_stmt_close($stmt);
                            }
                         }
                        else {
                            echo 'You need to enter the following data<br />';
                            foreach ($data_missing as $missing) {
                                echo "$missing<br />";
                            }
                        }
                    }
                require_once('addlecturer.php');
                ?>
            </section>
            <section id = "byDate">
            </section>
            <section id = tables>
                <?php
                require_once('get_tables.php');
                ?>
            </section>
        </div>
    </body>
</html>