<!-- this page is delete exam category from add_exam.php -->

<?php
include("../conn.php");
$id = $_GET["id"];
mysqli_query($con, "delete from exam_category where id=$id");
?>
<script>
    window.location = "add_exam.php";
</script>