<?php
include("../conn.php");
include("header.php");
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
    <title>Dashboard</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <?php
    $data = mysqli_query($con, "select * from user_data");
    $user_data = mysqli_num_rows($data);
    $category = mysqli_query($con, "select * from exam_category");
    $category_data = mysqli_num_rows($category);
    ?>
    <div class="info flex-center">
        <div class="user flex-colum">
            <h2><?php echo $user_data; ?></h2>Total user
        </div>
        <div class="quiz flex-colum">
            <h2><?php echo $category_data; ?></h2>Total quiz
        </div>
    </div>
    <h2 class="result-h2">all result data</h2>
    <div class="result">
        <?php $count = 0;
        $result_data = mysqli_query($con, "select * from result");
        ?>
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>user name</th>
                    <th>quiz name</th>
                    <th>total Questions</th>
                    <th>correct</th>
                    <th>wrong</th>
                    <th>date</th>
                </tr>
            </thead>
            <?php
            while ($row = mysqli_fetch_array($result_data)) {
                $count++;
                ?>
                <tbody>
                    <tr>
                        <td><?php echo $count; ?></td>
                        <td><?php echo $row['username']; ?></td>
                        <td><?php echo $row['exam_type']; ?></td>
                        <td><?php echo $row['total_question']; ?></td>
                        <td><?php echo $row['correct_answer']; ?></td>
                        <td><?php echo $row['wrong_answer']; ?></td>
                        <td><?php echo $row['exam_date']; ?></td>
                    </tr>
                </tbody>
                <?php
            }
            ?>
        </table>
    </div>
    <h2 class="result-h2">user feedback</h2>
    <div class="feedback flex-colum">
        <?php $count = 0;
        $feedback_data = mysqli_query($con, "select * from user_feedback");
        ?>
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>user name</th>
                    <th>name</th>
                    <th>email</th>
                    <th>Message</th>
                </tr>
            </thead>
            <?php
            while ($row = mysqli_fetch_array($feedback_data)) {
                $count++;
                ?>
                <tbody>
                    <tr>
                        <td><?php echo $count; ?></td>
                        <td><?php echo $row['user_name']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['message']; ?></td>
                    </tr>
                </tbody>
                <?php
            }
            ?>
        </table>
    </div>

</body>

</html>