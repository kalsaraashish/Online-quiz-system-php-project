<?php
include "conn.php";
session_start();
$uname = "";
$pass = "";
$uname_er = "";
$pass_er = "";

if (isset($_POST["submit"])) {
    $uname = $_POST['username'];
    $pass = $_POST['password'];

    if (empty($uname)) {
        $uname_er = "*Name is required";
    } else {
        $uname = trim($uname);
        $uname = htmlspecialchars($uname);
        if (!preg_match("/^[a-zA-Z0-9]{3,20}$/", $uname)) {
            $uname_er = "*Name should only contain letters and numbers";
        }
    }

    if (empty($pass)) {
        $pass_er = "*password is required";
    } else {
        if (strlen($pass) <= 8) {
            $pass_er = "*At least 8 digits";
        }
    }

    if (empty($uname_er) && empty($pass_er)) {
        $user_data = mysqli_query($con, "select * from user_data where username='$uname' && password='$pass'");
        $admin_data = mysqli_query($con, "select * from admin_data where username='$uname' && password='$pass'");
        $check_user = mysqli_num_rows($user_data);
        $check_admin = mysqli_num_rows($admin_data);
        $user_fetch = mysqli_fetch_array($user_data);

        if ($check_user > 0) {
            $_SESSION["username"] = $uname;
            $_SESSION["user_id"] = $user_fetch[0];
            echo "<Script>window.location = 'home.php';</Script>";
        } elseif ($check_admin > 0) {
            $_SESSION["admin"] = $uname;
            echo "<Script>window.location = 'admin/dashboard.php';</Script>";
        } else {
            echo "<script>alert('you are not register');</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - QuizMaster</title>
    <link rel="shortcut icon" type="x-icon" href="img/quiz_time.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
        body { font-family: 'Poppins', sans-serif; }
        .glass { background: rgba(255,255,255,0.10); backdrop-filter: blur(16px); border: 1px solid rgba(255,255,255,0.18); }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-900 via-purple-900 to-blue-900">
    <div class="w-full max-w-md px-4">
        <div class="glass rounded-2xl shadow-2xl p-8">
            <div class="flex flex-col items-center mb-8">
                <img src="img/quiz_time.png" alt="QuizMaster" class="h-16 w-16 mb-3 drop-shadow-lg rounded-lg">
                <h1 class="text-3xl font-bold text-white tracking-wide">Sign In</h1>
                <p class="text-indigo-300 text-sm mt-1">Welcome back to QuizMaster!</p>
            </div>
            <form method="post" class="space-y-5">
                <div>
                    <label class="block text-indigo-200 text-sm font-medium mb-1">Username</label>
                    <input type="text" name="username" placeholder="Enter Username" autocomplete="off"
                        value="<?php echo htmlspecialchars($uname); ?>"
                        class="w-full px-4 py-3 rounded-xl bg-white/10 text-white placeholder-indigo-300 border border-white/20 focus:outline-none focus:ring-2 focus:ring-indigo-400 transition">
                    <?php if($uname_er): ?><span class="text-red-400 text-xs mt-1 block"><?php echo $uname_er; ?></span><?php endif; ?>
                </div>
                <div>
                    <label class="block text-indigo-200 text-sm font-medium mb-1">Password</label>
                    <input type="password" name="password" id="ps" placeholder="Enter Password" autocomplete="off"
                        value="<?php echo htmlspecialchars($pass); ?>"
                        class="w-full px-4 py-3 rounded-xl bg-white/10 text-white placeholder-indigo-300 border border-white/20 focus:outline-none focus:ring-2 focus:ring-indigo-400 transition">
                    <?php if($pass_er): ?><span class="text-red-400 text-xs mt-1 block"><?php echo $pass_er; ?></span><?php endif; ?>
                </div>
                <div class="flex items-center gap-2">
                    <input type="checkbox" class="accent-indigo-400 w-4 h-4 cursor-pointer" onclick="showpass()">
                    <label class="text-indigo-300 text-sm cursor-pointer" onclick="showpass()">Show password</label>
                </div>
                <button type="submit" name="submit"
                    class="w-full py-3 rounded-xl bg-indigo-500 hover:bg-indigo-400 text-white font-semibold text-lg shadow-lg transition-all duration-200 hover:scale-[1.02] active:scale-95">
                    Sign In
                </button>
                <p class="text-center text-indigo-300 text-sm">Don't have an account?
                    <a href="register.php" class="text-white font-semibold hover:underline">Register</a>
                </p>
            </form>
        </div>
    </div>
    <script>
        function showpass() {
            var show = document.getElementById('ps');
            show.type = show.type === 'password' ? 'text' : 'password';
        }
    </script>
</body>
</html>