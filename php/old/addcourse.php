<form action="http://localhost/course_added.php" method="post">
    <b>Add a New Course</b>
    <p>Course Number:
        <input type="text" required name="course_num" size="6" value="" />
        </p>
    <p>Course Name:
        <input type="text" required name="course_name" size="30" value="" />
    </p>

    <p>Semester:
        <input pattern="[A-C]" required name="semester" value="" />
    </p>
    <p>Year:
        <input type="number" min="1" max="4" required name="year" value="" />
    </p>
    <p>Number of Hours:
        <input type="number" min="1" max="6" required name="num_of_hours" value="" />
    </p>
    <p>
        <input type="submit" name="submit" value="Send" />
    </p>
</form>
<!--/**
 * Created by PhpStorm.
 * User: Shamir
 * Date: 17-Dec-16
 * Time: 21:26
 */-->