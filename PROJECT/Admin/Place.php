<?php
include("../Assets/Connection/Connection.php");
if(isset($_POST['btn_submit']))
{
	$district=$_POST['sel_district'];
	$place=$_POST['txt_place'];
	$insQry = "insert into tbl_place (place_name,district_id) values ('".$place."','".$district."')";
	if($Con->query($insQry))
	{
		?>
        <script>
		alert("Values Inserted");
		</script>
        <?php
	}
}
if (isset($_GET['did']))
{
	$delQry="delete from tbl_place where place_id='".$_GET['did']."' ";
	if($Con->query($delQry))
	{
		?>
        <script>
		alert("value deleted");
		window.location = "place.php";
		</script>
        <?php
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Place</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="200" border="1">
    <tr>
      <td>District</td>
      <td><label for="sel_district"></label>
        <select name="sel_district" id="sel_district">
        <option>--Select district--</option>
        <?php
		$districtSel="select * from tbl_district";
		$disResult=$Con->query($districtSel);
		while($disRow=$disResult->fetch_assoc())
		{
		?>
        <option value="<?php echo $disRow['district_id']?>">
        <?php echo $disRow['district_name']?></option>>
        <?php
		}
		?>
      </select> <label for="txt_district"></label></td>
    </tr>
    <tr>
      <td>place</td>
      <td><label for="txt_place"></label>
      <input type="text" name="txt_place" id="txt_place" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="btn_submit" id="btn_submit" value="Submit" /></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <table width="200" border="1">
    <tr>
      <td>SlNo</td>
      <td>District</td>
      <td>Place</td>
      <td>Action</td>
    </tr>
    <?php
	$i=0;
	$SelQry = "select * from tbl_place p inner join tbl_district d on d.district_id=p.district_id";
	$result = $Con->query($SelQry);
	while($row=$result->fetch_assoc())
	{
	 $i++;
	 ?>
    <tr>
      <td><?php echo $i ?></td>
      <td><?php echo $row['district_name'];?></td>
      <td><?php echo $row['place_name'];?></td>
      <td><a href="place.php?did=<?php echo $row['place_id']?>">Delete</a></td>
    </tr>
    <?php
	}
	?>
  </table>
</form>
</body>
</html>