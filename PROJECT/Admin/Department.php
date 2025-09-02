<?php
include("../Assets/Connection/Connection.php");

$departmentname = "";
$eid = 0;

if(isset($_POST['btn_submit']))
{
	$departmentname = $_POST['txt_dept'];
	$eid = $_POST['txt_eid'];

	if($eid == 0) // Insert
	{
		$insQry = "insert into tbl_department (department_name) values ('".$departmentname."')";
		if($Con->query($insQry))
		{
			?>
			<script>
			alert("Department Inserted");
			window.location = "Department.php";
			</script>
			<?php
		}
	}
	else // Update
	{
		$upQry = "update tbl_department set department_name='".$departmentname."' where department_id='".$eid."'";
		if($Con->query($upQry))
		{
			?>
			<script>
			alert("Department Updated");
			window.location = "Department.php";
			</script>
			<?php
		}
	}
}

// Delete
if (isset($_GET['did']))
{
	$delQry="delete from tbl_department where department_id='".$_GET['did']."'";
	if($Con->query($delQry))
	{
		?>
		<script>
		alert("Department Deleted");
		window.location = "Department.php";
		</script>
		<?php
	}
}

// Edit
if (isset($_GET['eid']))
{
	$editSel="select * from tbl_department where department_id='".$_GET['eid']."'";
	$editResult=$Con->query($editSel);
	if($editRow=$editResult->fetch_assoc())
	{
		$departmentname = $editRow['department_name'];
		$eid = $editRow['department_id'];
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Department</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <input type="hidden" name="txt_eid" id="txt_eid" value="<?php echo $eid ?>" />
  <table border="1" cellpadding="10">
    <tr>
      <td>Department Name</td>
      <td><input type="text" name="txt_dept" id="txt_dept" value="<?php echo $departmentname ?>"/></td>
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
    <th>Department</th>
    <th>Action</th>
  </tr>
  <?php
  $i=0;
  $SelQry = "select * from tbl_department";
  $result = $Con->query($SelQry);
  while($row=$result->fetch_assoc())
  {
	  $i++;
	  ?>
	  <tr>
		<td><?php echo $i ?></td>
		<td><?php echo $row['department_name'];?></td>
		<td>
		  <a href="Department.php?eid=<?php echo $row['department_id']?>">Edit</a> | 
		  <a href="Department.php?did=<?php echo $row['department_id']?>">Delete</a>
		</td>
	  </tr>
	  <?php
  }
  ?>
</table>

</body>
</html>
