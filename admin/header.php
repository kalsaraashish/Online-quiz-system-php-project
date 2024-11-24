<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="shortcut icon" type="x-icon" href="../img/quiz_time.png">
    <link rel="stylesheet" href="../css/header.css">
</head>

<body>
    <header>
        <div class="nav-logo">
            <img src="../img/quiz_time.png" alt="" class="nav-logo">
        </div>
        <nav>

            <ul>
                <li><a href="dashboard.php" class="a">Home</a></li>
                <li><a href="user.php" class="a">User</a></li>
                <li><a href="add_exam.php" class="a">Add Exam</a></li>
                <li><a href="add_question.php" class="a">Add Questions</a></li>
                <li><a href="../logout.php" class="a">Log out</a></li>
            </ul>
        </nav>
    </header>
</body>

</html>