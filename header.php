<?php
session_start();
if (!isset($_SESSION["username"])) { ?>
    <script>window.location = "login.php";</script>
<?php }
include("conn.php");
$userdata = mysqli_query($con, "select * from user_data where username='$_SESSION[username]';");
$data = mysqli_fetch_array($userdata);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');
        body { font-family: 'Poppins', sans-serif; }
        .glass { background: rgba(30,27,75,0.85); backdrop-filter: blur(14px); border-bottom: 1px solid rgba(255,255,255,0.1); }
    </style>
</head>
<body>
    <header class="glass sticky top-0 z-50 px-4 sm:px-8 py-3 flex items-center justify-between shadow-xl" style="animation:none;">
        <div class="flex items-center gap-3">
            <a href="home.php">
            <img src="img/quiz_time.png" alt="QuizMaster" class="h-10 w-10 rounded-lg">
            </a>
            <span class="font-bold text-lg text-indigo-300 hidden sm:inline">QuizMaster</span>
        </div>
        <nav>
            <img src="<?php echo ($data['gender']=='male') ? 'images/male.png' : 'images/female.png'; ?>"
                alt="User" class="h-10 w-10 rounded-full border-2 border-indigo-400 object-cover cursor-pointer shadow">
        </nav>
    </header>
</body>
<script>
    let submenu = document.getElementById("sub-menu");
    function open_menu() { submenu && submenu.classList.toggle("open"); }
</script>
</html>