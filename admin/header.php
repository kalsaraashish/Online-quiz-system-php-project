<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="shortcut icon" type="x-icon" href="../img/quiz_time.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
        * { font-family: 'Poppins', sans-serif; }
        .glass-nav { background: rgba(15,12,41,0.95); backdrop-filter: blur(14px); border-bottom: 1px solid rgba(255,255,255,0.1); }
        #mobile-menu { transition: max-height 0.3s ease, opacity 0.3s ease; max-height: 0; opacity: 0; overflow: hidden; }
        #mobile-menu.open { max-height: 400px; opacity: 1; }
    </style>
</head>
<body>
<header class="glass-nav sticky top-0 z-50 shadow-xl">
    <div class="px-4 sm:px-8 py-3 flex items-center justify-between">
        <!-- Logo -->
        <div class="flex items-center gap-3">
            <img src="../img/quiz_time.png" alt="QuizMaster" class="h-10 w-10">
            <div class="leading-tight">
                <span class="font-bold text-base text-indigo-300 block">QuizMaster</span>
                <span class="text-indigo-500 text-xs font-normal -mt-1 block">Admin Panel</span>
            </div>
        </div>

        <!-- Desktop Nav -->
        <nav class="hidden md:flex items-center gap-1">
            <a href="dashboard.php" class="px-3 py-2 rounded-lg text-indigo-200 hover:text-white hover:bg-indigo-800/50 text-sm font-medium transition">&#127968; Home</a>
            <a href="user.php"      class="px-3 py-2 rounded-lg text-indigo-200 hover:text-white hover:bg-indigo-800/50 text-sm font-medium transition">&#128101; Users</a>
            <a href="add_exam.php"  class="px-3 py-2 rounded-lg text-indigo-200 hover:text-white hover:bg-indigo-800/50 text-sm font-medium transition">&#128203; Add Exam</a>
            <a href="add_question.php" class="px-3 py-2 rounded-lg text-indigo-200 hover:text-white hover:bg-indigo-800/50 text-sm font-medium transition">&#10067; Questions</a>
            <a href="../logout.php" class="ml-2 px-4 py-2 rounded-lg bg-red-800/40 text-red-300 hover:bg-red-700/60 hover:text-white text-sm font-medium transition">&#128682; Logout</a>
        </nav>

        <!-- Hamburger Button (mobile only) -->
        <button id="hamburger" class="md:hidden flex flex-col justify-center items-center w-9 h-9 rounded-lg hover:bg-indigo-800/50 transition gap-1.5 p-2" onclick="toggleMenu()" aria-label="Toggle menu">
            <span id="bar1" class="block w-5 h-0.5 bg-indigo-300 transition-all duration-300 origin-center"></span>
            <span id="bar2" class="block w-5 h-0.5 bg-indigo-300 transition-all duration-300"></span>
            <span id="bar3" class="block w-5 h-0.5 bg-indigo-300 transition-all duration-300 origin-center"></span>
        </button>
    </div>

    <!-- Mobile Dropdown Menu -->
    <div id="mobile-menu" class="md:hidden px-4 pb-3">
        <nav class="flex flex-col gap-1 bg-indigo-950/60 rounded-xl p-3 border border-white/10">
            <a href="dashboard.php"    class="flex items-center gap-3 px-4 py-3 rounded-lg text-indigo-200 hover:text-white hover:bg-indigo-800/50 text-sm font-medium transition">
                <span class="text-lg">&#127968;</span> Home
            </a>
            <a href="user.php"         class="flex items-center gap-3 px-4 py-3 rounded-lg text-indigo-200 hover:text-white hover:bg-indigo-800/50 text-sm font-medium transition">
                <span class="text-lg">&#128101;</span> Users
            </a>
            <a href="add_exam.php"     class="flex items-center gap-3 px-4 py-3 rounded-lg text-indigo-200 hover:text-white hover:bg-indigo-800/50 text-sm font-medium transition">
                <span class="text-lg">&#128203;</span> Add Exam
            </a>
            <a href="add_question.php" class="flex items-center gap-3 px-4 py-3 rounded-lg text-indigo-200 hover:text-white hover:bg-indigo-800/50 text-sm font-medium transition">
                <span class="text-lg">&#10067;</span> Add Questions
            </a>
            <div class="border-t border-white/10 mt-1 pt-1">
                <a href="../logout.php" class="flex items-center gap-3 px-4 py-3 rounded-lg bg-red-800/30 text-red-300 hover:bg-red-700/50 hover:text-white text-sm font-medium transition">
                    <span class="text-lg">&#128682;</span> Logout
                </a>
            </div>
        </nav>
    </div>
</header>

<script>
    var menuOpen = false;
    function toggleMenu() {
        menuOpen = !menuOpen;
        var menu = document.getElementById('mobile-menu');
        var bar1 = document.getElementById('bar1');
        var bar2 = document.getElementById('bar2');
        var bar3 = document.getElementById('bar3');
        if (menuOpen) {
            menu.classList.add('open');
            bar1.style.transform = 'translateY(8px) rotate(45deg)';
            bar2.style.opacity = '0';
            bar3.style.transform = 'translateY(-8px) rotate(-45deg)';
        } else {
            menu.classList.remove('open');
            bar1.style.transform = '';
            bar2.style.opacity = '1';
            bar3.style.transform = '';
        }
    }
    // Close menu if clicked outside
    document.addEventListener('click', function(e) {
        var header = document.querySelector('header');
        if (menuOpen && !header.contains(e.target)) {
            toggleMenu();
        }
    });
</script>
</body>
</html>