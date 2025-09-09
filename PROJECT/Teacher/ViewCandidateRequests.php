<?php
include("../Assets/Connection/Connection.php");
session_start();

$teacherId = $_SESSION['tid'];

// Get class of teacher (through teacherassign table)
$classSel = "SELECT * FROM tbl_assignteacher WHERE teacher_id='".$teacherId."'";
$classRes = $Con->query($classSel);
$classRow = $classRes->fetch_assoc();
$classId  = $classRow['class_id'];

// Accept
if (isset($_GET['accept'])) {
    $cid = $_GET['accept'];
    $Con->query("UPDATE tbl_classcandidate SET candidate_status=1 WHERE candidate_id='".$cid."'");
    ?>
    <script>
    alert("Candidate Accepted");
    window.location="ViewCandidateRequests.php";
    </script>
    <?php
}

// Reject
if (isset($_GET['reject'])) {
    $cid = $_GET['reject'];
    $Con->query("UPDATE tbl_classcandidate SET candidate_status=2 WHERE candidate_id='".$cid."'");
    ?>
    <script>
    alert("Candidate Rejected");
    window.location="ViewCandidateRequests.php";
    </script>
    <?php
}

// Fetch Requests
$SelQry = "SELECT c.*, s.student_name, s.student_email, e.election_name, e.election_date, e.election_todate
           FROM tbl_classcandidate c 
           INNER JOIN tbl_student s ON c.student_id = s.student_id
           INNER JOIN tbl_election e ON c.election_id = e.election_id
           WHERE s.class_id='".$classId."'";
$result = $Con->query($SelQry);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Candidate Requests</title>
</head>
<body>
<h2 align="center">Candidate Requests</h2>
<table border="1" cellpadding="10" align="center">
  <tr>
    <th>Sl.No</th>
    <th>Student Name</th>
    <th>Email</th>
    <th>Election</th>
    <th>Applied Date</th>
    <th>Status</th>
    <th>Action</th>
  </tr>
  <?php
  $i=0;
  while($row=$result->fetch_assoc()) {
      $i++;

      // Status Text
      if ($row['candidate_status'] == 0) {
          $status = "Pending";
      } elseif ($row['candidate_status'] == 1) {
          $status = "Accepted";
      } else {
          $status = "Rejected";
      }
      ?>
      <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $row['student_name']; ?></td>
        <td><?php echo $row['student_email']; ?></td>
        <td><?php echo $row['election_name']." (".$row['election_date']." to ".$row['election_todate'].")"; ?></td>
        <td><?php echo $row['candidate_date']; ?></td>
        <td><?php echo $status; ?></td>
        <td>
          <a href="StudentDetails.php?sid=<?php echo $row['student_id']; ?>">View Details</a>
          <?php if ($row['candidate_status']==0) { ?>
            | <a href="ViewCandidateRequests.php?accept=<?php echo $row['candidate_id']; ?>">Accept</a>
            | <a href="ViewCandidateRequests.php?reject=<?php echo $row['candidate_id']; ?>">Reject</a>
          <?php } elseif ($row['candidate_status']==1) {
                echo " | Accepted";
          } else {
                echo " | Rejected";
          } ?>
        </td>
      </tr>
      <?php
  }
  ?>
</table>
</body>
</html>
