<?php
include("../Assets/Connection/Connection.php");

session_start();

$SelQry="select * from tbl_teacher where teacher_id='".$_SESSION['tid']."'";
$row=$Con->query($SelQry);
$data=$row->fetch_assoc();

if(isset($_POST['btn_submit']))
{ 
   $name   = $_POST["txt_name"];
   $email  = $_POST["txt_email"];
   $contact= $_POST["txt_contact"];
   $UpQry="Update tbl_teacher set teacher_name='".$name."',teacher_email='".$email."',teacher_contact='".$contact."' where teacher_id='".$_SESSION['tid']."'";
   if($Con->query($UpQry))
   {
	 ?>
     <script>
        alert("Profile Updated.");
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
<title>Edit Teacher Profile</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="200" border="1">
    <tr>
      <td>Name</td>
      <td>
        <input type="text" name="txt_name" id="txt_name" value="<?php echo $data['teacher_name']?>" />
      </td>
    </tr>
    <tr>
      <td>Email</td>
      <td>
        <input type="text" name="txt_email" id="txt_email" value="<?php echo $data['teacher_email']?>" />
      </td>
    </tr>
    <tr>
      <td>Contact</td>
      <td>
        <input type="text" name="txt_contact" id="txt_contact" value="<?php echo $data['teacher_contact']?>" />
      </td>
    </tr>
    <tr>
      <td colspan="2" align="center" valign="middle">
        <input type="submit" name="btn_submit" id="btn_submit" value="Update" />
      </td>
    </tr>
  </table>
</form>
</body>
</html>
