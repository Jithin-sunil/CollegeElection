<?php
include("../Assets/Connection/Connection.php");
session_start();

if (isset($_POST['btn_submit'])) {
    $email = $_POST['txt_email'];
    $password = $_POST['txt_password'];

    $SelStudent = "select * from tbl_student where student_email='" . $email . "' and student_password='" . $password . "'";
    $resultStudent = $Con->query($SelStudent);

    $SelAdmin = "select * from tbl_admin where admin_email='" . $email . "' and admin_password='" . $password . "'";
    $resultAdmin = $Con->query($SelAdmin);

    $SelTeacher = "select * from tbl_teacher where teacher_email='" . $email . "' and teacher_password='" . $password . "'";
    $resultTeacher = $Con->query($SelTeacher);

    if ($rowStudent = $resultStudent->fetch_assoc()) {
        $_SESSION['sid'] = $rowStudent['student_id'];
        header("location:../Student/HomePage.php");
    } elseif ($rowAdmin = $resultAdmin->fetch_assoc()) {
        $_SESSION['aid'] = $rowAdmin['admin_id'];
        header("location:../Admin/HomePage.php");
    } elseif ($rowTeacher = $resultTeacher->fetch_assoc()) {
        $_SESSION['tid'] = $rowTeacher['teacher_id'];
        header("location:../Teacher/HomePage.php");
    } else {
        ?>
        <script>
        alert("Invalid email or password");
        window.location="Login.php";
        </script>
        <?php
    }
}
?> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="300" border="1" align="center" cellpadding="10">
    <tr>
      <td>Email</td>
      <td><input type="text" name="txt_email" id="txt_email" required /></td>
    </tr>
    <tr>
      <td>Password</td>
      <td><input type="password" name="txt_password" id="txt_password" required /></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input name="btn_submit" type="submit" value="Login" /></td>
    </tr>
  </table>
</form>
</body>
</html>
