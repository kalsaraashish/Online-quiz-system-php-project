<?php
include("../conn.php");
$id = $_GET["id"];
$catid = $_GET["catid"];
mysqli_query($con, "delete from questions where id=$id");
?>

<script>
    window.location = "view_questions.php?id=<?php echo $catid ?>";
</script>