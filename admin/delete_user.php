<!-- it use to delete user -->
<?php
include("../conn.php");
$id = $_GET["id"];
$delete = "DELETE FROM `user_data` WHERE user_id=$id";
$d = mysqli_query($con, $delete);
if ($d) {
    $delete1 = "DELETE FROM `result` WHERE user_id=$id";
    $d2 = mysqli_query($con, $delete1);
    ?>
    <script>
        alert("user delete");
        window.location = "user.php";
    </script>
    <?php
} else {
    echo "error";
}
?>