<?php
include("../Assets/Connection/Connection.php");
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Student - Elections</title>
</head>
<body>
<h2 align="center">Available Elections</h2>
<table border="1" cellpadding="10" align="center">
  <tr>
    <th>Sl.No</th>
    <th>Name</th>
    <th>Description</th>
    <th>From Date</th>
    <th>To Date</th>
    <th>Action</th>
  </tr>
  <?php
  $i=0;
  $SelQry = "SELECT * FROM tbl_election WHERE election_status=1";
  $result = $Con->query($SelQry);
  while($row=$result->fetch_assoc()) {
      $i++;
      ?>
      <tr>
        <td><?php echo $i ?></td>
        <td><?php echo $row['election_name']; ?></td>
        <td><?php echo $row['election_description']; ?></td>
        <td><?php echo $row['election_date']; ?></td>
        <td><?php echo $row['election_todate']; ?></td>
        <td>
          <a href="ElectionDetails.php?eid=<?php echo $row['election_id']; ?>">View Details</a> | 
          <a href="ViewCandidates.php?eid=<?php echo $row['election_id']; ?>">View Candidates</a>
        </td>
      </tr>
      <?php
  }
  ?>
</table>
</body>
</html>
