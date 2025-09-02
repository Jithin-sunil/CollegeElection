<?php
include("../Assets/Connection/Connection.php");

if(isset($_POST['btn_submit']))
{
	$coursename = $_POST['txt_dept'];
	$department = $_POST['sel_department'];
	
	$insQry = "insert into tbl_course (course_name,department_id) values ('".$coursename."','".$department."')";
	if($Con->query($insQry))
	{
		?>
        <script>
		alert("Course Inserted");
		window.location="Course.php";
		</script>
        <?php
	}
}

// Delete
if (isset($_GET['did']))
{
	$delQry="delete from tbl_course where course_id='".$_GET['did']."' ";
	if($Con->query($delQry))
	{
		?>
        <script>
		alert("Course Deleted");
		window.location = "Course.php";
		</script>
        <?php
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Course</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table border="1" cellpadding="10">
    <tr>
      <td>Course Name</td>
      <td><input type="text" name="txt_dept" id="txt_dept" /></td>
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
      <td colspan="2" align="center"><input type="submit" name="btn_submit" id="btn_submit" value="Submit" /></td>
    </tr>
  </table>
</form>

<br />

<table border="1" cellpadding="10">
  <tr>
    <th>SlNo</th>
    <th>Course</th>
    <th>Department</th>
    <th>Action</th>
  </tr>
  <?php
  $i=0;
  $SelQry = "select * from tbl_course c inner join tbl_department d on c.department_id=d.department_id";
  $result = $Con->query($SelQry);
  while($row=$result->fetch_assoc())
  {
	  $i++;
	  ?>
	  <tr>
		<td><?php echo $i?></td>
		<td><?php echo $row['course_name'];?></td>
		<td><?php echo $row['department_name'];?></td>
		<td><a href="Course.php?did=<?php echo $row['course_id']?>">Delete</a></td>
	  </tr>
	  <?php
  }
  ?>
</table>

</body>
</html>
