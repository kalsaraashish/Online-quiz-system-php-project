<!-- this page displays quiz categories and lets admin select one to add questions -->
<?php
include "../conn.php";
include "header.php";
if (!isset($_SESSION["admin"])) { ?>
    <script>window.location = "../login.php";</script>
<?php } ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Question</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
        * { font-family: 'Poppins', sans-serif; }
        body { background: linear-gradient(135deg,#0f0c29,#302b63,#24243e); min-height: 100vh; color: white; }
        .glass { background: rgba(255,255,255,0.07); backdrop-filter: blur(14px); border: 1px solid rgba(255,255,255,0.12); }
    </style>
</head>
<body class="pb-12">
<div class="max-w-5xl mx-auto px-4 pt-10">
    <div class="glass rounded-2xl overflow-x-auto shadow-xl">
        <div class="px-6 py-5 border-b border-white/10 flex items-center justify-between">
            <h2 class="text-xl font-bold text-indigo-300">❓ Manage Questions</h2>
            <span class="text-xs text-yellow-300 bg-yellow-900/40 px-3 py-1.5 rounded-full">⚠️ Max 20 questions per quiz</span>
        </div>
        <table class="w-full text-sm text-white">
            <thead>
                <tr class="bg-indigo-900/60 text-indigo-300 uppercase text-xs">
                    <th class="px-4 py-3 text-left">ID</th>
                    <th class="px-4 py-3 text-left">Quiz Name</th>
                    <th class="px-4 py-3 text-left">Time (min)</th>
                    <th class="px-4 py-3 text-left">Add Questions</th>
                    <th class="px-4 py-3 text-left">View Questions</th>
                </tr>
            </thead>
            <tbody>
            <?php $count = 0;
            $data = mysqli_query($con, "select * from exam_category");
            while ($row = mysqli_fetch_array($data)) {
                $count++; ?>
                <tr class="border-t border-white/10 hover:bg-white/5 transition">
                    <td class="px-4 py-3"><?php echo $count; ?></td>
                    <td class="px-4 py-3 font-medium"><?php echo $row["category"]; ?></td>
                    <td class="px-4 py-3 text-indigo-300"><?php echo $row["exam_time"]; ?></td>
                    <td class="px-4 py-3">
                        <a href="add_edit_questions.php?id=<?php echo $row["id"]; ?>"
                            class="px-3 py-1.5 rounded-lg bg-green-700/50 hover:bg-green-600 text-green-200 text-xs font-medium transition">
                            ➕ Add Question
                        </a>
                    </td>
                    <td class="px-4 py-3">
                        <a href="view_questions.php?id=<?php echo $row["id"]; ?>"
                            class="px-3 py-1.5 rounded-lg bg-blue-700/50 hover:bg-blue-600 text-blue-200 text-xs font-medium transition">
                            👁️ View Questions
                        </a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
<?php
if (isset($_POST["add"])) {
    mysqli_query($con, "insert into exam_category values(NULL,'$_POST[quizname]','$_POST[quiztime]')");
    echo "<script>window.location = 'add_exam.php';</script>";
}
?>