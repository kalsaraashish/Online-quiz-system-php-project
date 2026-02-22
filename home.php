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
    <title>Home - QuizMaster</title>
    <link rel="shortcut icon" type="x-icon" href="img/quiz_time.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap');
        body { font-family: 'Poppins', sans-serif; }
        .glass { background: rgba(255,255,255,0.08); backdrop-filter: blur(14px); border: 1px solid rgba(255,255,255,0.15); }
        .hero-bg { background: linear-gradient(135deg, #1e1b4b 0%, #312e81 40%, #1e40af 100%); }
        .card-hover { transition: transform 0.25s, box-shadow 0.25s; }
        .card-hover:hover { transform: translateY(-6px); box-shadow: 0 20px 40px rgba(99,102,241,0.3); }
        .sub-menu { display: none; position: absolute; right: 0; top: 60px; min-width: 220px; z-index: 100; }
        .sub-menu.open { display: block; }
        .carousel-inner img { max-height: 420px; object-fit: cover; border-radius: 1rem; }
        /* hide bootstrap-only class from interfering */
    </style>
</head>
<body class="bg-gray-950 text-white">

    <!-- HEADER / NAV -->
    <header class="glass sticky top-0 z-50 px-4 sm:px-8 py-3 flex items-center justify-between shadow-xl">
        <div class="flex items-center gap-3">
            <img src="img/quiz_time.png" alt="QuizMaster" class="h-10 w-10 rounded-lg">
            <span class="font-bold text-xl text-indigo-300 hidden sm:inline">QuizMaster</span>
        </div>
        <nav class="flex items-center gap-2 sm:gap-6">
            <a href="#home" class="text-indigo-200 hover:text-white font-medium transition hidden md:inline">Home</a>
            <a href="#About_Us" class="text-indigo-200 hover:text-white font-medium transition hidden md:inline">About Us</a>
            <a href="#Message_Us" class="text-indigo-200 hover:text-white font-medium transition hidden md:inline">Message Us</a>
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

    <!-- HERO -->
    <div id="home" class="hero-bg py-16 px-4 text-center">
        <h1 class="text-4xl sm:text-5xl font-extrabold text-white mb-3 drop-shadow">Welcome, <span class="text-indigo-300"><?php echo $_SESSION["username"]; ?></span>! 🎉</h1>
        <p class="text-indigo-200 text-lg mb-10">Discover amazing quizzes and test your knowledge!</p>

        <!-- Carousel -->
        <div class="max-w-3xl mx-auto">
            <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner rounded-2xl overflow-hidden shadow-2xl">
                    <div class="carousel-item active" data-bs-interval="3000">
                        <img src="img/3.jpg" class="d-block w-100" alt="quiz">
                    </div>
                    <div class="carousel-item" data-bs-interval="3000">
                        <img src="img/2.jpg" class="d-block w-100" alt="quiz">
                    </div>
                    <div class="carousel-item" data-bs-interval="4000">
                        <img src="img/5.avif" class="d-block w-100" alt="quiz">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>
        </div>
    </div>

    <!-- QUIZ CARDS -->
    <section class="max-w-6xl mx-auto px-4 py-12">
        <h2 class="text-2xl font-bold text-indigo-300 mb-8 text-center">Choose a Quiz</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php
            $check = mysqli_query($con, "select * from exam_category");
            while ($row = mysqli_fetch_array($check)) { ?>
                <div class="glass rounded-2xl overflow-hidden card-hover">
                    <img src="<?php echo $row[3]; ?>" alt="quiz" class="w-full h-48 object-cover">
                    <div class="p-5">
                        <h3 class="text-xl font-bold text-white mb-1"><?php echo $row["category"]; ?> Quiz</h3>
                        <p class="text-indigo-300 text-sm mb-4">⏱ Time: <?php echo $row["exam_time"]; ?> mins</p>
                        <a href="forajax/set_exam_type_session.php?id=<?php echo $row["id"]; ?>"
                            class="block text-center py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white font-semibold transition">
                            Start Quiz →
                        </a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>

    <!-- RESULT TABLE -->
    <?php
    $count = 0;
    $result_data = mysqli_query($con, "select * from result where user_id='$_SESSION[user_id]'");
    $check_user_data = mysqli_num_rows($result_data);
    if ($check_user_data > 0): ?>
    <section class="max-w-5xl mx-auto px-4 pb-12">
        <h2 class="text-2xl font-bold text-indigo-300 mb-6">Your Results</h2>
        <div class="glass rounded-2xl overflow-x-auto shadow-xl">
            <table class="w-full text-sm text-white" id="table_data">
                <thead>
                    <tr class="bg-indigo-900/60 text-indigo-300 uppercase text-xs">
                        <th class="px-4 py-3 text-left">No.</th>
                        <th class="px-4 py-3 text-left">Quiz Name</th>
                        <th class="px-4 py-3 text-left">Total Q</th>
                        <th class="px-4 py-3 text-left">Correct</th>
                        <th class="px-4 py-3 text-left">Wrong</th>
                        <th class="px-4 py-3 text-left">Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_array($result_data)) {
                        $count++;
                        $pct = $row['total_question'] > 0 ? round(($row['correct_answer']/$row['total_question'])*100) : 0;
                    ?>
                    <tr class="border-t border-white/10 hover:bg-white/5 transition">
                        <td class="px-4 py-3"><?php echo $count; ?></td>
                        <td class="px-4 py-3 font-medium"><?php echo $row['exam_type']; ?></td>
                        <td class="px-4 py-3"><?php echo $row['total_question']; ?></td>
                        <td class="px-4 py-3 text-green-400 font-semibold"><?php echo $row['correct_answer']; ?></td>
                        <td class="px-4 py-3 text-red-400 font-semibold"><?php echo $row['wrong_answer']; ?></td>
                        <td class="px-4 py-3 text-indigo-300"><?php echo $row['exam_date']; ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </section>
    <?php endif; ?>

    <!-- ABOUT US -->
    <section id="About_Us" class="max-w-3xl mx-auto px-4 py-14 text-center">
        <h2 class="text-3xl font-extrabold text-indigo-300 mb-4">About Us</h2>
        <p class="text-indigo-100 text-lg mb-6">Welcome to <span class="text-white font-bold">QuizMaster</span>! We bring you an online quiz system designed to make learning fun and interactive.</p>
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 my-8">
            <?php $features = ['🌟 Easy to Use','🎓 Variety of Quizzes','⚡ Instant Feedback','🏆 Fun Challenges'];
            foreach($features as $f): ?>
            <div class="glass rounded-xl py-4 px-2 text-sm text-indigo-200 font-medium"><?php echo $f; ?></div>
            <?php endforeach; ?>
        </div>
        <p class="text-indigo-200">We are a team led by <strong class="text-white">Ashish Kalsara</strong>, passionate about technology and education.</p>
    </section>

    <!-- MESSAGE US -->
    <section id="Message_Us" class="max-w-xl mx-auto px-4 pb-16">
        <div class="glass rounded-2xl p-8 shadow-xl">
            <h2 class="text-2xl font-bold text-indigo-300 mb-6 text-center">Message Us</h2>
            <form method="post" class="space-y-4">
                <div>
                    <label class="block text-indigo-200 text-sm mb-1">Name</label>
                    <input type="text" name="name" autocomplete="off" required
                        class="w-full px-4 py-2.5 rounded-xl bg-white/10 text-white placeholder-indigo-300 border border-white/20 focus:outline-none focus:ring-2 focus:ring-indigo-400 transition">
                </div>
                <div>
                    <label class="block text-indigo-200 text-sm mb-1">Email</label>
                    <input type="email" name="email" autocomplete="off" required
                        class="w-full px-4 py-2.5 rounded-xl bg-white/10 text-white placeholder-indigo-300 border border-white/20 focus:outline-none focus:ring-2 focus:ring-indigo-400 transition">
                </div>
                <div>
                    <label class="block text-indigo-200 text-sm mb-1">Message</label>
                    <textarea name="message" rows="4" required
                        class="w-full px-4 py-2.5 rounded-xl bg-white/10 text-white placeholder-indigo-300 border border-white/20 focus:outline-none focus:ring-2 focus:ring-indigo-400 transition resize-none"></textarea>
                </div>
                <button type="submit" name="add"
                    class="w-full py-3 rounded-xl bg-indigo-500 hover:bg-indigo-400 text-white font-semibold text-lg shadow-lg transition-all duration-200 hover:scale-[1.02]">
                    Send Message
                </button>
            </form>
        </div>
    </section>

    <?php include "footer.php"; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let submenu = document.getElementById("sub-menu");
        function open_menu() { submenu.classList.toggle("open"); }
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.relative')) submenu.classList.remove('open');
        });
    </script>
</body>
<?php
if (isset($_POST["add"])) {
    $message = mysqli_query($con, "insert into user_feedback values($_SESSION[user_id],'$_SESSION[username]','$_POST[name]','$_POST[email]','$_POST[message]')");
    echo "<script>alert('thanks for feedback');</script>";
}
?>
</html>