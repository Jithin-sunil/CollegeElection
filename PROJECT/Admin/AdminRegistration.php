<?php
include("../Assets/Connection/Connection.php");
$eid="";
if (isset($_POST['btn_submit']))
{
	$name = $_POST['txt_name'];
	$email = $_POST['txt_email'];
	$password = $_POST['txt_pswd'];
	$eid=$_POST['txt_hidden'];
	if($eid=="")
	{
	$insQry = "insert into tbl_admin(admin_name,admin_email,admin_password)value('".$name."','".$email."','".$password."')";
	if($Con->query($insQry))
	{
		?>
        <script>
		alert("Data Inserted");
		window.location = "AdminRegistration.php";
		</script>
        <?php
	}
}
else 
{
$upQry="update tbl_admin set admin_name='".$name."'where admin_id ='".$eid."' ";
 if($Con->query($upQry))
 {
	 ?>
     <script>
     alert("Data Updated.");
     window.location="AdminRegistration.php";
     </script>
    
     <?php
 }
}
}

if (isset($_GET['did']))
{
	$delQry="delete from tbl_admin where admin_id='".$_GET['did']."' ";
	if($Con->query($delQry))
	{
		?>
        <script>
		alert("value deleted");
		window.location = "AdminRegistration.php";
		</script>
        <?php
	}
}
if (isset($_GET['eid']))
{
$editSel="select * from tbl_admin where admin_id='".$_GET['eid']."' ";
$editResult=$Con->query($editSel);
$editRow = $editResult->fetch_assoc();
$adminname = $editRow['admin_name'];
$eid = $editRow['admin_id'];
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>AdminRegistration</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="200" border="1">
    <tr>
      <td>Name</td>
      <td><label for="txt_name"></label>
      <input name="txt_hidden" type="hidden" value="<?php echo $eid ?>" />
      <input type="text" name="txt_name" id="txt_name" />
      </td>
    </tr>
    <tr>
      <td>Email</td>
      <td><label for="txt_email"></label>
      <input type="text" name="txt_email" id="txt_email" /></td>
    </tr>
    <tr>
      <td>Password</td>
      <td><label for="txt_pswd"></label>
      <input type="text" name="txt_pswd" id="txt_pswd" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="btn_submit" id="btn_submit" value="Submit" /></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <table width="200" border="1">
    <tr>
      <td>Slno</td>
      <td>Name</td>
      <td>Email</td>
      <td>Action</td>
    </tr>
     <?php
	$i=0;
	$SelQry="select * from tbl_admin";
	$result = $Con->query($SelQry);
	while($row=$result->fetch_assoc())
	{
		$i++;
		?>
    <tr>
      <td height="75"><?php echo $i?></td>
      <td><?php echo $row['admin_name'];?></td>
      <td><?php echo $row['admin_email'];?></td>
      <td><a href="Adminregistration.php?did=<?php echo $row['admin_id']?>">Delete</a>
      <a href="Adminregistration.php?eid=<?php echo $row['admin_id']?>">Edit</a></td>
    </tr>
    <?php
	}
	?>
  </table>
</form>
</body>
</html>