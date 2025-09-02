<?php
include("../Assets/Connection/Connection.php");

$classname = "";
$eid = 0;

if(isset($_POST['btn_submit']))
{
	$classname = $_POST['txt_classname'];
	$eid = $_POST['txt_eid'];
	
	if($eid == 0) // Insert
	{
		$insQry = "insert into tbl_class (class_name) values ('".$classname."')";
		if($Con->query($insQry))
		{
			?>
			<script>
			alert("Class Inserted");
			window.location = "AddClass.php";
			</script>
			<?php
		}
	}
	else // Update
	{
		$upQry = "update tbl_class set class_name='".$classname."' where class_id='".$eid."'";
		if($Con->query($upQry))
		{
			?>
			<script>
			alert("Class Updated");
			window.location = "AddClass.php";
			</script>
			<?php
		}
	}
}

// Delete
if(isset($_GET['did']))
{
	$delQry = "delete from tbl_class where class_id='".$_GET['did']."'";
	if($Con->query($delQry))
	{
		?>
		<script>
		alert("Class Deleted");
		window.location = "AddClass.php";
		</script>
		<?php
	}
}

// Edit (load data into form)
if(isset($_GET['eid']))
{
	$editSel = "select * from tbl_class where class_id='".$_GET['eid']."'";
	$editResult = $Con->query($editSel);
	if($editRow = $editResult->fetch_assoc())
	{
		$classname = $editRow['class_name'];
		$eid = $editRow['class_id'];
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add Class</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table border="1" cellpadding="10">
    <tr>
      <td>Class Name</td>
      <td>
        <input type="hidden" name="txt_eid" id="txt_eid" value="<?php echo $eid ?>" />
        <input type="text" name="txt_classname" id="txt_classname" value="<?php echo $classname ?>" />
      </td>
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
    <th>Class</th>
    <th>Action</th>
  </tr>
  <?php
  $i=0;
  $SelQry = "select * from tbl_class";
  $result = $Con->query($SelQry);
  while($row=$result->fetch_assoc())
  {
	  $i++;
	  ?>
	  <tr>
		<td><?php echo $i ?></td>
		<td><?php echo $row['class_name'];?></td>
		<td>
		  <a href="AddClass.php?eid=<?php echo $row['class_id']?>">Edit</a> | 
		  <a href="AddClass.php?did=<?php echo $row['class_id']?>">Delete</a>
		</td>
	  </tr>
	  <?php
  }
  ?>
</table>

</body>
</html>
