<?php
include("../Assets/Connection/Connection.php");
$district="";
$eid=0;
if(isset($_POST['btn_submit']))
{
	$district=$_POST['txt_district'];
	$eid = $_POST['txt_eid'];
	if($eid==0)
	{
	$insQry = "insert into tbl_district (district_name) values ('".$district."')";
	if($Con->query($insQry))
	{
		?>
        <script>
		alert("Values Inserted");
		</script>
        <?php
	}
	}
	else 
{
$upQry="update tbl_district set district_name='".$district."'where district_id ='".$eid."' ";
 if($Con->query($upQry))
 {
	 ?>
     <script>
     alert("Data Updated.");
     window.location="Dstrict.php";
     </script>
    
     <?php
 }
}
}

if (isset($_GET['did']))
{
	$delQry="delete from tbl_district where district_id='".$_GET['did']."' ";
	if($Con->query($delQry))
	{
		?>
        <script>
		alert("value deleted");
		window.location = "Dstrict.php";
		</script>
        <?php
	}
}
if (isset($_GET['eid']))
{
$editSel="select * from tbl_district where district_id='".$_GET['eid']."' ";
$editResult=$Con->query($editSel);
$editRow = $editResult->fetch_assoc();
$district = $editRow['district_name'];
$eid = $editRow['district_id'];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>District</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="200" border="1">
    <tr>
      <td>District</td>
      <td><label for="txt_district"></label>
      <input type="hidden" name="txt_eid" id="txt_eid" value="<?php echo $eid ?>" />
      <input type="text" name="txt_district" id="txt_district" value="<?php echo $district ?>" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="btn_submit" id="btn_submit" value="Submit" /></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <table width="247" border="1">
    <tr>
      <td width="59" height="44">SLNO</td>
      <td width="116">District Name</td>
      <td width="50">Action</td>
    </tr>
    <?php
	$i=0;
	$SelQry = "select * from tbl_district";
	$result = $Con->query($SelQry);
	while($row=$result->fetch_assoc())
	{
		$i++;
		?>
    <tr>
      <td height="75"><?php echo $i ?></td>
      <td><?php echo $row['district_name'];?></td>
      <td><a href="Dstrict.php?did=<?php echo $row['district_id']?>">Delete</a>
      <a href="Dstrict.php?eid=<?php echo $row['district_id']?>">Edit</a></td>
    </tr>
    <?php
	}
	?>
  </table>
  <p>&nbsp;</p>
</form>
</body>
</html>