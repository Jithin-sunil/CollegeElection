<?php
include("../Assets/Connection/Connection.php");

$positionname = "";
$eid = 0;

if(isset($_POST['btn_submit']))
{
	$positionname = $_POST['txt_position'];
	$eid = $_POST['txt_eid'];

	if($eid == 0) // Insert
	{
		$insQry = "insert into tbl_position (position_name) values ('".$positionname."')";
		if($Con->query($insQry))
		{
			?>
			<script>
			alert("Position Inserted");
			window.location = "Position.php";
			</script>
			<?php
		}
	}
	else // Update
	{
		$upQry = "update tbl_position set position_name='".$positionname."' where position_id='".$eid."'";
		if($Con->query($upQry))
		{
			?>
			<script>
			alert("Position Updated");
			window.location = "Position.php";
			</script>
			<?php
		}
	}
}

// Delete
if (isset($_GET['did']))
{
	$delQry="delete from tbl_position where position_id='".$_GET['did']."'";
	if($Con->query($delQry))
	{
		?>
		<script>
		alert("Position Deleted");
		window.location = "Position.php";
		</script>
		<?php
	}
}

// Edit
if (isset($_GET['eid']))
{
	$editSel="select * from tbl_position where position_id='".$_GET['eid']."'";
	$editResult=$Con->query($editSel);
	if($editRow=$editResult->fetch_assoc())
	{
		$positionname = $editRow['position_name'];
		$eid = $editRow['position_id'];
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Position</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <input type="hidden" name="txt_eid" id="txt_eid" value="<?php echo $eid ?>" />
  <table border="1" cellpadding="10">
    <tr>
      <td>Position Name</td>
      <td><input type="text" name="txt_position" id="txt_position" value="<?php echo $positionname ?>"/></td>
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
    <th>Position</th>
    <th>Action</th>
  </tr>
  <?php
  $i=0;
  $SelQry = "select * from tbl_position";
  $result = $Con->query($SelQry);
  while($row=$result->fetch_assoc())
  {
	  $i++;
	  ?>
	  <tr>
		<td><?php echo $i ?></td>
		<td><?php echo $row['position_name'];?></td>
		<td>
		  <a href="Position.php?eid=<?php echo $row['position_id']?>">Edit</a> | 
		  <a href="Position.php?did=<?php echo $row['position_id']?>">Delete</a>
		</td>
	  </tr>
	  <?php
  }
  ?>
</table>

</body>
</html>
