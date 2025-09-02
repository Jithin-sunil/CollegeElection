<?php
include("../Assets/Connection/Connection.php");

$description = "";
$lastdate = "";
$edid = 0;

// Election id from URL
$electionid = $_GET['eid'];

if(isset($_POST['btn_submit']))
{
	$description = $_POST['txt_desc'];
	$lastdate = $_POST['txt_lastdate'];
	$edid = $_POST['txt_edid'];

	if($edid == 0) // Insert
	{
		$insQry = "insert into tbl_electiondetails (electiondetails_date,electiondetails_lastdate,electiondetails_description,election_id) values (CURDATE(),'".$lastdate."','".$description."','".$electionid."')";
		if($Con->query($insQry))
		{
			?>
			<script>
			alert("Election Detail Inserted");
			window.location="ElectionDetails.php?eid=<?php echo $electionid ?>";
			</script>
			<?php
		}
	}
	else // Update
	{
		$upQry = "update tbl_electiondetails set electiondetails_lastdate='".$lastdate."', electiondetails_description='".$description."' where electiondetails_id='".$edid."'";
		if($Con->query($upQry))
		{
			?>
			<script>
			alert("Election Detail Updated");
			window.location="ElectionDetails.php?eid=<?php echo $electionid ?>";
			</script>
			<?php
		}
	}
}

// Delete
if(isset($_GET['did']))
{
	$delQry="delete from tbl_electiondetails where electiondetails_id='".$_GET['did']."'";
	if($Con->query($delQry))
	{
		?>
		<script>
		alert("Election Detail Deleted");
		window.location="ElectionDetails.php?eid=<?php echo $electionid ?>";
		</script>
		<?php
	}
}

// Edit
if(isset($_GET['edid']))
{
	$editSel="select * from tbl_electiondetails where electiondetails_id='".$_GET['edid']."'";
	$editResult=$Con->query($editSel);
	if($editRow=$editResult->fetch_assoc())
	{
		$description = $editRow['electiondetails_description'];
		$lastdate = $editRow['electiondetails_lastdate'];
		$edid = $editRow['electiondetails_id'];
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Election Details</title>
</head>

<body>
<h2>Election Details</h2>
<form method="post" action="">
  <input type="hidden" name="txt_edid" value="<?php echo $edid ?>" />
  <table border="1" cellpadding="10">
    <tr>
      <td>Description</td>
      <td><input type="text" name="txt_desc" id="txt_desc" value="<?php echo $description ?>" /></td>
    </tr>
    <tr>
      <td>Last Date</td>
      <td><input type="date" name="txt_lastdate" id="txt_lastdate" value="<?php echo $lastdate ?>" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="btn_submit" value="Submit" /></td>
    </tr>
  </table>
</form>

<br />

<table border="1" cellpadding="10">
  <tr>
    <th>Sl.No</th>
    <th>Date</th>
    <th>Last Date</th>
    <th>Description</th>
    <th>Action</th>
  </tr>
  <?php
  $i=0;
  $SelQry="select * from tbl_electiondetails where election_id='".$electionid."'";
  $result=$Con->query($SelQry);
  while($row=$result->fetch_assoc())
  {
	  $i++;
	  ?>
	  <tr>
	    <td><?php echo $i ?></td>
	    <td><?php echo $row['electiondetails_date'] ?></td>
	    <td><?php echo $row['electiondetails_lastdate'] ?></td>
	    <td><?php echo $row['electiondetails_description'] ?></td>
	    <td>
	      <a href="ElectionDetails.php?eid=<?php echo $electionid ?>&edid=<?php echo $row['electiondetails_id']?>">Edit</a> | 
	      <a href="ElectionDetails.php?eid=<?php echo $electionid ?>&did=<?php echo $row['electiondetails_id']?>">Delete</a>
	    </td>
	  </tr>
	  <?php
  }
  ?>
</table>

</body>
</html>
