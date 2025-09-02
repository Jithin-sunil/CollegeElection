<?php
include("../Assets/Connection/Connection.php");

$teacherid = $_GET['tid']; // teacher id from URL
$classid = "";
$courseid = "";

if(isset($_POST['btn_submit']))
{
	$classid = $_POST['sel_class'];
	$courseid = $_POST['sel_course'];

	$insQry = "insert into tbl_assignteacher (teacher_id,course_id,class_id) values ('".$teacherid."','".$courseid."','".$classid."')";
	if($Con->query($insQry))
	{
		?>
		<script>
		alert("Teacher Assigned Successfully");
		window.location="AssignTeacher.php?tid=<?php echo $teacherid ?>";
		</script>
		<?php
	}
}

// Delete
if(isset($_GET['did']))
{
	$delQry = "delete from tbl_assignteacher where assignteacher_id='".$_GET['did']."'";
	if($Con->query($delQry))
	{
		?>
		<script>
		alert("Assignment Deleted");
		window.location="AssignTeacher.php?tid=<?php echo $teacherid ?>";
		</script>
		<?php
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Assign Teacher</title>
<script src="../Assets/JQ/jQuery.js"></script>
<script>
function getCourse(did)
{
	$.ajax({
		url:"../Assets/AjaxPages/AjaxCourse.php?did="+did,
		success:function(response){
			$('#sel_course').html(response);
		}
	})
}
</script>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table border="1" cellpadding="10">
    <tr>
      <td>Department</td>
      <td>
        <select name="sel_department" id="sel_department" onchange="getCourse(this.value)">
          <option value="">--Select--</option>
          <?php
          $depSel="select * from tbl_department";
          $depRs=$Con->query($depSel);
          while($depRow=$depRs->fetch_assoc())
          {
            ?>
            <option value="<?php echo $depRow['department_id'];?>"><?php echo $depRow['department_name'];?></option>
            <?php
          }
          ?>
        </select>
      </td>
    </tr>
    <tr>
      <td>Course</td>
      <td>
        <select name="sel_course" id="sel_course">
          <option value="">--Select--</option>
        </select>
      </td>
    </tr>
    <tr>
      <td>Class</td>
      <td>
        <select name="sel_class" id="sel_class">
          <option value="">--Select--</option>
          <?php
          $classSel="select * from tbl_class";
          $classRs=$Con->query($classSel);
          while($classRow=$classRs->fetch_assoc())
          {
            ?>
            <option value="<?php echo $classRow['class_id'];?>"><?php echo $classRow['class_name'];?></option>
            <?php
          }
          ?>
        </select>
      </td>
    </tr>
    <tr>
      <td colspan="2" align="center">
        <input type="submit" name="btn_submit" id="btn_submit" value="Assign Teacher" />
      </td>
    </tr>
  </table>
</form>

<br />

<table border="1" cellpadding="10">
  <tr>
    <th>Sl.No</th>
    <th>Teacher</th>
    <th>Course</th>
    <th>Class</th>
    <th>Action</th>
  </tr>
  <?php
  $i=0;
  $SelQry="select * from tbl_assignteacher a 
           inner join tbl_teacher t on a.teacher_id=t.teacher_id 
           inner join tbl_course c on a.course_id=c.course_id 
           inner join tbl_class cl on a.class_id=cl.class_id
           where a.teacher_id='".$teacherid."'";
  $result=$Con->query($SelQry);
  while($row=$result->fetch_assoc())
  {
	  $i++;
	  ?>
	  <tr>
		<td><?php echo $i ?></td>
		<td><?php echo $row['teacher_name'];?></td>
		<td><?php echo $row['course_name'];?></td>
		<td><?php echo $row['class_name'];?></td>
		<td><a href="AssignTeacher.php?tid=<?php echo $teacherid ?>&did=<?php echo $row['assignteacher_id']?>">Delete</a></td>
	  </tr>
	  <?php
  }
  ?>
</table>

</body>
</html>
