<?php
// session_start();
include("conn.php");
if (!isset($_SESSION["username"])) { ?>
    <script>window.location = "login.php";</script>
<?php }
$userdata = mysqli_query($con, "select * from user_data where username='$_SESSION[username]';");
$data = mysqli_fetch_array($userdata);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="shortcut icon" type="x-icon" href="img/quiz_time.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');
        body { font-family: 'Poppins', sans-serif; }
        .glass { background: rgba(30,27,75,0.9); backdrop-filter: blur(14px); border-bottom: 1px solid rgba(255,255,255,0.1); }
        #tm { font-size: 1.5rem; font-weight: 700; color: #f87171; text-align: center; padding: 8px 0; background: rgba(30,27,75,0.7); letter-spacing: 2px; }
    </style>
</head>
<body>
    <header class="glass sticky top-0 z-50 px-4 sm:px-8 py-3 flex items-center justify-between shadow-xl" style="animation:none;">
        <div class="flex items-center gap-3">
            <img src="img/quiz_time.png" alt="QuizMaster" class="h-10 w-10">
            <span class="font-bold text-lg text-indigo-300 hidden sm:inline">QuizMaster</span>
        </div>
        <nav class="flex items-center gap-4">
            <h2 class="text-white font-semibold text-sm sm:text-base">
                📝 <span class="text-indigo-300"><?php echo $_SESSION['exam_category']; ?></span> Quiz
            </h2>
            <img src="<?php echo ($data['gender']=='male') ? 'images/male.png' : 'images/female.png'; ?>"
                alt="User" class="h-10 w-10 rounded-full border-2 border-indigo-400 object-cover shadow">
        </nav>
    </header>
    <div id="tm" class="timer"></div>
</body>
<script>
    let submenu = document.getElementById("sub-menu");
    function open_menu() { submenu && submenu.classList.toggle("open"); }
</script>
<script type="text/javascript">
    setInterval(function () {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "forajax/load_timer.php", false);
        xmlhttp.send(null);
        document.getElementById("tm").innerHTML = "⏱ " + xmlhttp.responseText;
        if (xmlhttp.responseText == "00:00:01") {
            window.location = "result.php";
        }
    }, 1000);
</script>
</html>