<?php
include "../conn.php";
include "header.php";
if (!isset($_SESSION["admin"])) { ?>
    <script>window.location = "../login.php";</script>
<?php }
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
    <title>Add Questions</title>
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

    <!-- Title Bar -->
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-xl font-bold text-indigo-300">
            ➕ Add questions — <span class="text-white"><?php echo $exam_category; ?></span>
        </h1>
        <a href="add_question.php" class="px-4 py-2 rounded-xl bg-indigo-800/50 hover:bg-indigo-700 text-indigo-200 text-sm font-medium transition flex items-center gap-2">
            ← Back
        </a>
    </div>

    <!-- Form -->
    <div class="glass rounded-2xl p-8 shadow-xl">
        <form method="POST" class="space-y-4">
            <?php
            $fix_value = 1;
            $fix = mysqli_query($con, "select * from questions where category='$exam_category'");
            $fix_value += mysqli_num_rows($fix);
            ?>
            <div class="bg-indigo-900/40 rounded-xl px-4 py-2 mb-2">
                <span class="text-indigo-300 text-sm font-medium">Adding Question #<?php echo $fix_value; ?></span>
            </div>

            <?php
            $fields = [
                ['question', 'Question', 'Enter the question'],
                ['opt1', 'Option 1', 'Enter Option 1'],
                ['opt2', 'Option 2', 'Enter Option 2'],
                ['opt3', 'Option 3', 'Enter Option 3'],
                ['opt4', 'Option 4', 'Enter Option 4'],
                ['answer', 'Correct Answer', 'Enter the correct answer'],
            ];
            foreach ($fields as [$name, $label, $placeholder]): ?>
            <div>
                <label class="block text-indigo-200 text-sm font-medium mb-1"><?php echo $label; ?></label>
                <input type="text" name="<?php echo $name; ?>" placeholder="<?php echo $placeholder; ?>" autocomplete="off" required
                    class="w-full px-4 py-2.5 rounded-xl bg-white/10 text-white placeholder-indigo-400 border border-white/20 focus:outline-none focus:ring-2 focus:ring-indigo-400 transition <?php echo $name==='answer' ? 'border-green-500/50' : ''; ?>">
            </div>
            <?php endforeach; ?>

            <button type="submit" name="submit"
                class="w-full py-3 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white font-semibold shadow-lg transition-all hover:scale-[1.02] mt-2">
                Add Question
            </button>
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
        echo "<script>alert('Question $fix_value added successfully.'); window.location.href = window.location.href;</script>";
    } else {
        echo "<script>alert('Maximum of 20 questions reached.');</script>";
    }
}
?>