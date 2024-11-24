<?php
session_start();
include "../conn.php";
$total_que = 0;
$check = mysqli_query($con, "select * from questions where category='$_SESSION[exam_category]'");
$total_que = mysqli_num_rows($check);
echo $total_que;
?>