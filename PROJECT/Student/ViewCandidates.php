<?php
include("../Assets/Connection/Connection.php");
session_start();

$studentId  = $_SESSION['sid'];
$electionId = $_GET['eid'];

if (isset($_GET['vote'])) {
    $cid = $_GET['vote'];

    $checkVote = "SELECT *
                  FROM tbl_classpolling p 
                  INNER JOIN tbl_classcandidate c ON p.candidate_id=c.candidate_id
                  WHERE p.student_id='".$studentId."' AND c.election_id='".$electionId."'";
    $voteRes = $Con->query($checkVote);

    if ($voteRes->num_rows == 0) {
        $insVote = "INSERT INTO tbl_classpolling (student_id, candidate_id, classpolling_date) 
                    VALUES ('".$studentId."', '".$cid."', CURDATE())";
        if ($Con->query($insVote)) {
            ?>
            <script>
            alert("Vote Casted Successfully!");
            window.location="ViewCandidates.php?eid=<?php echo $electionId ?>";
            </script>
            <?php
        }
    } else {
        ?>
        <script>
        alert("You have already voted in this election!");
        window.location="ViewCandidates.php?eid=<?php echo $electionId ?>";
        </script>
        <?php
    }
}

// Election details
$electionSel = "SELECT * FROM tbl_election WHERE election_id='".$electionId."'";
$electionRes = $Con->query($electionSel);
$electionRow = $electionRes->fetch_assoc();

$today = date("Y-m-d");

// Get student's class
$studentSel = "SELECT class_id FROM tbl_student WHERE student_id='".$studentId."'";
$studentRes = $Con->query($studentSel);
$studentRow = $studentRes->fetch_assoc();
$classId = $studentRow['class_id'];

// Fetch approved candidates
$candQry = "SELECT *
            FROM tbl_classcandidate c 
            INNER JOIN tbl_student s ON c.student_id=s.student_id 
            WHERE c.election_id='".$electionId."' 
              AND s.class_id='".$classId."' 
              AND c.candidate_status=1";
$candRes = $Con->query($candQry);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>View Candidates</title>
</head>
<body>
<h2 align="center"><?php echo $electionRow['election_name']?></h2>
<p align="center"><?php echo $electionRow['election_description']?></p>
<p align="center">From: <?php echo $electionRow['election_date']?> - To: <?php echo $electionRow['election_todate']?></p>

<h3 align="center">Candidates</h3>
<table border="1" cellpadding="10" align="center">
  <tr>
    <th>Sl.No</th>
    <th>Photo</th>
    <th>Student Name</th>
    <th>Applied Date</th>
    <th>Action</th>
  </tr>
  <?php
  $i=0;
  while($row=$candRes->fetch_assoc()) {
      $i++;
      ?>
      <tr>
        <td><?php echo $i; ?></td>
        <td><img src="../Assets/Files/Student/Photo/<?php echo $row['student_photo']; ?>" width="70" height="70"></td>
        <td><?php echo $row['student_name']; ?></td>
        <td><?php echo $row['candidate_date']; ?></td>
        <td>
          <?php 
          if ($today <= $electionRow['election_todate']) { 
              echo '<a href="ViewCandidates.php?eid='.$electionId.'&vote='.$row['candidate_id'].'">Vote</a>';
          } else {
              echo "Closed";
          }
          ?>
        </td>
      </tr>
      <?php
  }
  ?>
</table>
</body>
</html>
