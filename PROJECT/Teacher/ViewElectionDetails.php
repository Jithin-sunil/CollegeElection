<?php
include("../Assets/Connection/Connection.php");

if(!isset($_GET['eid'])){
    ?>
    <script>
    alert("No Election Selected");
    window.location="ViewElection.php";
    </script>
    <?php
    exit;
}

$eid=$_GET['eid'];
$selQry="select * from tbl_election where election_id='".$eid."'";
$res=$Con->query($selQry);
$row=$res->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Election Details</title>
</head>
<body>
<h2>Election Details</h2>
<table border="1" cellpadding="10">
  <tr>
    <td><strong>Name</strong></td>
    <td><?php echo $row['election_name'];?></td>
  </tr>
  <tr>
    <td><strong>Description</strong></td>
    <td><?php echo $row['election_description'];?></td>
  </tr>
  <tr>
    <td><strong>Created Date</strong></td>
    <td><?php echo $row['election_date'];?></td>
  </tr>
  <tr>
    <td><strong>To Date</strong></td>
    <td><?php echo $row['election_todate'];?></td>
  </tr>
</table>
<br>
<a href="ViewElection.php">Back to Elections</a>
</body>
</html>
