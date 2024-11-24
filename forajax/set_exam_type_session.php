<?php
session_start();
$id = $_GET["id"];
include("../conn.php");
$exam_time = "";

$check = mysqli_query($con, "select * from exam_category where id=$id");
while ($row = mysqli_fetch_array($check)) {
    $exam_time = $row["exam_time"];
    $_SESSION['exam_category'] = $row["category"];
}
$_SESSION["exam_time"] = $exam_time;
$_SESSION["start_time"] = date("Y-m-d H:i:s");
$end_time = $_SESSION["end_time"] = date("Y-m-d H:i:s", strtotime('+' . $_SESSION["exam_time"] . 'minutes', strtotime($_SESSION["start_time"])));
$_SESSION["end_time"] = $end_time;
$_SESSION["exam_start"] = "yes";
?>
<script>
    window.location = "../deshbord.php";
</script>