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
$exam_category = '';
$check = mysqli_query($con, "select * from exam_category where id=$id");
while ($row = mysqli_fetch_array($check)) {
    $exam_category = $row["category"];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add edit questions</title>
    <link rel="stylesheet" href="../css/add_edit_quesions.css">
</head>

<body>
    <div class="h1">
        <h1>Add questions inside :- <?php echo $exam_category; ?> </h1>
        <div><a href="add_question.php"><img src="../img/arrow.png" alt="arrow" class="arrow"></a></div>
    </div>
    <div class="main">
        <div>
            <form method="POST">
                <?php
                $fix_value = 1;
                $fix = mysqli_query($con, "select * from questions where category='$exam_category'");
                $fix_value += mysqli_num_rows($fix);
                ?>
                <label class="label">Add question <?php echo $fix_value; ?>:</label>
                <div>
                    <input type="text" name="question" placeholder="Enter question" autocomplete="off" required>
                </div>
                <label class="label">Option 1</label>
                <div>
                    <input type="text" name="opt1" placeholder="Enter Option 1" autocomplete="off" required>
                </div>
                <label class="label">Option 2</label>
                <div>
                    <input type="text" name="opt2" placeholder="Enter Option 2" autocomplete="off" required>
                </div>
                <label class="label">Option 3</label>
                <div>
                    <input type="text" name="opt3" placeholder="Enter Option 3" autocomplete="off" required>
                </div>
                <label class="label">Option 4</label>
                <div>
                    <input type="text" name="opt4" placeholder="Enter Option 4" autocomplete="off" required>
                </div>
                <label class="label">Answer</label>
                <div>
                    <input type="text" name="answer" placeholder="Enter Answer" autocomplete="off" required>
                </div>
                <div>
                    <input type="Submit" class="btn" name="submit" value="Add questions">
                </div>
            </form>
        </div>
    </div>
</body>

</html>
<?php
if (isset($_POST["submit"])) {
    $loop = 0;
    $count = 0;

    if ($fix_value <= 20) {
        $asc = mysqli_query($con, "select * from questions where category='$exam_category' order by id asc");
        $count = mysqli_num_rows($asc);
        if ($count != 0) {
            while ($row = mysqli_fetch_array($asc)) {
                $loop++;
                mysqli_query($con, "update questions set question_no='$loop' where id='$row[id]'");
            }
        }
        $loop++;
        mysqli_query($con, "insert into questions values(NULL,'$loop','$_POST[question]','$_POST[opt1]','$_POST[opt2]','$_POST[opt3]','$_POST[opt4]','$_POST[answer]','$exam_category')");
        ?>
        <script>
            alert("Question <?php echo $fix_value; ?> added successfully.");
            window.location.href = window.location.href;
        </script>
        <?php
    } else {
        ?>
        <script>
            alert("Maximum of 20 questions reached.");
        </script>
        <?php
    }
}
?>