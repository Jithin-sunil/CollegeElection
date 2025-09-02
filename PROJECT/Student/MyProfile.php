<?php
include("../Assets/Connection/Connection.php");
session_start();

$SelQry = "select * from tbl_student s 
inner join tbl_course c on s.course_id=c.course_id 
inner join tbl_department d on c.department_id=d.department_id 
inner join tbl_class cl on s.class_id=cl.class_id 
inner join tbl_academicyear a on s.academicyear_id=a.academicyear_id 
where student_id=".$_SESSION['sid'];

$result = $Con->query($SelQry);
$row = $result->fetch_assoc();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Student Profile</title>
</head>

<body>
<h2 align="center">My Profile</h2>
<form id="form1" name="form1" method="post" action="">
  <table width="400" border="1" align="center" cellpadding="10">
    <tr>
      <td colspan="2" align="center">
        <img src="../Assets/Files/Student/Photo/<?php echo $row['student_photo'];?>" width="100" height="100"/>
      </td>
    </tr>
    <tr>
      <td>Name</td>
      <td><?php echo $row['student_name']?></td>
    </tr>
    <tr>
      <td>Email</td>
      <td><?php echo $row['student_email']?></td>
    </tr>
    <tr>
      <td>Contact</td>
      <td><?php echo $row['student_contact']?></td>
    </tr>
    <tr>
      <td>Address</td>
      <td><?php echo $row['student_address']?></td>
    </tr>
    <tr>
      <td>Department</td>
      <td><?php echo $row['department_name']?></td>
    </tr>
    <tr>
      <td>Course</td>
      <td><?php echo $row['course_name']?></td>
    </tr>
    <tr>
      <td>Class</td>
      <td><?php echo $row['class_name']?></td>
    </tr>
    <tr>
      <td>Academic Year</td>
      <td><?php echo $row['academicyear_name']?></td>
    </tr>
  </table>
</form>
</body>
</html>
