<?php
include("../Assets/Connection/Connection.php");

if(isset($_POST['btn_submit']))
{
	$name=$_POST['txt_name'];
	$email=$_POST['txt_email'];
	$contact=$_POST['txt_contact'];
	$photo=$_FILES['file_photo']['name'];
    $temp=$_FILES['file_photo']['tmp_name'];
	$department=$_POST['sel_department'];
	$password=$_POST['txt_pswd'];

	move_uploaded_file($temp,'../Assets/Files/Teacher/Photo/'.$photo);
	
	$insQry = "insert into tbl_teacher (teacher_name,teacher_email,teacher_contact,teacher_photo,department_id,teacher_password) values ('".$name."','".$email."','".$contact."','".$photo."','".$department."','".$password."')";
	if($Con->query($insQry))
	{
		?>
        <script>
		alert("Teacher Inserted");
		window.location = "AddTeacher.php";
		</script>
        <?php
	}
}

// Delete
if (isset($_GET['did']))
{
	$delQry="delete from tbl_teacher where teacher_id='".$_GET['did']."' ";
	if($Con->query($delQry))
	{
		?>
        <script>
		alert("Teacher Deleted");
		window.location = "AddTeacher.php";
		</script>
        <?php
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add Teacher</title>
</head>

<body>
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <table border="1" cellpadding="10">
    <tr>
      <td>Name</td>
      <td><input type="text" name="txt_name" id="txt_name" /></td>
    </tr>
    <tr>
      <td>Email</td>
      <td><input type="text" name="txt_email" id="txt_email" /></td>
    </tr>
    <tr>
      <td>Contact</td>
      <td><input type="text" name="txt_contact" id="txt_contact" /></td>
    </tr>
    <tr>
      <td>Photo</td>
      <td><input type="file" name="file_photo" id="file_photo" /></td>
    </tr>
    <tr>
      <td>Department</td>
      <td>
        <select name="sel_department" id="sel_department">
          <option value="">--Select Department--</option>
          <?php
		  $departmentSel="select * from tbl_department";
		  $deptResult=$Con->query($departmentSel);
		  while($deptRow=$deptResult->fetch_assoc())
		  {
			  ?>
			  <option value="<?php echo $deptRow['department_id']?>"><?php echo $deptRow['department_name']?></option>
			  <?php
		  }
		  ?>
        </select>
      </td>
    </tr>
    <tr>
      <td>Password</td>
      <td><input type="text" name="txt_pswd" id="txt_pswd" /></td>
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
    <th>Email</th>
    <th>Contact</th>
    <th>Photo</th>
    <th>Department</th>
    <th>Action</th>
  </tr>
  <?php
  $i=0;
  $SelQry = "select * from tbl_teacher t inner join tbl_department d on t.department_id=d.department_id";
  $result = $Con->query($SelQry);
  while($row=$result->fetch_assoc())
  {
	  $i++;
	  ?>
	  <tr>
		<td><?php echo $i?></td>
		<td><?php echo $row['teacher_name'];?></td>
		<td><?php echo $row['teacher_email'];?></td>
		<td><?php echo $row['teacher_contact'];?></td>
		<td><img src="../Assets/Files/Teacher/Photo/<?php echo $row['teacher_photo'];?>" width="80" /></td>
		<td><?php echo $row['department_name'];?></td>
		<td><a href="AddTeacher.php?did=<?php echo $row['teacher_id']?>">Delete</a>|
            <a href="AssignTeacher.php?tid=<?php echo $row['teacher_id']?>">Assign</a>
  </td>
	  </tr>
	  <?php
  }
  ?>
</table>

</body>
</html>
