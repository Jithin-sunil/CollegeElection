<?php
include("../Assets/Connection/Connection.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>View Elections</title>
</head>
<body>
<h2>Available Elections</h2>
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
  $i=0;
  $SelQry = "select * from tbl_election";
  $result = $Con->query($SelQry);
  while($row=$result->fetch_assoc())
  {
      $i++;
  ?>
  <tr>
    <td><?php echo $i ?></td>
    <td><?php echo $row['election_name'];?></td>
    <td><?php echo $row['election_description'];?></td>
    <td><?php echo $row['election_date'];?></td>
    <td><?php echo $row['election_todate'];?></td>
    <td><a href="ViewElectionDetails.php?eid=<?php echo $row['election_id']?>">View Details</a></td>
  </tr>
  <?php
  }
  ?>
</table>
</body>
</html>
