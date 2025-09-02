<?php
include("../Assets/Connection/Connection.php");

$electionname = "";
$description = "";
$todate = "";
$eid = 0;

if(isset($_POST['btn_submit']))
{
	$electionname = $_POST['txt_name'];
	$description = $_POST['txt_desc'];
	$todate = $_POST['txt_todate'];
	$eid = $_POST['txt_eid'];

	if($eid == 0) // Insert
	{
		$insQry = "insert into tbl_election (election_name,election_description,election_date,election_todate) values ('".$electionname."','".$description."',CURDATE(),'".$todate."')";
		if($Con->query($insQry))
		{
			?>
			<script>
			alert("Election Inserted");
			window.location = "Election.php";
			</script>
			<?php
		}
	}
	else // Update
	{
		$upQry = "update tbl_election set election_name='".$electionname."',election_description='".$description."',election_todate='".$todate."' where election_id='".$eid."'";
		if($Con->query($upQry))
		{
			?>
			<script>
			alert("Election Updated");
			window.location = "Election.php";
			</script>
			<?php
		}
	}
}

// Delete
if (isset($_GET['did']))
{
	$delQry = "delete from tbl_election where election_id='".$_GET['did']."'";
	if($Con->query($delQry))
	{
		?>
		<script>
		alert("Election Deleted");
		window.location = "Election.php";
		</script>
		<?php
	}
}

// Edit
if (isset($_GET['eid']))
{
	$editSel = "select * from tbl_election where election_id='".$_GET['eid']."'";
	$editResult = $Con->query($editSel);
	if($editRow = $editResult->fetch_assoc())
	{
		$electionname = $editRow['election_name'];
		$description = $editRow['election_description'];
		$todate = $editRow['election_todate'];
		$eid = $editRow['election_id'];
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Election</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <input type="hidden" name="txt_eid" id="txt_eid" value="<?php echo $eid ?>" />
  <table border="1" cellpadding="10">
    <tr>
      <td>Election Name</td>
      <td><input type="text" name="txt_name" id="txt_name" value="<?php echo $electionname ?>"/></td>
    </tr>
    <tr>
      <td>Description</td>
      <td><input type="text" name="txt_desc" id="txt_desc" value="<?php echo $description ?>"/></td>
    </tr>
    <tr>
      <td>To Date</td>
      <td><input type="date" name="txt_todate" id="txt_todate" value="<?php echo $todate ?>"/></td>
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
    <th>Name</th>
    <th>Description</th>
    <th>Created Date</th>
    <th>To Date</th>
    <th>Action</th>
  </tr>
  <?php
  $i = 0;
  $SelQry = "select * from tbl_election";
  $result = $Con->query($SelQry);
  while($row = $result->fetch_assoc())
  {
	  $i++;
	  ?>
	  <tr>
		<td><?php echo $i ?></td>
		<td><?php echo $row['election_name']; ?></td>
		<td><?php echo $row['election_description']; ?></td>
		<td><?php echo $row['election_date']; ?></td>
		<td><?php echo $row['election_todate']; ?></td>
		<td>
		  <a href="Election.php?eid=<?php echo $row['election_id']?>">Edit</a> | 
		  <a href="Election.php?did=<?php echo $row['election_id']?>">Delete</a> | 
		  <a href="ElectionDetails.php?eid=<?php echo $row['election_id']?>">Manage Details</a>
		</td>
	  </tr>
	  <?php
  }
  ?>
</table>

</body>
</html>
