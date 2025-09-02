<?php
include("../Assets/Connection/Connection.php");
session_start();

$studentId = $_GET['sid'];

$SelQry = "SELECT s.*, c.class_name, d.department_name
           FROM tbl_student s
           INNER JOIN tbl_class c ON s.class_id = c.class_id
           INNER JOIN tbl_department d ON c.department_id = d.department_id
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
  <tr><td>Class</td><td><?php echo $row['class_name']; ?></td></tr>
</table>
</body>
</html>
