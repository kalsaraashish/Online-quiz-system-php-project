<!-- this page updates the question and redirects to view_questions.php -->
<?php
include("header.php");
include("../conn.php");
if (!isset($_SESSION["admin"])) { ?>
    <script>window.location = "../login.php";</script>
<?php }
$id = $_GET["id"];
$catid = $_GET["catid"];
$exam_category = '';
$check_cat = mysqli_query($con, "select * from exam_category where id=$catid");
while ($row1 = mysqli_fetch_array($check_cat)) {
    $exam_category = $row1["category"];
}
$question = $opt1 = $opt2 = $opt3 = $opt4 = $answer = "";
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
    <title>Edit Question</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
        * { font-family: 'Poppins', sans-serif; }
        body { background: linear-gradient(135deg,#0f0c29,#302b63,#24243e); min-height: 100vh; color: white; }
        .glass { background: rgba(255,255,255,0.07); backdrop-filter: blur(14px); border: 1px solid rgba(255,255,255,0.12); }
    </style>
</head>
<body class="pb-12">
<div class="max-w-2xl mx-auto px-4 pt-10">

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-xl font-bold text-indigo-300">
            ✏️ Edit Question — <span class="text-white"><?php echo $exam_category; ?></span>
        </h1>
        <a href="add_question.php" class="px-4 py-2 rounded-xl bg-indigo-800/50 hover:bg-indigo-700 text-indigo-200 text-sm font-medium transition">← Back</a>
    </div>

    <div class="glass rounded-2xl p-8 shadow-xl">
        <form method="POST" class="space-y-4">
            <?php
            $fields = [
                ['question', 'Question', $question],
                ['opt1', 'Option 1', $opt1],
                ['opt2', 'Option 2', $opt2],
                ['opt3', 'Option 3', $opt3],
                ['opt4', 'Option 4', $opt4],
                ['answer', 'Correct Answer', $answer],
            ];
            foreach ($fields as [$name, $label, $val]): ?>
            <div>
                <label class="block text-indigo-200 text-sm font-medium mb-1"><?php echo $label; ?></label>
                <input type="text" name="<?php echo $name; ?>" value="<?php echo $val; ?>" required
                    class="w-full px-4 py-2.5 rounded-xl bg-white/10 text-white border border-white/20 focus:outline-none focus:ring-2 focus:ring-indigo-400 transition <?php echo $name==='answer' ? 'border-green-500/50' : ''; ?>">
            </div>
            <?php endforeach; ?>
            <button type="submit" name="submit"
                class="w-full py-3 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white font-semibold shadow-lg transition-all hover:scale-[1.02] mt-2">
                Update Question
            </button>
        </form>
    </div>
</div>
</body>
</html>
<?php
if (isset($_POST["submit"])) {
    mysqli_query($con, "update questions set question='$_POST[question]',opt1='$_POST[opt1]',opt2='$_POST[opt2]',opt3='$_POST[opt3]',opt4='$_POST[opt4]',answer='$_POST[answer]' where id=$id");
    echo "<script>alert('Question Updated'); window.location = 'view_questions.php?id=$catid';</script>";
}
?>