<!-- this page is use to add quiz category and display category -->
<?php
include "header.php";
if (!isset($_SESSION["admin"])) {
    ?>
    <script>
        window.location = "../login.php";
    </script>
    <?php
}
include "../conn.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add exam</title>
    <link rel="stylesheet" href="../css/add_exam.css">
</head>

<body>
    <div class="main-div">
        <div class="set-form">
            <form action="" method="POST" enctype="multipart/form-data">
                <div><label for="formGroupExampleInput">Quiz Name :</label></div>
                <input type="text" name="quizname" placeholder="Enter Quiz name" required>

                <div><label for="formGroupExampleInput2">Quiz Time (in Minutes) :</label></div>
                <input type="text" name="quiztime" placeholder="Enter Quiz time" name="quiz_time" required>
                <input type="file" name="quiz_img" id="">
                <div><input class="btn" type="submit" value="submit" name="add"></div>
            </form>
        </div>
        <div class="tb">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Quiz name</th>
                    <th>Quiz time</th>
                    <th>Edit</th>
                    <th>Delete</th>
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
                        <td class="edit-btn"><a href="edit_exam.php?id=<?php echo $row["id"]; ?>">Edit</a></td>
                        <td class="delete-btn"><a href="delete_exam.php?id=<?php echo $row["id"]; ?>"
                                onclick="return confirm('Are you sure you want to update this data?');">Delete</a></td>
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
    $quiz_name = $_POST['quizname'];
    $quiz_time = $_POST['quiztime'];

    $filename = $_FILES["quiz_img"]["name"];
    $tmp = $_FILES["quiz_img"]["tmp_name"];

    $folder = "images/" . $filename;
    $location = "../images/" . $filename;

    $default = "images/quiz_time.png";

    move_uploaded_file($tmp, $location);

    if ($folder == "images/") {
        $folder = $default;
    }
    $count = 0;
    $check = mysqli_query($con, "select * from exam_category where category='$quiz_name'");
    $count = mysqli_num_rows($check);
    if ($count > 0) {
        echo "<script>
                alert('Already register category');
                
            </script>";
    } else {
        mysqli_query($con, "insert into exam_category values(NULL,'$quiz_name','$quiz_time','$folder')");
        ?>
        <script>
            window.location = "add_exam.php";
        </script>
        <?php
    }
}
?>