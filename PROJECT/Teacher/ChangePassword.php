<?php
include("../Assets/Connection/Connection.php");
session_start();

$SelQry="select * from tbl_user where user_id='".$_SESSION['uid']."'";
$result=$Con->query($SelQry);
$row=$result->fetch_assoc();
$UserPassword=$row['user_password'];

if(isset($_POST['btn_submit']))
{ 
   $OldPass=$_POST["txt_opwd"];
   $NewPass=$_POST["txt_npwd"];
   $Retype=$_POST["txt_rpwd"];

   if($OldPass==$UserPassword)
   {
	   if($NewPass==$Retype)
	   {
		  $UpQry="update tbl_user set user_password = '".$NewPass."' where user_id='".$_SESSION['uid']."'";
		  if($Con->query($UpQry))
		  {
			 ?>
			 <script>
				alert("Password Updated Successfully");
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
	   alert("Old Password is Incorrect!");
	   </script>
	   <?php
   }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Change Password</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="300" border="1" cellpadding="5">
    <tr>
      <td>Old Password</td>
      <td><input type="password" name="txt_opwd" id="txt_opwd" /></td>
    </tr>
    <tr>
      <td>New Password</td>
      <td><input type="password" name="txt_npwd" id="txt_npwd" /></td>
    </tr>
    <tr>
      <td>Retype Password</td>
      <td><input type="password" name="txt_rpwd" id="txt_rpwd" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center">
        <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
      </td>
    </tr>
  </table>
</form>
</body>
</html>
