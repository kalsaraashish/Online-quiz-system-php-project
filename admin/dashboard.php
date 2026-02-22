<?php
include("../conn.php");
include("header.php");
if (!isset($_SESSION["admin"])) { ?>
    <script>window.location = "../login.php";</script>
<?php } ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
        * { font-family: 'Poppins', sans-serif; }
        body { background: linear-gradient(135deg,#0f0c29,#302b63,#24243e); min-height: 100vh; color: white; }
        .glass { background: rgba(255,255,255,0.07); backdrop-filter: blur(14px); border: 1px solid rgba(255,255,255,0.12); }
    </style>
</head>
<body class="pb-12">
<?php
$data = mysqli_query($con, "select * from user_data");
$user_data = mysqli_num_rows($data);
$category = mysqli_query($con, "select * from exam_category");
$category_data = mysqli_num_rows($category);
?>

<div class="max-w-6xl mx-auto px-4 pt-10">

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-10">
        <div class="glass rounded-2xl p-8 flex items-center gap-6 shadow-xl">
            <div class="text-5xl">👥</div>
            <div>
                <div class="text-4xl font-extrabold text-indigo-300"><?php echo $user_data; ?></div>
                <div class="text-indigo-200 text-sm mt-1">Total Users</div>
            </div>
        </div>
        <div class="glass rounded-2xl p-8 flex items-center gap-6 shadow-xl">
            <div class="text-5xl">📋</div>
            <div>
                <div class="text-4xl font-extrabold text-indigo-300"><?php echo $category_data; ?></div>
                <div class="text-indigo-200 text-sm mt-1">Total Quizzes</div>
            </div>
        </div>
    </div>

    <!-- All Result Data -->
    <h2 class="text-xl font-bold text-indigo-300 mb-4">📊 All Result Data</h2>
    <div class="glass rounded-2xl overflow-x-auto shadow-xl mb-10">
        <table class="w-full text-sm text-white">
            <thead>
                <tr class="bg-indigo-900/60 text-indigo-300 uppercase text-xs">
                    <th class="px-4 py-3 text-left">No.</th>
                    <th class="px-4 py-3 text-left">Username</th>
                    <th class="px-4 py-3 text-left">Quiz Name</th>
                    <th class="px-4 py-3 text-left">Total Q</th>
                    <th class="px-4 py-3 text-left">Correct</th>
                    <th class="px-4 py-3 text-left">Wrong</th>
                    <th class="px-4 py-3 text-left">Date</th>
                </tr>
            </thead>
            <tbody>
            <?php $count = 0;
            $result_data = mysqli_query($con, "select * from result");
            while ($row = mysqli_fetch_array($result_data)) {
                $count++; ?>
                <tr class="border-t border-white/10 hover:bg-white/5 transition">
                    <td class="px-4 py-3"><?php echo $count; ?></td>
                    <td class="px-4 py-3 font-medium"><?php echo $row['username']; ?></td>
                    <td class="px-4 py-3"><?php echo $row['exam_type']; ?></td>
                    <td class="px-4 py-3"><?php echo $row['total_question']; ?></td>
                    <td class="px-4 py-3 text-green-400 font-semibold"><?php echo $row['correct_answer']; ?></td>
                    <td class="px-4 py-3 text-red-400 font-semibold"><?php echo $row['wrong_answer']; ?></td>
                    <td class="px-4 py-3 text-indigo-300"><?php echo $row['exam_date']; ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- User Feedback -->
    <h2 class="text-xl font-bold text-indigo-300 mb-4">💬 User Feedback</h2>
    <div class="glass rounded-2xl overflow-x-auto shadow-xl">
        <table class="w-full text-sm text-white">
            <thead>
                <tr class="bg-indigo-900/60 text-indigo-300 uppercase text-xs">
                    <th class="px-4 py-3 text-left">No.</th>
                    <th class="px-4 py-3 text-left">Username</th>
                    <th class="px-4 py-3 text-left">Name</th>
                    <th class="px-4 py-3 text-left">Email</th>
                    <th class="px-4 py-3 text-left">Message</th>
                </tr>
            </thead>
            <tbody>
            <?php $count = 0;
            $feedback_data = mysqli_query($con, "select * from user_feedback");
            while ($row = mysqli_fetch_array($feedback_data)) {
                $count++; ?>
                <tr class="border-t border-white/10 hover:bg-white/5 transition">
                    <td class="px-4 py-3"><?php echo $count; ?></td>
                    <td class="px-4 py-3 font-medium"><?php echo $row['user_name']; ?></td>
                    <td class="px-4 py-3"><?php echo $row['name']; ?></td>
                    <td class="px-4 py-3 text-indigo-300"><?php echo $row['email']; ?></td>
                    <td class="px-4 py-3"><?php echo $row['message']; ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>