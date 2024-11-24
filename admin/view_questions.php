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
    <title>view questions</title>
    <link rel="stylesheet" href="../css/add_edit_quesions.css">
</head>

<body>
    <div class="h1">
        <h1>View questions inside :- <?php echo $exam_category; ?> </h1>
        <div><a href="add_question.php"><img src="../img/arrow.png" alt="arrow" class="arrow"></a></div>
    </div>
    <div class="tb">
        <table>
            <tr>
                <th>No</th>
                <th>Questions</th>
                <th>Opt1</th>
                <th>Opt2</th>
                <th>Opt3</th>
                <th>Opt4</th>
                <th>Answer</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <?php
            $check = mysqli_query($con, "select * from questions where category='$exam_category'");
            while ($row = mysqli_fetch_array($check)) {
                ?>
                <tr>
                    <td><?php echo $row["question_no"]; ?></td>
                    <td><?php echo $row["question"]; ?></td>
                    <td><?php echo $row["opt1"]; ?></td>
                    <td><?php echo $row["opt2"]; ?></td>
                    <td><?php echo $row["opt3"]; ?></td>
                    <td><?php echo $row["opt4"]; ?></td>
                    <td><?php echo $row["answer"]; ?></td>
                    <td class="edit-btn"><a
                            href="edit_option.php?id=<?php echo $row["id"]; ?>&catid=<?php echo $id ?>">Edit</a></td>
                    <td class="delete-btn"><a href="delete_option.php?id=<?php echo $row["id"]; ?>&catid=<?php echo $id ?>"
                            onclick="return confirm('Are you sure you want to Delete this data?');">Delete</a></td>
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
if (isset($_POST["submit"])) {
    $loop = 0;
    $count = 0;
    $asc = mysqli_query($con, "select * from questions where category='$exam_category' order by id asc");
    $count = mysqli_num_rows($asc);
    if ($count == 0) {

    } else {
        while ($row = mysqli_fetch_array($asc)) {
            $loop++;
            mysqli_query($con, "update questions set question_no='$loop' where id='$row[id]'");
        }
    }
    $loop++;
    mysqli_query($con, "insert into questions values(NULL,'$loop','$_POST[question]','$_POST[opt1]','$_POST[opt2]','$_POST[opt3]','$_POST[opt4]','$_POST[answer]','$exam_category')");
    ?>
    <script>
        window.location.href = window.location.href;
    </script>
    <?php
}
?>