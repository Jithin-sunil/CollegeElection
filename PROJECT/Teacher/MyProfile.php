<?php
include("../Assets/Connection/Connection.php");
session_start();

$SelQry = "select * from tbl_teacher t 
inner join tbl_department d on t.department_id=d.department_id 
where teacher_id=".$_SESSION['tid'];
$result = $Con->query($SelQry);
$row = $result->fetch_assoc();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Teacher Profile</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="204" border="1">
    <tr>
      <td colspan="2"><img src="../Assets/Files/Teacher/Photo/<?php echo $row['teacher_photo'];?>" width="100" height="100"/></td>
    </tr>
    <tr>
      <td width="75" height="27">Name</td>
      <td width="113"><?php echo $row['teacher_name']?></td>
    </tr>
    <tr>
      <td>Email</td>
      <td><?php echo $row['teacher_email']?></td>
    </tr>
    <tr>
      <td>Contact</td>
      <td><?php echo $row['teacher_contact']?></td>
    </tr>
    <tr>
      <td>Department</td>
      <td><?php echo $row['department_name']?></td>
    </tr>
    <tr>
        <td colspan="2" align="center">
            <a href="EditProfile.php">Edit Profile</a>|
            <a href="ChangePassword.php">Change Password</a>
        </td>
    </tr>
  </table>
</form>
</body>
</html>
