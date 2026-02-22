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
        $check = mysqli_query($con, "SELECT * FROM questions WHERE category='$_SESSION[exam_category]' AND question_no=$i");
        $row = mysqli_fetch_array($check);
        $correct_answer = $row["answer"];
        if (isset($_SESSION["answer"][$i])) {
            if ($correct_answer == $_SESSION["answer"][$i]) $correct++;
            else $wrong++;
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

$pct = $count > 0 ? round(($correct/$count)*100) : 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Result - QuizMaster</title>
    <link rel="shortcut icon" type="x-icon" href="img/quiz_time.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap');
        body { font-family: 'Poppins', sans-serif; background: linear-gradient(135deg,#1e1b4b,#312e81,#1e40af); min-height: 100vh; }
        .glass { background: rgba(255,255,255,0.08); backdrop-filter: blur(14px); border: 1px solid rgba(255,255,255,0.15); }
        .correct-answer { color: #4ade80; background: rgba(74,222,128,0.1); border-radius: 8px; padding: 6px 12px; }
        .wrong-answer   { color: #f87171; background: rgba(248,113,113,0.1); border-radius: 8px; padding: 6px 12px; }
    </style>
</head>
<body class="text-white py-10 px-4">

    <!-- Score Summary -->
    <div class="max-w-2xl mx-auto mb-10">
        <div class="glass rounded-2xl p-8 shadow-2xl text-center">
            <div class="text-6xl font-extrabold text-indigo-300 mb-1"><?php echo $pct; ?>%</div>
            <p class="text-indigo-200 mb-6 text-sm">Your Score</p>
            <div class="grid grid-cols-3 gap-4 mb-8">
                <div class="glass rounded-xl p-4">
                    <div class="text-2xl font-bold text-white"><?php echo $count; ?></div>
                    <div class="text-indigo-300 text-xs mt-1">Total</div>
                </div>
                <div class="glass rounded-xl p-4">
                    <div class="text-2xl font-bold text-green-400"><?php echo $correct; ?></div>
                    <div class="text-green-300 text-xs mt-1">Correct ✓</div>
                </div>
                <div class="glass rounded-xl p-4">
                    <div class="text-2xl font-bold text-red-400"><?php echo $wrong; ?></div>
                    <div class="text-red-300 text-xs mt-1">Wrong ✗</div>
                </div>
            </div>
            <form method="post">
                <button type="submit" name="homepage"
                    class="px-8 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white font-semibold shadow-lg transition-all hover:scale-[1.02]">
                    🏠 Go to Home
                </button>
            </form>
        </div>
    </div>

    <!-- Answer Review -->
    <div class="max-w-2xl mx-auto space-y-6">
        <?php if (isset($_SESSION['answer'])): ?>
        <h2 class="text-xl font-bold text-indigo-300 text-center">Review Your Answers</h2>
        <?php for ($j = 1; $j <= sizeof($_SESSION['answer']); $j++):
            $check = mysqli_query($con, "SELECT * FROM questions WHERE category='$_SESSION[exam_category]' AND question_no=$j");
            $row = mysqli_fetch_array($check);
            $correct_answer = $row["answer"];
            $user_answer = isset($_SESSION["answer"][$j]) ? $_SESSION["answer"][$j] : null;
        ?>
        <div class="glass rounded-2xl p-6 shadow-xl">
            <p class="font-semibold text-white mb-4">Q<?php echo $j; ?>: <?php echo $row['question']; ?></p>
            <div class="space-y-2">
                <?php for ($k = 1; $k <= 4; $k++):
                    $option = $row["opt".$k];
                    $is_correct = ($option == $correct_answer);
                    $is_user = ($option == $user_answer);
                ?>
                <div class="px-4 py-2 rounded-xl text-sm <?php
                    if ($is_user && $is_correct) echo 'correct-answer';
                    elseif ($is_user && !$is_correct) echo 'wrong-answer';
                    elseif ($is_correct) echo 'correct-answer';
                    else echo 'text-indigo-200';
                ?>">
                    <?php echo $option; ?>
                    <?php if ($is_user && $is_correct) echo ' <span class="text-xs ml-2 font-bold">(Your answer ✓)</span>';
                          elseif ($is_user && !$is_correct) echo ' <span class="text-xs ml-2 font-bold">(Your answer ✗)</span>';
                          elseif ($is_correct) echo ' <span class="text-xs ml-2 font-bold">(Correct)</span>'; ?>
                </div>
                <?php endfor; ?>
            </div>
        </div>
        <?php endfor; ?>
        <?php endif; ?>
    </div>
</body>
</html>
<?php
if (isset($_POST['homepage'])) {
    echo "<script>window.location='home.php';</script>";
    unset($_SESSION["answer"]);
}
?>