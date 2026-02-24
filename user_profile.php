<?php
session_start();
if (!isset($_SESSION["username"])) { ?>
    <script>window.location = "login.php";</script>
<?php }
include("conn.php");
$userdata = mysqli_query($con, "select * from user_data where user_id=$_SESSION[user_id];");
$data = mysqli_fetch_array($userdata);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile - QuizMaster</title>
    <link rel="shortcut icon" type="x-icon" href="img/quiz_time.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
        body { font-family: 'Poppins', sans-serif; background: linear-gradient(135deg,#1e1b4b,#312e81,#1e40af); min-height: 100vh; }
        .glass { background: rgba(255,255,255,0.08); backdrop-filter: blur(14px); border: 1px solid rgba(255,255,255,0.15); }
        .sub-menu { display: none; position: absolute; right: 0; top: 60px; min-width: 220px; z-index: 100; }
        .sub-menu.open { display: block; }
    </style>
</head>
<body class="text-white min-h-screen">

    <!-- HEADER -->
    <header class="glass sticky top-0 z-50 px-4 sm:px-8 py-3 flex items-center justify-between shadow-xl">
        <div class="flex items-center gap-3">
            <a href="home.php">
                <img src="img/quiz_time.png" alt="QuizMaster" class="h-10 w-10 rounded-lg">
                </a>
                <span class="font-bold text-lg text-indigo-300 hidden sm:inline">QuizMaster</span>
            
        </div>
        <nav class="flex items-center gap-3 sm:gap-6">
            <a href="home.php" class="text-indigo-200 hover:text-white font-medium transition hidden md:inline">Home</a>
            <a href="home.php#About_Us" class="text-indigo-200 hover:text-white font-medium transition hidden md:inline">About Us</a>
            <a href="home.php#Message_Us" class="text-indigo-200 hover:text-white font-medium transition hidden md:inline">Message Us</a>
            <div class="relative">
                <img src="<?php echo ($data['gender']=='male') ? 'images/male.png' : 'images/female.png'; ?>"
                    alt="User" class="h-10 w-10 rounded-full border-2 border-indigo-400 cursor-pointer object-cover shadow"
                    onclick="open_menu()">
                <div class="sub-menu glass rounded-xl shadow-2xl p-4" id="sub-menu">
                    <div class="flex items-center gap-3 mb-3">
                        <img src="<?php echo ($data['gender']=='male') ? 'images/male.png' : 'images/female.png'; ?>"
                            class="h-10 w-10 rounded-full border border-indigo-400 object-cover" alt="User">
                        <div>
                            <p class="text-xs text-indigo-300">Hello,</p>
                            <p class="font-semibold text-white"><?php echo $_SESSION["username"]; ?></p>
                        </div>
                    </div>
                    <hr class="border-white/20 mb-3">
                    <a href="user_profile.php" class="flex items-center gap-2 text-indigo-200 hover:text-white py-1.5 rounded-lg hover:bg-white/10 px-2 transition">
                        <img src="img/profile.png" class="h-5 w-5" alt=""> Edit Profile
                    </a>
                    <a href="logout.php" class="flex items-center gap-2 text-indigo-200 hover:text-white py-1.5 rounded-lg hover:bg-white/10 px-2 transition mt-1">
                        <img src="img/logout.png" class="h-5 w-5" alt=""> Log Out
                    </a>
                </div>
            </div>
        </nav>
    </header>

    <!-- PROFILE CARD -->
    <div class="max-w-lg mx-auto px-4 py-12">
        <div class="glass rounded-2xl shadow-2xl p-8">
            <div class="flex flex-col items-center mb-6">
                <img src="<?php echo ($data['gender']=='male') ? 'images/male.png' : 'images/female.png'; ?>"
                    alt="User" class="h-24 w-24 rounded-full border-4 border-indigo-400 object-cover shadow-lg mb-4">
                <h2 class="text-2xl font-bold text-white"><?php echo $data['firstname'].' '.$data['lastname']; ?></h2>
                <span class="text-indigo-300 text-sm">@<?php echo $data['username']; ?></span>
            </div>

            <div class="space-y-3">
                <?php
                $fields = [
                    ['First Name', $data['firstname']],
                    ['Last Name', $data['lastname']],
                    ['Email', $data['email']],
                    ['Contact No.', $data['contact_no']],
                    ['Gender', ucfirst($data['gender'])],
                    ['Username', $data['username']],
                    ['Password', '●●●●●●●●'],
                ];
                foreach ($fields as [$label, $val]): ?>
                <div class="flex items-center justify-between py-3 border-b border-white/10">
                    <span class="text-indigo-300 text-sm font-medium w-32"><?php echo $label; ?></span>
                    <span class="text-white font-medium text-sm text-right"><?php echo $val; ?></span>
                </div>
                <?php endforeach; ?>
            </div>

            <form action="" class="mt-8">
                <button type="submit" name="submit"
                    class="w-full py-3 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white font-semibold shadow-lg transition-all hover:scale-[1.02]">
                    ✏️ Edit Profile
                </button>
            </form>
        </div>
    </div>

    <script>
        let submenu = document.getElementById("sub-menu");
        function open_menu() { submenu.classList.toggle("open"); }
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.relative')) submenu.classList.remove('open');
        });
    </script>
</body>
</html>
<?php
if (isset($_GET['submit'])) {
    echo "<script>window.location = 'update_profile.php';</script>";
}
?>