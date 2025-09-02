<?php
include("../Assets/Connection/Connection.php");
session_start();

$SelQry="select * from tbl_student where student_id='".$_SESSION['sid']."'";
$result=$Con->query($SelQry);
$data=$result->fetch_assoc();

if(isset($_POST['btn_submit']))
{ 
   $name=$_POST["txt_name"];
   $email=$_POST["txt_email"];
   $contact=$_POST["txt_contact"];
   $address=$_POST["txt_address"];

   $UpQry="Update tbl_student set student_name='".$name."',student_email='".$email."',student_contact='".$contact."',student_address='".$address."' where student_id='".$_SESSION['sid']."'";
   
   if($Con->query($UpQry))
   {
	 ?>
     <script>
    alert("Profile Updated Successfully.");
     window.location="MyProfile.php";
     </script>
     <?php
   }
}
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
      <td>Name</td>
      <td><input type="text" name="txt_name" id="txt_name" value="<?php echo $data['student_name']?>" required /></td>
    </tr>
    <tr>
      <td>Email</td>
      <td><input type="email" name="txt_email" id="txt_email" value="<?php echo $data['student_email']?>" required /></td>
    </tr>
    <tr>
      <td>Contact</td>
      <td><input type="text" name="txt_contact" id="txt_contact" value="<?php echo $data['student_contact']?>" required /></td>
    </tr>
    <tr>
      <td>Address</td>
      <td><textarea name="txt_address" id="txt_address" cols="40" rows="5" required><?php echo $data['student_address']?></textarea></td>
    </tr>
    <tr>
      <td colspan="2" align="center" valign="middle">
        <input type="submit" name="btn_submit" id="btn_submit" value="Update Profile" />
      </td>
    </tr>
  </table>
</form>
</body>
</html>
