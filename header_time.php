<?php
// session_start();
include("conn.php");
if (!isset($_SESSION["username"])) {
    ?>
    <script>
        window.location = "login.php";
    </script>
    <?php
}
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
    <link rel="stylesheet" href="css/header.css">
</head>

<body>
    <header style="animation:none;">
        <div class="nav-logo">
            <img src="img/quiz_time.png" alt="" class="nav-logo">
        </div>
        <nav>

            <ul>
                <li>
                    <h2>Quiz name :<?php echo $_SESSION['exam_category']; ?></h2>
                </li>
                <li>
                    <img src="<?php
                    if ($data['gender'] == 'male') {
                        echo "images/male.png";
                    } else {
                        echo "images/female.png";
                    }
                    ?>" alt="User Image" class="user-pic">
                </li>
            </ul>
        </nav>
    </header>
    <div id="tm" class="timer"></div>
</body>
<script>
    let submenu = document.getElementById("sub-menu");
    function open_menu() {
        submenu.classList.toggle("open");
    }
</script>
<script type="text/javascript">
    setInterval(function () {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "forajax/load_timer.php", false);
        xmlhttp.send(null);
        document.getElementById("tm").innerHTML = xmlhttp.responseText;
        if (xmlhttp.responseText == "00:00:01") {
            window.location = "result.php";
        }
    }, 1000);
</script>

</html>

</html>