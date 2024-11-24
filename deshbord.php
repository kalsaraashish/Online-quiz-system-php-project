<?php
session_start();
if (!isset($_SESSION["username"])) {
    ?>
    <script>
        window.location = "login.php";
    </script>
    <?php
}
include("header_time.php");
include("conn.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/deshbord.css">
    <title>start quiz</title>
</head>

<body>
    <div>
        <div>
            <div class="q-no">
                <div id="current_que">0</div>
                <div>/</div>
                <div id="total_que">0</div>
            </div>
            <div class="opt-gap" id="load_questions">
            </div>
            <div class="set-btn">
                <form method="POST">
                    <input type="button" class="pre-btn" value="Previous" onclick="load_previous();">&nbsp;

                    <input type="button" class="n-btn" value="Next" onclick="load_next();">
                </form>
            </div>
        </div>
    </div>
</body>

</html>
<script type="text/javascript">
    function load_total_que() {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                // alert(xmlhttp.responseText);
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
                // alert(xmlhttp.responseText);
                if (xmlhttp.responseText == "over") {
                    window.location = "result.php";
                }
                else {
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
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                // alert(xmlhttp.responseText);

            }
        };
        xmlhttp.open("GET", "forajax/save_ans_session.php?questionno=" + questionno + "&value1=" + radiovalue, true);
        xmlhttp.send(null);
    }
    function load_previous() {
        if (questionno > 1) {
            questionno--;
            load_questions(questionno);
        }
    }
    function load_next() {
        questionno++;
        load_questions(questionno);
    }
</script>