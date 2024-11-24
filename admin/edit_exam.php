<!-- this page is uapdate category and redirect add_exam.php data -->
<?php
include "../conn.php";
include "header.php";
if (!isset($_SESSION["admin"])) {
    ?>
    <script>
        window.location = "../login.php";
    </script>
    <?php
}
$id = $_GET["id"];
$check = mysqli_query($con, "select * from exam_category where id=$id");
while ($row = mysqli_fetch_array($check)) {
    $quiz_name = $row["category"];
    $quiz_time = $row["exam_time"];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit exam</title>
    <link rel="stylesheet" href="../css/add_exam.css">
</head>

<body>

    <div class="h1">
        <h1>Update data</h>
    </div>
    <div class="main-div">
        <div class="set-form">

            <form action="" method="POST">

                <div><label for="formGroupExampleInput">Quiz Name :</label></div>
                <input type="text" class="in" name="quizname" placeholder="Enter Quiz name"
                    value="<?php echo $quiz_name; ?>" required>

                <div><label for="formGroupExampleInput2">Quiz Time :</label></div>
                <input type="text" class="in" name="quiztime" placeholder="Enter Quiz time" name="quiz_time"
                    value="<?php echo $quiz_time; ?>" required>

                <div><input class="btn" type="submit" value="update" name="add"></div>
            </form>
        </div>

    </div>
</body>

</html>
<?php
if (isset($_POST["add"])) {
    mysqli_query($con, "update exam_category set category='$_POST[quizname]',exam_time='$_POST[quiztime]' where id=$id");
    echo "<script>
        window.location.href = 'add_exam.php';
    </script>";
}
?>