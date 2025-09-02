<?php
include("../Assets/Connection/Connection.php");
session_start();

$studentSel = "SELECT * FROM tbl_student WHERE student_id='".$_SESSION['sid']."'";
$studentRes = $Con->query($studentSel);
$studentRow = $studentRes->fetch_assoc();
$studentId  = $studentRow['student_id'];

$electionId = $_GET['eid'];

if (isset($_POST['btn_apply'])) {
    // Insert candidate record
    $insQry = "INSERT INTO tbl_classcandidate (candinate_status, student_id, election_id, candinate_date) 
               VALUES ('0', '".$studentId."', '".$electionId."', CURDATE())";
    if ($Con->query($insQry)) {
        ?>
        <script>
        alert("Applied Successfully as Class Candidate");
        window.location="ElectionDetails.php?eid=<?php echo $electionId ?>";
        </script>
        <?php
    }
}

$electionSel = "SELECT * FROM tbl_election WHERE election_id='".$electionId."'";
$electionRes = $Con->query($electionSel);
$electionRow = $electionRes->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Election Details</title>
</head>
<body>
<h2 align="center"><?php echo $electionRow['election_name']?></h2>
<p align="center"><?php echo $electionRow['election_description']?></p>
<p align="center">From: <?php echo $electionRow['election_date']?> - To: <?php echo $electionRow['election_todate']?></p>

<h3 align="center">Apply as Class Candidate</h3>
<form id="form1" name="form1" method="post" action="">
  <table border="1" cellpadding="10" align="center">
    <tr>
      <td colspan="2" align="center">
        <input type="submit" name="btn_apply" value="Apply as Candidate" />
      </td>
    </tr>
  </table>
</form>
</body>
</html>
