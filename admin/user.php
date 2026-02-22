<?php
include "header.php";
include "../conn.php";
if (!isset($_SESSION["admin"])) { ?>
    <script>window.location = "../login.php";</script>
<?php } ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
        * { font-family: 'Poppins', sans-serif; }
        body { background: linear-gradient(135deg,#0f0c29,#302b63,#24243e); min-height: 100vh; color: white; }
        .glass { background: rgba(255,255,255,0.07); backdrop-filter: blur(14px); border: 1px solid rgba(255,255,255,0.12); }
    </style>
</head>
<body class="pb-12">
<div class="max-w-7xl mx-auto px-4 pt-10">
    <h2 class="text-xl font-bold text-indigo-300 mb-6">&#128101; All Users</h2>
    <div class="glass rounded-2xl overflow-x-auto shadow-xl">
        <table class="w-full text-sm text-white">
            <thead>
                <tr class="bg-indigo-900/60 text-indigo-300 uppercase text-xs">
                    <th class="px-4 py-3 text-left">ID</th>
                    <th class="px-4 py-3 text-left">First Name</th>
                    <th class="px-4 py-3 text-left">Last Name</th>
                    <th class="px-4 py-3 text-left">Email</th>
                    <th class="px-4 py-3 text-left">Contact</th>
                    <th class="px-4 py-3 text-left">Gender</th>
                    <th class="px-4 py-3 text-left">Username</th>
                    <th class="px-4 py-3 text-left">Password</th>
                    <th class="px-4 py-3 text-left">Delete</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $count = 0;
            $data = mysqli_query($con, "select * from user_data");
            while ($row = mysqli_fetch_array($data)) {
                $count++;
                $uid = $row["user_id"];
                $pwd = htmlspecialchars($row["password"]);
                ?>
                <tr class="border-t border-white/10 hover:bg-white/5 transition">
                    <td class="px-4 py-3 text-indigo-300"><?php echo $count; ?></td>
                    <td class="px-4 py-3 font-medium"><?php echo $row["firstname"]; ?></td>
                    <td class="px-4 py-3"><?php echo $row["lastname"]; ?></td>
                    <td class="px-4 py-3 text-indigo-300"><?php echo $row["email"]; ?></td>
                    <td class="px-4 py-3"><?php echo $row["contact_no"]; ?></td>
                    <td class="px-4 py-3 capitalize"><?php echo $row["gender"]; ?></td>
                    <td class="px-4 py-3 font-medium"><?php echo $row["username"]; ?></td>
                    <td class="px-4 py-3">
                        <span
                            class="pwd-cell cursor-pointer select-none inline-flex items-center gap-1 px-2 py-1 rounded-lg bg-white/5 hover:bg-white/15 transition group"
                            data-pwd="<?php echo $pwd; ?>"
                            data-visible="false"
                            onclick="togglePassword(this)"
                            title="Click to reveal password">
                            <span class="pwd-display text-yellow-300 tracking-widest">&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;</span>
                            <span class="text-indigo-400 text-xs group-hover:text-indigo-200 transition">&#128065;</span>
                        </span>
                    </td>
                    <td class="px-4 py-3">
                        <a href="delete_user.php?id=<?php echo $uid; ?>"
                            onclick="return confirm('Are you sure you want to delete this user?');"
                            class="px-3 py-1.5 rounded-lg bg-red-700/50 hover:bg-red-600 text-red-200 text-xs font-medium transition">
                            Delete
                        </a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    function togglePassword(el) {
        const display = el.querySelector('.pwd-display');
        const isVisible = el.dataset.visible === 'true';
        if (isVisible) {
            display.innerHTML = '&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;';
            display.classList.remove('text-green-300');
            display.classList.add('text-yellow-300', 'tracking-widest');
            el.dataset.visible = 'false';
            el.title = 'Click to reveal password';
        } else {
            display.textContent = el.dataset.pwd;
            display.classList.remove('text-yellow-300', 'tracking-widest');
            display.classList.add('text-green-300');
            el.dataset.visible = 'true';
            el.title = 'Click to hide password';
        }
    }
</script>
</body>
</html>