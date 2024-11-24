<!-- this page is display quiz category and click to select to add question -->
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add question</title>
    <link rel="stylesheet" href="../css/add_exam.css">
</head>

<body>
    <div class="main-div">
        <div class="tb">
            <div>
                <h2>Note: only add 20 questions</h2>
            </div>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Quiz name</th>
                    <th>Quiz time</th>
                    <th>Add Questions</th>
                    <th>Veiw Questions</th>
                </tr>
                <?php
                $count = 0;
                $data = mysqli_query($con, "select * from exam_category");
                while ($row = mysqli_fetch_array($data)) {
                    $count++;
                    ?>
                    <tr>
                        <td><?php echo $count; ?></td>
                        <td><?php echo $row["category"] ?></td>
                        <td><?php echo $row["exam_time"] ?></td>
                        <td class="qu-btn"><a href="add_edit_questions.php?id=<?php echo $row["id"]; ?>">Add Question</a>
                        </td>
                        <td class="qu-btn"><a href="view_questions.php?id=<?php echo $row["id"]; ?>">view Question</a></td>
                    </tr>
                    <?php
                }
                ?>
            </table>
        </div>
    </div>
</body>


</html>
<?php
if (isset($_POST["add"])) {
    mysqli_query($con, "insert into exam_category values(NULL,'$_POST[quizname]','$_POST[quiztime]')");
    ?>
    <script>
        window.location = "add_exam.php";
    </script>
    <?php
}
?>