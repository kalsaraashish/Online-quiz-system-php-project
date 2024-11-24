<?php
session_start();
if (!isset($_SESSION["username"])) {
    ?>
    <script>
        window.location = "login.php";
    </script>
    <?php
}
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
                    <img src="<?php
                    if ($data['gender'] == 'male') {
                        echo "images/male.png";
                    } else {
                        echo "images/female.png";
                    }
                    ?>" alt="User Image" class="user-pic">
                </li>
            </ul>
            <!-- <div class="sub-menu" id="sub-menu">
                <div class="uer-info flax">
                    <div>
                        <img src="<?php
                        if ($data['gender'] == 'male') {
                            echo "images/male.png";
                        } else {
                            echo "images/female.png";
                        }
                        ?>" alt="User Image" class="user-logo">
                    </div>
                    <div>
                        <h3>Hello,<?php echo $_SESSION["username"]; ?></h3>
                    </div>
                </div>
                <hr>
                <div><a href="user_profile.php" class="flax menu-link">
                        <img src="img/profile.png" alt="profile" class="user-logo">
                        <p>Edit Profile</p>
                        <span>></span>
                    </a></div>
                <div>
                    <a href="logout.php" class="flax menu-link">
                        <img src="img/logout.png" alt="profile" class="user-logo">
                        <p>Log-out</p>
                        <span>></span>
                    </a>
                </div>
            </div> -->
        </nav>
    </header>
</body>
<script>
    let submenu = document.getElementById("sub-menu");
    function open_menu() {
        submenu.classList.toggle("open");
    }

</script>

</html>