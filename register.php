<?php
include "conn.php";
$firstnm = ""; $lastnm = ""; $email = ""; $con_no = ""; $gender = ""; $uname = ""; $pass = "";
$firstnm_er = ""; $lastnm_er = ""; $email_er = ""; $con_no_er = ""; $gender_er = ""; $uname_er = ""; $pass_er = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstnm = $_POST['firstname'];
    $lastnm = $_POST['lastname'];
    $email = $_POST['email'];
    $con_no = $_POST['contect_no'];
    $gender = $_POST['r1'];
    $uname = $_POST['username'];
    $pass = $_POST['password'];

    if (empty($firstnm)) { $firstnm_er = "*Firstname is required"; }
    else { $firstnm = trim(htmlspecialchars($firstnm)); if (!preg_match("/^[a-zA-Z ]+$/", $firstnm)) $firstnm_er = "*Firstname should only contain letters and space"; }

    if (empty($lastnm)) { $lastnm_er = "*Lastname is required"; }
    else { $lastnm = trim(htmlspecialchars($lastnm)); if (!preg_match("/^[a-zA-Z ]+$/", $lastnm)) $lastnm_er = "*Lastname should only contain letters and space"; }

    if (empty($email)) { $email_er = "*Email is required"; }
    else { if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $email_er = "*Invalid email"; }

    if (empty($con_no)) { $con_no_er = "*Mobile number is required"; }
    else { if (!preg_match("/^[0-9]{10}$/", $con_no)) $con_no_er = "*It should be 10 digits"; }

    if (empty($gender)) {
        if ($gender === 'male') { $image = 'male.png'; }
        elseif ($gender === 'female') { $image = 'female.png'; }
        else { $gender_er = "Select any one"; }
    }

    if (empty($uname)) { $uname_er = "Name is required"; }
    else { $uname = trim(htmlspecialchars($uname)); if (!preg_match("/^[a-zA-Z0-9]{3,20}$/", $uname)) $uname_er = "*Name should only contain letters and numbers"; }

    if (empty($pass)) { $pass_er = "*password is required"; }
    else { if (strlen($pass) <= 8) $pass_er = "*At least 8 digits"; }

    if (empty($firstnm_er) && empty($lastnm_er) && empty($email_er) && empty($con_no_er) && empty($gender_er) && empty($uname_er) && empty($pass_er)) {
        $check = mysqli_query($con, "select * from user_data where username='$_POST[username]'");
        if (mysqli_num_rows($check) > 0) {
            echo "<script>alert('you are Already register')</script>";
        } else {
            mysqli_query($con, "insert into user_data(user_id,firstname,lastname,email,contact_no,gender,username,password) values(null,'$firstnm','$lastnm','$email',$con_no,'$gender','$uname','$pass')") or die(mysqli_error($con));
            echo "<script>alert('register successfully'); window.location = 'login.php';</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - QuizMaster</title>
    <link rel="shortcut icon" type="x-icon" href="img/quiz_time.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
        body { font-family: 'Poppins', sans-serif; }
        .glass { background: rgba(255,255,255,0.10); backdrop-filter: blur(16px); border: 1px solid rgba(255,255,255,0.18); }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-900 via-purple-900 to-blue-900 py-8">
    <div class="w-full max-w-lg px-4">
        <div class="glass rounded-2xl shadow-2xl p-8">
            <div class="flex flex-col items-center mb-6">
                <img src="img/quiz_time.png" alt="QuizMaster" class="h-14 w-14 mb-2 drop-shadow-lg">
                <h1 class="text-3xl font-bold text-white tracking-wide">Register</h1>
                <p class="text-indigo-300 text-sm mt-1">Create your QuizMaster account</p>
            </div>
            <form action="" method="POST" class="space-y-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-indigo-200 text-sm font-medium mb-1">First Name</label>
                        <input type="text" name="firstname" placeholder="First Name" autocomplete="off"
                            value="<?php echo htmlspecialchars($firstnm); ?>"
                            class="w-full px-4 py-2.5 rounded-xl bg-white/10 text-white placeholder-indigo-300 border border-white/20 focus:outline-none focus:ring-2 focus:ring-indigo-400 transition">
                        <?php if($firstnm_er): ?><span class="text-red-400 text-xs"><?php echo $firstnm_er; ?></span><?php endif; ?>
                    </div>
                    <div>
                        <label class="block text-indigo-200 text-sm font-medium mb-1">Last Name</label>
                        <input type="text" name="lastname" placeholder="Last Name" autocomplete="off"
                            value="<?php echo htmlspecialchars($lastnm); ?>"
                            class="w-full px-4 py-2.5 rounded-xl bg-white/10 text-white placeholder-indigo-300 border border-white/20 focus:outline-none focus:ring-2 focus:ring-indigo-400 transition">
                        <?php if($lastnm_er): ?><span class="text-red-400 text-xs"><?php echo $lastnm_er; ?></span><?php endif; ?>
                    </div>
                </div>
                <div>
                    <label class="block text-indigo-200 text-sm font-medium mb-1">Email</label>
                    <input type="email" name="email" placeholder="Enter Email" autocomplete="off"
                        value="<?php echo htmlspecialchars($email); ?>"
                        class="w-full px-4 py-2.5 rounded-xl bg-white/10 text-white placeholder-indigo-300 border border-white/20 focus:outline-none focus:ring-2 focus:ring-indigo-400 transition">
                    <?php if($email_er): ?><span class="text-red-400 text-xs"><?php echo $email_er; ?></span><?php endif; ?>
                </div>
                <div>
                    <label class="block text-indigo-200 text-sm font-medium mb-1">Contact No.</label>
                    <input type="number" name="contect_no" placeholder="10-digit Mobile Number" autocomplete="off"
                        value="<?php echo htmlspecialchars($con_no); ?>"
                        class="w-full px-4 py-2.5 rounded-xl bg-white/10 text-white placeholder-indigo-300 border border-white/20 focus:outline-none focus:ring-2 focus:ring-indigo-400 transition">
                    <?php if($con_no_er): ?><span class="text-red-400 text-xs"><?php echo $con_no_er; ?></span><?php endif; ?>
                </div>
                <div>
                    <label class="block text-indigo-200 text-sm font-medium mb-2">Gender</label>
                    <div class="flex gap-6">
                        <label class="flex items-center gap-2 text-indigo-200 cursor-pointer">
                            <input type="radio" name="r1" value="male" checked class="accent-indigo-400 w-4 h-4">
                            Male
                        </label>
                        <label class="flex items-center gap-2 text-indigo-200 cursor-pointer">
                            <input type="radio" name="r1" value="female" class="accent-indigo-400 w-4 h-4">
                            Female
                        </label>
                    </div>
                    <?php if($gender_er): ?><span class="text-red-400 text-xs"><?php echo $gender_er; ?></span><?php endif; ?>
                </div>
                <div>
                    <label class="block text-indigo-200 text-sm font-medium mb-1">Username</label>
                    <input type="text" name="username" placeholder="Choose a Username" autocomplete="off"
                        value="<?php echo htmlspecialchars($uname); ?>"
                        class="w-full px-4 py-2.5 rounded-xl bg-white/10 text-white placeholder-indigo-300 border border-white/20 focus:outline-none focus:ring-2 focus:ring-indigo-400 transition">
                    <?php if($uname_er): ?><span class="text-red-400 text-xs"><?php echo $uname_er; ?></span><?php endif; ?>
                </div>
                <div>
                    <label class="block text-indigo-200 text-sm font-medium mb-1">Password</label>
                    <input type="password" name="password" id="ps" placeholder="Create Password" autocomplete="off"
                        value="<?php echo htmlspecialchars($pass); ?>"
                        class="w-full px-4 py-2.5 rounded-xl bg-white/10 text-white placeholder-indigo-300 border border-white/20 focus:outline-none focus:ring-2 focus:ring-indigo-400 transition">
                    <?php if($pass_er): ?><span class="text-red-400 text-xs"><?php echo $pass_er; ?></span><?php endif; ?>
                </div>
                <div class="flex items-center gap-2">
                    <input type="checkbox" class="accent-indigo-400 w-4 h-4 cursor-pointer" onclick="showpass()">
                    <label class="text-indigo-300 text-sm cursor-pointer" onclick="showpass()">Show password</label>
                </div>
                <button type="submit" name="submit"
                    class="w-full py-3 rounded-xl bg-indigo-500 hover:bg-indigo-400 text-white font-semibold text-lg shadow-lg transition-all duration-200 hover:scale-[1.02] active:scale-95">
                    Create Account
                </button>
                <p class="text-center text-indigo-300 text-sm">Already have an account?
                    <a href="login.php" class="text-white font-semibold hover:underline">Sign In</a>
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