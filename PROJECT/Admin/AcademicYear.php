<?php
include("../Assets/Connection/Connection.php");

if(isset($_POST['btn_submit']))
{
	$year=$_POST['txt_year'];
	$insQry = "insert into tbl_academicyear (academicyear_name) values ('".$year."')";
	if($Con->query($insQry))
	{
		?>
		<script>
		alert("Academic Year Inserted");
		window.location="AcademicYear.php";
		</script>
		<?php
	}
}

if(isset($_GET['did']))
{
	$delQry = "delete from tbl_academicyear where academicyear_id='".$_GET['did']."'";
	if($Con->query($delQry))
	{
		?>
		<script>
		alert("Academic Year Deleted");
		window.location="AcademicYear.php";
		</script>
		<?php
	}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Academic Year</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table border="1" cellpadding="10">
    <tr>
      <td>Year</td>
      <td><input type="text" name="txt_year" id="txt_year" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="btn_submit" id="btn_submit" value="Submit" /></td>
    </tr>
  </table>
</form>

<br />

<table border="1" cellpadding="10">
  <tr>
    <th>Sl.No</th>
    <th>Academic Year</th>
    <th>Action</th>
  </tr>
  <?php
  $i=0;
  $selQry = "select * from tbl_academicyear";
  $result = $Con->query($selQry);
  while($row = $result->fetch_assoc())
  {
	  $i++;
  ?>
  <tr>
    <td><?php echo $i;?></td>
    <td><?php echo $row['academicyear_name'];?></td>
    <td><a href="AcademicYear.php?did=<?php echo $row['academicyear_id'];?>">Delete</a></td>
  </tr>
  <?php
  }
  ?>
</table>
</body>
</html>
