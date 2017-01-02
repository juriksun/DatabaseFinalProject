<form action="http://localhost/classroomadded.php" method="post">
    <b>Add a New ClassRoom</b>
    <p>Building Name:
        <input type="text" required name="building_name" size="10" value="" />
    </p>
    <p>Class Number:
        <input type="text" required name="class_num" size="4" value="" />
    </p>
    <p>floor_num:
        <input type="number" min="0" max="7" required name="floor_num" value="" />
    </p>
    <p>
        <input type="submit" name="submit" value="Send" />
    </p>
</form>
