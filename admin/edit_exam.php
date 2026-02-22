<!-- this page updates category and redirects to add_exam.php -->
<?php
include "../conn.php";
include "header.php";
if (!isset($_SESSION["admin"])) { ?>
    <script>window.location = "../login.php";</script>
<?php }
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
    <title>Edit Exam</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
        * { font-family: 'Poppins', sans-serif; }
        body { background: linear-gradient(135deg,#0f0c29,#302b63,#24243e); min-height: 100vh; color: white; }
        .glass { background: rgba(255,255,255,0.07); backdrop-filter: blur(14px); border: 1px solid rgba(255,255,255,0.12); }
    </style>
</head>
<body class="pb-12">
<div class="max-w-lg mx-auto px-4 pt-10">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-xl font-bold text-indigo-300">✏️ Update Quiz</h1>
        <a href="add_exam.php" class="px-4 py-2 rounded-xl bg-indigo-800/50 hover:bg-indigo-700 text-indigo-200 text-sm font-medium transition">← Back</a>
    </div>
    <div class="glass rounded-2xl p-8 shadow-xl">
        <form action="" method="POST" class="space-y-5">
            <div>
                <label class="block text-indigo-200 text-sm font-medium mb-1">Quiz Name</label>
                <input type="text" name="quizname" placeholder="Enter Quiz name"
                    value="<?php echo $quiz_name; ?>" required
                    class="w-full px-4 py-2.5 rounded-xl bg-white/10 text-white placeholder-indigo-400 border border-white/20 focus:outline-none focus:ring-2 focus:ring-indigo-400 transition">
            </div>
            <div>
                <label class="block text-indigo-200 text-sm font-medium mb-1">Quiz Time (in Minutes)</label>
                <input type="text" name="quiztime" placeholder="Enter Quiz time"
                    value="<?php echo $quiz_time; ?>" required
                    class="w-full px-4 py-2.5 rounded-xl bg-white/10 text-white placeholder-indigo-400 border border-white/20 focus:outline-none focus:ring-2 focus:ring-indigo-400 transition">
            </div>
            <button type="submit" name="add"
                class="w-full py-3 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white font-semibold shadow-lg transition-all hover:scale-[1.02]">
                Update Quiz
            </button>
        </form>
    </div>
</div>
</body>
</html>
<?php
if (isset($_POST["add"])) {
    mysqli_query($con, "update exam_category set category='$_POST[quizname]',exam_time='$_POST[quiztime]' where id=$id");
    echo "<script>window.location.href = 'add_exam.php';</script>";
}
?>