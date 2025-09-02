<option>--select--</option>
<?php
include("../Connection/Connection.php");
$selQry="select * from tbl_course where department_id='".$_GET['did']."'";
$row=$Con->query($selQry);
while($data=$row->fetch_assoc())
{
	?>
        <option value="<?php echo $data['course_id']?>">
        <?php echo $data['course_name']?></option>
        <?php
		}
		?>