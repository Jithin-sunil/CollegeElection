<?php
include("../Assets/Connection/Connection.php");
session_start();

$studentId = $_GET['sid'];

$SelQry = "SELECT *
           FROM tbl_student s
           INNER JOIN tbl_class c ON s.class_id = c.class_id
           INNER JOIN tbl_course co ON s.course_id = co.course_id
           INNER JOIN tbl_department d ON co.department_id = d.department_id
           INNER JOIN tbl_academicyear ay ON s.academicyear_id = ay.academicyear_id
           WHERE s.student_id='".$studentId."'";
$result = $Con->query($SelQry);
$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Student Details</title>
</head>
<body>
<h2 align="center">Student Details</h2>
<table border="1" cellpadding="10" align="center">
  <tr>
    <td colspan="2" align="center">
      <img src="../Assets/Files/Student/Photo/<?php echo $row['student_photo'];?>" width="120" height="120"/>
    </td>
  </tr>
  <tr><td>Name</td><td><?php echo $row['student_name']; ?></td></tr>
  <tr><td>Email</td><td><?php echo $row['student_email']; ?></td></tr>
  <tr><td>Contact</td><td><?php echo $row['student_contact']; ?></td></tr>
  <tr><td>Address</td><td><?php echo $row['student_address']; ?></td></tr>
  <tr><td>Department</td><td><?php echo $row['department_name']; ?></td></tr>
  <tr><td>Course</td><td><?php echo $row['course_name']; ?></td></tr>
  <tr><td>Class</td><td><?php echo $row['class_name']; ?></td></tr>
  <tr><td>Academic Year</td><td><?php echo $row['academicyear_name']; ?></td></tr>
</table>
</body>
</html>
