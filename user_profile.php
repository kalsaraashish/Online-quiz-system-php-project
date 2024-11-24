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
$userdata = mysqli_query($con, "select * from user_data where user_id=$_SESSION[user_id];");
$data = mysqli_fetch_array($userdata);

?>
<!DOCTYPE html>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="shortcut icon" type="x-icon" href="img/quiz_time.png">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/user_profile.css">
</head>

<body>
    <header style="animation:none;">
        <div class="nav-logo">
            <img src="img/quiz_time.png" alt="" class="nav-logo">
        </div>
        <nav>
            <ul>
                <li><a href="home.php" class="a">Home</a></li>
                <li><a href="home.php#About_Us" class="a">About Us</a></li>
                <li><a href="home.php#Message_Us" class="a">Message Us</a></li>
                <li>
                    <img src="<?php
                    if ($data['gender'] == 'male') {
                        echo "images/male.png";
                    } else {
                        echo "images/female.png";
                    }
                    ?>" alt="User Image" class="user-pic" onclick="open_menu()">
                </li>
            </ul>
            <div class="sub-menu" id="sub-menu">
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
            </div>
        </nav>
    </header>


    <div class="profile-container">
        <div class="profile-header">
            <img src="<?php
            if ($data['gender'] == 'male') {
                echo "images/male.png";
            } else {
                echo "images/female.png";
            }
            ?>" alt="User Image" class="profile-image">
        </div>
        <h2>User Profile :</h2>
        <div class="profile-info">
            <label>First Name:</label>
            <span><?php echo $data['firstname']; ?></span>
        </div>
        <div class="profile-info">
            <label>Last Name:</label>
            <span><?php echo $data['lastname']; ?></span>
        </div>
        <div class="profile-info">
            <label>Email:</label>
            <span><?php echo $data['email']; ?></span>
        </div>
        <div class="profile-info">
            <label>Contact No:</label>
            <span><?php echo $data['contact_no']; ?></span>
        </div>
        <div class="profile-info">
            <label>Gender:</label>
            <span><?php echo $data['gender']; ?></span>
        </div>
        <div class="profile-info">
            <label>Username:</label>
            <span><?php echo $data['username']; ?></span>
        </div>
        <div class="profile-info">
            <label>password:</label>
            <span><b>****</b></span>
        </div>

        <div class="button-container">
            <form action="">
                <button type="submit" name="submit">Edit Profile</button>
            </form>
        </div>
    </div>

</body>
<script>
    let submenu = document.getElementById("sub-menu");
    function open_menu() {
        submenu.classList.toggle("open");
    }

</script>

</html>
<?php
if (isset($_GET['submit'])) {
    echo "<script>
        window.location = 'update_profile.php';
    </script>";
}
?>