<?php
include("../Assets/Connection/Connection.php");
session_start();

$teacherId = $_SESSION['tid'];

// ✅ Get class from assign table
$classSel = "SELECT class_id FROM tbl_assignteacher WHERE teacher_id='".$teacherId."'";
$classRes = $Con->query($classSel);
$classRow = $classRes->fetch_assoc();
$classId  = $classRow['class_id'];

// Verify vote
if (isset($_GET['verify'])) {
    $voteId = $_GET['verify'];
    $Con->query("UPDATE tbl_classpolling SET classpolling_status=1 WHERE classpolling_id='".$voteId."'");
    ?>
    <script>
    alert("Vote Verified Successfully");
    window.location="ViewVotes.php";
    </script>
    <?php
    exit;
}

// Reject vote
if (isset($_GET['reject'])) {
    $voteId = $_GET['reject'];
    $Con->query("UPDATE tbl_classpolling SET classpolling_status=2 WHERE classpolling_id='".$voteId."'");
    ?>
    <script>
    alert("Vote Rejected");
    window.location="ViewVotes.php";
    </script>
    <?php
    exit;
}

// Fetch votes for students of this class
$SelQry = "SELECT v.classpolling_id, v.classpolling_date, v.classpolling_status,
                  s.student_name, s.student_email, s.student_photo,
                  c.candidate_id, cs.student_name AS candidate_name
           FROM tbl_classpolling v
           INNER JOIN tbl_student s ON v.student_id = s.student_id
           INNER JOIN tbl_classcandidate c ON v.candidate_id = c.candidate_id
           INNER JOIN tbl_student cs ON c.student_id = cs.student_id
           WHERE s.class_id='".$classId."'";
$result = $Con->query($SelQry);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Verify Votes</title>
</head>
<body>
<h2 align="center">Verify Votes</h2>
<table border="1" cellpadding="10" align="center">
  <tr>
    <th>Sl.No</th>
    <th>Voter Name</th>
    <th>Voter Email</th>
    <th>Candidate</th>
    <th>Date</th>
    <th>Status</th>
    <th>Action</th>
  </tr>
  <?php
  $i=0;
  while($row=$result->fetch_assoc()) {
      $i++;
      $status = "Pending";
      if ($row['classpolling_status']==1) $status = "Verified";
      elseif ($row['classpolling_status']==2) $status = "Rejected";
      ?>
      <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $row['student_name']; ?></td>
        <td><?php echo $row['student_email']; ?></td>
        <td><?php echo $row['candidate_name']; ?></td>
        <td><?php echo $row['classpolling_date']; ?></td>
        <td><?php echo $status; ?></td>
        <td>
          <?php if ($row['classpolling_status']==0) { ?>
            <a href="ViewVotes.php?verify=<?php echo $row['classpolling_id']; ?>">Verify</a> |
            <a href="ViewVotes.php?reject=<?php echo $row['classpolling_id']; ?>">Reject</a>
          <?php } elseif ($row['classpolling_status']==1) { ?>
            Verified
          <?php } else { ?>
            Rejected
          <?php } ?>
        </td>
      </tr>
      <?php
  }
  ?>
</table>
</body>
</html>
