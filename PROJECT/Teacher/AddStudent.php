<?php
include("../Assets/Connection/Connection.php");

if(isset($_POST['btn_submit']))
{
    $name=$_POST['txt_name'];
    $email=$_POST['txt_email'];
    $contact=$_POST['txt_contact'];
    $address=$_POST['txt_address'];
    $department=$_POST['sel_department'];
    $course=$_POST['sel_course'];
    $class=$_POST['sel_class'];
    $academicyear=$_POST['sel_academicyear'];

    $photo=$_FILES['file_photo']['name'];
    $temp=$_FILES['file_photo']['tmp_name'];
    move_uploaded_file($temp,'../Assets/Files/Student/Photo/'.$photo);

    $password=$_POST['txt_pswd'];
    
    $insQry = "insert into tbl_student (student_name,student_email,student_contact,student_address,department_id,course_id,class_id,academicyear_id,student_photo,student_password) values ('".$name."','".$email."','".$contact."','".$address."','".$department."','".$course."','".$class."','".$academicyear."','".$photo."','".$password."')";
    if($Con->query($insQry))
    {
        ?>
        <script>
        alert("Student Inserted");
        window.location = "AddStudent.php";
        </script>
        <?php
    }
}

// Delete
if(isset($_GET['did']))
{
    $delQry = "delete from tbl_student where student_id='".$_GET['did']."'";
    if($Con->query($delQry))
    {
        ?>
        <script>
        alert("Student Deleted");
        window.location = "AddStudent.php";
        </script>
        <?php
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add Student</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="" enctype="multipart/form-data">
  <table width="200" border="1" cellpadding="5">
    <tr>
      <td>Name</td>
      <td><input type="text" name="txt_name" id="txt_name" /></td>
    </tr>
    <tr>
      <td>Email</td>
      <td><input type="email" name="txt_email" id="txt_email" /></td>
    </tr>
    <tr>
      <td>Contact</td>
      <td><input type="text" name="txt_contact" id="txt_contact" /></td>
    </tr>
    <tr>
      <td>Address</td>
      <td>
       <textarea name="txt_address" id="txt_address"></textarea> 
    </td>
    </tr>
    <tr>
      <td>Department</td>
      <td>
        <select name="sel_department" id="sel_department" onChange="getCourse(this.value)">
          <option value="">--Select--</option>
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
          $classResult=$Con->query($classSel);
          while($classRow=$classResult->fetch_assoc())
          {
          ?>
          <option value="<?php echo $classRow['class_id']?>"><?php echo $classRow['class_name']?></option>
          <?php
          }
          ?>
        </select>
      </td>
    </tr>
    <tr>
      <td>Academic Year</td>
      <td>
        <select name="sel_academicyear" id="sel_academicyear">
          <option value="">--Select--</option>
          <?php
          $academicyearSel="select * from tbl_academicyear";
          $academicyearResult=$Con->query($academicyearSel);
          while($academicyearRow=$academicyearResult->fetch_assoc())
          {
          ?>
          <option value="<?php echo $academicyearRow['academicyear_id']?>"><?php echo $academicyearRow['academicyear_name']?></option>
          <?php
          }
          ?>
        </select>
      </td>
    </tr>
    <tr>
      <td>Photo</td>
      <td><input type="file" name="file_photo" id="file_photo" /></td>
    </tr>
    <tr>
      <td>Password</td>
      <td><input type="password" name="txt_pswd" id="txt_pswd" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="btn_submit" id="btn_submit" value="Submit" /></td>
    </tr>
  </table>
</form>

<br />

<table border="1" cellpadding="5">
  <tr>
    <th>SlNo</th>
    <th>Name</th>
    <th>Email</th>
    <th>Contact</th>
    <th>Address</th>
    <th>Department</th>
    <th>Course</th>
    <th>Class</th>
    <th>Academic Year</th>
    <th>Photo</th>
    <th>Action</th>
  </tr>
  <?php
  $i=0;
  $SelQry = "select * from tbl_student s 
             inner join tbl_department d on s.department_id=d.department_id 
             inner join tbl_course c on s.course_id=c.course_id
             inner join tbl_class cl on s.class_id=cl.class_id
             inner join tbl_academicyear a on s.academicyear_id=a.academicyear_id";
  $result = $Con->query($SelQry);
  while($row=$result->fetch_assoc())
  {
      $i++;
  ?>
  <tr>
    <td><?php echo $i ?></td>
    <td><?php echo $row['student_name'];?></td>
    <td><?php echo $row['student_email'];?></td>
    <td><?php echo $row['student_contact'];?></td>
    <td><?php echo $row['student_address'];?></td>
    <td><?php echo $row['department_name'];?></td>
    <td><?php echo $row['course_name'];?></td>
    <td><?php echo $row['class_name'];?></td>
    <td><?php echo $row['academicyear_name'];?></td>
    <td><img src="../Assets/Files/Student/Photo/<?php echo $row['student_photo'];?>" width="50" height="50"/></td>
    <td><a href="AddStudent.php?did=<?php echo $row['student_id']?>">Delete</a></td>
  </tr>
  <?php
  }
  ?>
</table>

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

</body>
</html>
