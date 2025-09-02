<?php
include("../Assets/Connection/Connection.php");
session_start();

$teacherId = $_SESSION['tid'];

$assignQry = "SELECT * FROM tbl_assignteacher a 
              INNER JOIN tbl_course c ON a.course_id=c.course_id 
              INNER JOIN tbl_class cl ON a.class_id=cl.class_id 
              WHERE a.teacher_id='".$teacherId."'";
$assignResult = $Con->query($assignQry);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>My Students</title>
</head>

<body>
<h3>My Students</h3>

<?php
while($assignRow = $assignResult->fetch_assoc())
{
    $courseId = $assignRow['course_id'];
    $classId  = $assignRow['class_id'];

    echo "<h4>Course: ".$assignRow['course_name']." | Class: ".$assignRow['class_name']."</h4>";

    $studentQry = "SELECT * FROM tbl_student s 
                   INNER JOIN tbl_course c ON s.course_id=c.course_id 
                   INNER JOIN tbl_class cl ON s.class_id=cl.class_id 
                   INNER JOIN tbl_academicyear y ON s.academicyear_id=y.academicyear_id 
                   WHERE s.course_id='".$courseId."' AND s.class_id='".$classId."'";
    $studentResult = $Con->query($studentQry);

    if($studentResult->num_rows>0)
    {
        ?>
        <table border="1" cellpadding="5">
            <tr>
              <th>Sl.No</th>
              <th>Name</th>
              <th>Email</th>
              <th>Contact</th>
              <th>Address</th>
              <th>Course</th>
              <th>Class</th>
              <th>Year</th>
              <th>Photo</th>
            </tr>
        <?php
        $i=0;
        while($studentRow=$studentResult->fetch_assoc())
        {
            $i++;
            ?>
            <tr>
              <td><?php echo $i; ?></td>
              <td><?php echo $studentRow['student_name']; ?></td>
              <td><?php echo $studentRow['student_email']; ?></td>
              <td><?php echo $studentRow['student_contact']; ?></td>
              <td><?php echo $studentRow['student_address']; ?></td>
              <td><?php echo $studentRow['course_name']; ?></td>
              <td><?php echo $studentRow['class_name']; ?></td>
              <td><?php echo $studentRow['academicyear_name']; ?></td>
              <td>
                <img src="../Assets/Files/Student/Photo/<?php echo $studentRow['student_photo']; ?>" 
                     width="80" height="80" />
              </td>
            </tr>
            <?php
        }
        ?>
        </table>
        <br/>
        <?php
    }
    else
    {
        echo "<p>No students found in this class.</p>";
    }
}
?>

</body>
</html>
