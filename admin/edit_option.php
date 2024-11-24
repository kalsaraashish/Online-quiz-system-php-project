<!-- this page is Update the question and redirect to add_edit_question.php -->
<?php
include("header.php");
include("../conn.php");
if (!isset($_SESSION["admin"])) {
    ?>
    <script>
        window.location = "../login.php";
    </script>
    <?php
}
$id = $_GET["id"];
$catid = $_GET["catid"];
$exam_category = '';
$check_cat = mysqli_query($con, "select * from exam_category where id=$catid");
while ($row1 = mysqli_fetch_array($check_cat)) {
    $exam_category = $row1["category"];
}
$question = "";
$opt1 = "";
$opt2 = "";
$opt3 = "";
$opt4 = "";
$answer = "";
$check = mysqli_query($con, "select * from questions where id=$id");
while ($row = mysqli_fetch_array($check)) {
    $question = $row["question"];
    $opt1 = $row["opt1"];
    $opt2 = $row["opt2"];
    $opt3 = $row["opt3"];
    $opt4 = $row["opt4"];
    $answer = $row["answer"];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit option</title>
    <link rel="stylesheet" href="../css/add_edit_quesions.css">
</head>

<body>
    <div class="h1">
        <h1>Update questions inside :- <?php echo $exam_category; ?> </h1>
        <div><a href="add_question.php"><img src="../img/arrow.png" alt="arrow" class="arrow"></a></div>
    </div>
    <div class="main">
        <div>
            <form method="POST">
                <label class="label">Question :</label>
                <div>
                    <input type="text" name="question" placeholder="Enter question" value="<?php echo $question; ?>"
                        required>
                </div>
                <label class="label">Option 1</label>
                <div>
                    <input type="text" name="opt1" placeholder="Enter Option 1" value="<?php echo $opt1; ?>" required>
                </div>
                <label class="label">Option 2</label>
                <div>
                    <input type="text" name="opt2" placeholder="Enter Option 2" value="<?php echo $opt2; ?>" required>
                </div>
                <label class="label">Option 3</label>
                <div>
                    <input type="text" name="opt3" placeholder="Enter Option 3" value="<?php echo $opt3; ?>" required>
                </div>
                <label class="label">Option 4</label>
                <div>
                    <input type="text" name="opt4" placeholder="Enter Option 4" value="<?php echo $opt4; ?>" required>
                </div>
                <label class="label">Answer</label>
                <div>
                    <input type="text" name="answer" placeholder="Enter Answer" value="<?php echo $answer; ?>" required>
                </div>
                <div>
                    <input type="Submit" class="btn" name="submit" value="Update question">
                </div>
            </form>
        </div>
</body>

</html>
<?php
if (isset($_POST["submit"])) {
    mysqli_query($con, "update questions set question='$_POST[question]',opt1='$_POST[opt1]',opt2='$_POST[opt2]',opt3='$_POST[opt3]',opt4='$_POST[opt4]',answer='$_POST[answer]' where id=$id");
    ?>
    <script>
        alert("Question Updated");
        window.location = "view_questions.php?id=<?php echo $catid ?>";
    </script>
    <?php
}
?>