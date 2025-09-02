<?php
include("../Assets/Connection/Connection.php");
session_start();

$SelQry="select * from tbl_student where student_id='".$_SESSION['sid']."'";
$result=$Con->query($SelQry);
$row=$result->fetch_assoc();
$StudentPassword=$row['student_password'];

if(isset($_POST['btn_submit']))
{ 
   $OldPass=$_POST["txt_opwd"];
   $NewPass=$_POST["txt_npwd"];
   $Retype=$_POST["txt_rpwd"];

   if($OldPass==$StudentPassword)
   {
	   if($NewPass==$Retype)
	   {
		$UpQry="update tbl_student set student_password = '".$NewPass."' where student_id='".$_SESSION['sid']."'";
		if($Con->query($UpQry))
        {
	        ?>
	        <script>
	        alert("Password Updated Successfully.");
	        window.location="MyProfile.php";
	        </script>
	        <?php
        }
	   }
	   else
	   {
		   ?>
           <script>
		   alert("New Password and Retype Password do not match!");
		   </script>
           <?php
	   }
   }
   else
   {
	   ?>
       <script>
	   alert("Old Password is incorrect!");
	   </script>
       <?php
   }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Student Change Password</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="300" border="1" cellpadding="5">
    <tr>
      <td>Old Password</td>
      <td><input type="password" name="txt_opwd" id="txt_opwd" required /></td>
    </tr>
    <tr>
      <td>New Password</td>
      <td><input type="password" name="txt_npwd" id="txt_npwd" required /></td>
    </tr>
    <tr>
      <td>Retype Password</td>
      <td><input type="password" name="txt_rpwd" id="txt_rpwd" required /></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="btn_submit" id="btn_submit" value="Update Password" /></td>
    </tr>
  </table>
</form>
</body>
</html>
