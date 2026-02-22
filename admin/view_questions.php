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
    <title>View Questions</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
        * { font-family: 'Poppins', sans-serif; }
        body { background: linear-gradient(135deg,#0f0c29,#302b63,#24243e); min-height: 100vh; color: white; }
        .glass { background: rgba(255,255,255,0.07); backdrop-filter: blur(14px); border: 1px solid rgba(255,255,255,0.12); }
    </style>
</head>
<body class="pb-12">
<div class="max-w-6xl mx-auto px-4 pt-10">

    <!-- Title Bar -->
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-xl font-bold text-indigo-300">
            👁️ Questions — <span class="text-white"><?php echo $exam_category; ?></span>
        </h1>
        <a href="add_question.php" class="px-4 py-2 rounded-xl bg-indigo-800/50 hover:bg-indigo-700 text-indigo-200 text-sm font-medium transition">
            ← Back
        </a>
    </div>

    <!-- Table -->
    <div class="glass rounded-2xl overflow-x-auto shadow-xl">
        <table class="w-full text-sm text-white">
            <thead>
                <tr class="bg-indigo-900/60 text-indigo-300 uppercase text-xs">
                    <th class="px-3 py-3 text-left">No</th>
                    <th class="px-3 py-3 text-left">Question</th>
                    <th class="px-2 py-2 text-left">Opt 1</th>
                    <th class="px-2 py-2 text-left">Opt 2</th>
                    <th class="px-2 py-2 text-left">Opt 3</th>
                    <th class="px-2 py-2 text-left">Opt 4</th>
                    <th class="px-2 py-2 text-left">Answer</th>
                    <th class="px-3 py-3 text-left">Edit</th>
                    <th class="px-3 py-3 text-left">Delete</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $check = mysqli_query($con, "select * from questions where category='$exam_category'");
            while ($row = mysqli_fetch_array($check)): ?>
                <tr class="border-t border-white/10 hover:bg-white/5 transition">
                    <td class="px-3 py-3 text-indigo-300"><?php echo $row["question_no"]; ?></td>
                    <td class="px-3 py-3 max-w-xs"><?php echo $row["question"]; ?></td>
                    <td class="px-3 py-3 text-indigo-200"><?php echo $row["opt1"]; ?></td>
                    <td class="px-3 py-3 text-indigo-200"><?php echo $row["opt2"]; ?></td>
                    <td class="px-3 py-3 text-indigo-200"><?php echo $row["opt3"]; ?></td>
                    <td class="px-3 py-3 text-indigo-200"><?php echo $row["opt4"]; ?></td>
                    <td class="px-3 py-3 text-green-400 font-semibold"><?php echo $row["answer"]; ?></td>
                    <td class="px-3 py-3">
                        <a href="edit_option.php?id=<?php echo $row["id"]; ?>&catid=<?php echo $id ?>"
                            class="px-3 py-1.5 rounded-lg bg-blue-700/50 hover:bg-blue-600 text-blue-200 text-xs font-medium transition">
                            ✏️ Edit
                        </a>
                    </td>
                    <td class="px-3 py-3">
                        <a href="delete_option.php?id=<?php echo $row["id"]; ?>&catid=<?php echo $id ?>"
                            onclick="return confirm('Are you sure you want to delete this question?');"
                            class="px-3 py-1.5 rounded-lg bg-red-700/50 hover:bg-red-600 text-red-200 text-xs font-medium transition">
                            🗑️ Delete
                        </a>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
<?php
if (isset($_POST["submit"])) {
    $loop = 0;
    $count = 0;
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
    echo "<script>window.location.href = window.location.href;</script>";
}
?>