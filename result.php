<?php
include "header.php";
include "conn.php";


if (!isset($_SESSION["username"])) {
    echo '<script>window.location = "login.php";</script>';
}

$date = date("Y-m-d H:i:s");
$_SESSION["end_time"] = date("Y-m-d H:i:s", strtotime($date . "+ $_SESSION[exam_time] minutes"));

$correct = 0;
$wrong = 0;

if (isset($_SESSION['answer'])) {
    for ($i = 1; $i <= sizeof($_SESSION['answer']); $i++) {
        $answer = "";
        $check = mysqli_query($con, "SELECT * FROM questions WHERE category='$_SESSION[exam_category]' AND question_no=$i");
        $row = mysqli_fetch_array($check);
        $correct_answer = $row["answer"];

        if (isset($_SESSION["answer"][$i])) {
            if ($correct_answer == $_SESSION["answer"][$i]) {
                $correct++;
            } else {
                $wrong++;
            }
        } else {
            $wrong++; 
        }
    }
}

$count = mysqli_num_rows(mysqli_query($con, "SELECT * FROM questions WHERE category='$_SESSION[exam_category]'"));
$wrong = $count - $correct;

if (isset($_SESSION["exam_start"])) {
    $date = date("Y-m-d");
    mysqli_query($con, "INSERT INTO result(result_id, user_id, username, exam_type, total_question, correct_answer, wrong_answer, exam_date) 
                        VALUES (NULL, $_SESSION[user_id], '$_SESSION[username]', '$_SESSION[exam_category]', '$count', '$correct', '$wrong', '$date')");
    unset($_SESSION["exam_start"]);
    echo "<script>window.location.href=window.location.href;</script>";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Result</title>
    <link rel="shortcut icon" type="x-icon" href="img/quiz_time.png">
    <link rel="stylesheet" href="css/result.css">
</head>

<body>
    <div class="result-data">
        <center>
            <table>
                <tr>
                    <th class="total">Total Questions :</th>
                    <td><?php echo $count; ?></td>
                </tr>
                <tr>
                    <th class="correct">Correct Answers :</th>
                    <td><?php echo $correct; ?></td>
                </tr>
                <tr>
                    <th class="wrong">Wrong Answers :</th>
                    <td><?php echo $wrong; ?></td>
                </tr>
            </table>
            <form method="post">
                <h3>Try a new quiz... <input type="submit" name="homepage" value="Go to Home"></input></h3>
            </form>
        </center>
    </div>
    <div class="answers-review">
        <?php
        if (isset($_SESSION['answer'])) {
            ?>
            <h2>Review Your Answers</h2>
            <?php
            for ($j = 1; $j <= sizeof($_SESSION['answer']); $j++) {
                $check = mysqli_query($con, "SELECT * FROM questions WHERE category='$_SESSION[exam_category]' AND question_no=$j");
                $row = mysqli_fetch_array($check);
                $correct_answer = $row["answer"];
                if (isset($_SESSION["answer"][$j])) {
                    $user_answer = $_SESSION["answer"][$j];
                } else {
                    $user_answer = null;
                }
                echo "<div class='question-review'>";
                echo "<p><strong>Question $j: </strong>" . $row['question'] . "</p>";

                for ($k = 1; $k <= 4; $k++) {
                    $option = $row["opt" . $k];
                    $is_correct = ($option == $correct_answer);
                    $is_user_answer = ($option == $user_answer);

                    echo "<p";
                    if ($is_user_answer && $is_correct) {
                        echo " class='correct-answer'>Your answer: $option (Correct)";
                    } elseif ($is_user_answer && !$is_correct) {
                        echo " class='wrong-answer'>Your answer: $option (Wrong)";
                    } elseif ($is_correct) {
                        echo " class='correct-answer'>Correct answer: $option";
                    } else {
                        echo ">$option";
                    }
                    echo "</p>";
                }
                echo "</div>";
            }
        }
        ?>
    </div>
</html>

<?php

if (isset($_POST['homepage'])) {
    echo "<script>window.location='home.php';</script>";
    unset($_SESSION["answer"]);
}
?>