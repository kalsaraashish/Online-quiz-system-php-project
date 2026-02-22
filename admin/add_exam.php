<!-- this page is use to add quiz category and display category -->
<?php
include "header.php";
if (!isset($_SESSION["admin"])) { ?>
    <script>window.location = "../login.php";</script>
<?php }
include "../conn.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Exam</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
        * { font-family: 'Poppins', sans-serif; }
        body { background: linear-gradient(135deg,#0f0c29,#302b63,#24243e); min-height: 100vh; color: white; }
        .glass { background: rgba(255,255,255,0.07); backdrop-filter: blur(14px); border: 1px solid rgba(255,255,255,0.12); }
    </style>
</head>
<body class="pb-12">
<div class="max-w-4xl mx-auto px-4 pt-10">

    <!-- Add Form -->
    <div class="glass rounded-2xl p-8 shadow-xl mb-10">
        <h2 class="text-xl font-bold text-indigo-300 mb-6">➕ Add New Quiz</h2>
        <form action="" method="POST" enctype="multipart/form-data" class="space-y-4">
            <div>
                <label class="block text-indigo-200 text-sm font-medium mb-1">Quiz Name</label>
                <input type="text" name="quizname" placeholder="Enter Quiz name" required
                    class="w-full px-4 py-2.5 rounded-xl bg-white/10 text-white placeholder-indigo-400 border border-white/20 focus:outline-none focus:ring-2 focus:ring-indigo-400 transition">
            </div>
            <div>
                <label class="block text-indigo-200 text-sm font-medium mb-1">Quiz Time (in Minutes)</label>
                <input type="text" name="quiztime" placeholder="Enter Quiz time" required
                    class="w-full px-4 py-2.5 rounded-xl bg-white/10 text-white placeholder-indigo-400 border border-white/20 focus:outline-none focus:ring-2 focus:ring-indigo-400 transition">
            </div>
            <div>
                <label class="block text-indigo-200 text-sm font-medium mb-1">Quiz Image</label>
                <input type="file" name="quiz_img"
                    class="w-full text-indigo-300 text-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-indigo-700 file:text-white hover:file:bg-indigo-600 cursor-pointer">
            </div>
            <button type="submit" name="add"
                class="w-full py-3 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white font-semibold shadow-lg transition-all hover:scale-[1.02]">
                Add Quiz
            </button>
        </form>
    </div>

    <!-- Table -->
    <h2 class="text-xl font-bold text-indigo-300 mb-4">📋 All Quizzes</h2>
    <div class="glass rounded-2xl overflow-x-auto shadow-xl">
        <table class="w-full text-sm text-white">
            <thead>
                <tr class="bg-indigo-900/60 text-indigo-300 uppercase text-xs">
                    <th class="px-4 py-3 text-left">ID</th>
                    <th class="px-4 py-3 text-left">Quiz Name</th>
                    <th class="px-4 py-3 text-left">Time (min)</th>
                    <th class="px-4 py-3 text-left">Edit</th>
                    <th class="px-4 py-3 text-left">Delete</th>
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
                        <a href="edit_exam.php?id=<?php echo $row["id"]; ?>"
                            class="px-3 py-1.5 rounded-lg bg-blue-700/50 hover:bg-blue-600 text-blue-200 text-xs font-medium transition">
                            ✏️ Edit
                        </a>
                    </td>
                    <td class="px-4 py-3">
                        <a href="delete_exam.php?id=<?php echo $row["id"]; ?>"
                            onclick="return confirm('Are you sure you want to delete this quiz?');"
                            class="px-3 py-1.5 rounded-lg bg-red-700/50 hover:bg-red-600 text-red-200 text-xs font-medium transition">
                            🗑️ Delete
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
    $quiz_name = $_POST['quizname'];
    $quiz_time = $_POST['quiztime'];
    $filename = $_FILES["quiz_img"]["name"];
    $tmp = $_FILES["quiz_img"]["tmp_name"];
    $folder = "images/" . $filename;
    $location = "../images/" . $filename;
    $default = "images/quiz_time.png";
    move_uploaded_file($tmp, $location);
    if ($folder == "images/") { $folder = $default; }
    $count = 0;
    $check = mysqli_query($con, "select * from exam_category where category='$quiz_name'");
    $count = mysqli_num_rows($check);
    if ($count > 0) {
        echo "<script>alert('Already register category');</script>";
    } else {
        mysqli_query($con, "insert into exam_category values(NULL,'$quiz_name','$quiz_time','$folder')");
        echo "<script>window.location = 'add_exam.php';</script>";
    }
}
?>