<?php
session_start();
if (!isset($_SESSION["username"])) { ?>
    <script>window.location = "login.php";</script>
<?php }
include("header_time.php");
include("conn.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Start Quiz</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
        body { font-family: 'Poppins', sans-serif; background: linear-gradient(135deg,#1e1b4b,#312e81,#1e40af); min-height: 100vh; }
        .glass { background: rgba(255,255,255,0.08); backdrop-filter: blur(14px); border: 1px solid rgba(255,255,255,0.15); }
        /* Radio styling for options */
        .option-label input[type=radio] { display: none; }
        .option-label span {
            display: flex; align-items: center; gap: 10px;
            padding: 12px 18px; border-radius: 12px;
            border: 1.5px solid rgba(255,255,255,0.15);
            background: rgba(255,255,255,0.05);
            color: #c7d2fe; font-size: 1rem; cursor: pointer;
            transition: all 0.2s;
        }
        .option-label input[type=radio]:checked + span {
            border-color: #818cf8; background: rgba(129,140,248,0.2); color: #fff; font-weight: 600;
        }
        .option-label span:hover { background: rgba(255,255,255,0.1); color: #fff; }
    </style>
</head>
<body class="text-white">
    <div class="max-w-2xl mx-auto px-4 py-10">
        <div class="glass rounded-2xl shadow-2xl p-6 sm:p-10">
            <!-- Question Counter -->
            <div class="flex items-center justify-between mb-6">
                <span class="text-indigo-300 text-sm font-medium uppercase tracking-widest">Question</span>
                <div class="flex items-center gap-2 glass px-5 py-2 rounded-full text-lg font-bold">
                    <span id="current_que" class="text-indigo-300">0</span>
                    <span class="text-white/40">/</span>
                    <span id="total_que" class="text-white">0</span>
                </div>
            </div>

            <!-- Question & Options -->
            <div id="load_questions" class="space-y-3 min-h-[200px]">
                <div class="text-indigo-300 text-center py-8">Loading question...</div>
            </div>

            <!-- Navigation Buttons -->
            <div class="flex justify-between mt-8 gap-4">
                <button onclick="load_previous()"
                    class="flex-1 py-3 rounded-xl border border-indigo-500 text-indigo-300 hover:bg-indigo-800/50 font-semibold transition-all">
                    ← Previous
                </button>
                <button onclick="load_next()"
                    class="flex-1 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white font-semibold shadow-lg transition-all">
                    Next →
                </button>
            </div>
        </div>
    </div>

<script type="text/javascript">
    function load_total_que() {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("total_que").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET", "forajax/load_total_que.php", true);
        xmlhttp.send(null);
    }

    let questionno = "1";
    load_questions(questionno);

    function load_questions(questionno) {
        document.getElementById("current_que").innerHTML = questionno;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                if (xmlhttp.responseText == "over") {
                    window.location = "result.php";
                } else {
                    document.getElementById("load_questions").innerHTML = xmlhttp.responseText;
                    load_total_que();
                }
            }
        };
        xmlhttp.open("GET", "forajax/load_questions.php?questionno=" + questionno, true);
        xmlhttp.send(null);
    }

    function radioclick(radiovalue, questionno) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {};
        xmlhttp.open("GET", "forajax/save_ans_session.php?questionno=" + questionno + "&value1=" + radiovalue, true);
        xmlhttp.send(null);
    }

    function load_previous() {
        if (questionno > 1) { questionno--; load_questions(questionno); }
    }

    function load_next() { questionno++; load_questions(questionno); }
</script>
</body>
</html>