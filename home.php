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
    <title>Home</title>
    <link rel="shortcut icon" type="x-icon" href="img/quiz_time.png">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/aboutus.css">
    <link rel="stylesheet" href="css/message_us.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body class="body">

    <header class="header">
        <div class="nav-logo">
            <img src="img/quiz_time.png" alt="" class="nav-logo">
        </div>
        <nav>

            <ul>
                <li><a href="#home" class="a">Home</a></li>
                <li><a href="#About_Us" class="a">About Us</a></li>
                <li><a href="#Message_Us" class="a">Message Us</a></li>
                <li> <img src="<?php
                if ($data['gender'] == 'male') {
                    echo "images/male.png";
                } else {
                    echo "images/female.png";
                }
                ?>" alt="User Image" class="user-pic" onclick="open_menu()"></li>
            </ul>
            <div class="sub-menu" id="sub-menu">
                <div class="uer-info flax">
                    <div> <img src="<?php
                    if ($data['gender'] == 'male') {
                        echo "images/male.png";
                    } else {
                        echo "images/female.png";
                    }
                    ?>" alt="User Image" class="user-logo"></div>
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
    <!-- home code -->
    <div id="home">
        <header>
            <div class="h1 container-fluid">
                <h1>Welcome to Our Website <?php echo $_SESSION["username"]; ?></h1>
                <h2>Discover amazing Quiz and connect with like-minded people.</h2>
            </div>
        </header>
        <section>
            <div class="set container-fluid">
                <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active" data-bs-interval="1000">
                            <img src="img/3.jpg" class="d-block img1" alt="...">
                        </div>
                        <div class="carousel-item" data-bs-interval="2000">
                            <img src="img/2.jpg" class="d-block img1" alt="...">
                        </div>
                        <div class="carousel-item" data-bs-interval="4000">
                            <img src="img/5.avif" class="d-block img1" alt="...">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </section>
        <div class="conteiner">
            <?php
            $check = mysqli_query($con, "select * from exam_category");
            while ($row = mysqli_fetch_array($check)) {
                ?>
                <div class="quiz-card">
                    <img src="<?php echo $row[3]; ?>" alt="error">
                    <div class="quiz-card-content">
                        <div class="quiz-name"><?php echo $row["category"] ?> Quiz</div>
                        <div class="quiz-info">
                            <div>Time: <?php echo $row["exam_time"] ?> mins</div>
                        </div>
                        <div class="btn"><a href="forajax/set_exam_type_session.php?id=<?php echo $row["id"]; ?>">Start
                                Quiz</a></div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>



    <?php $count = 0;
    $result_data = mysqli_query($con, "select * from result where user_id='$_SESSION[user_id]'");
    $check_user_data = mysqli_num_rows($result_data);
    if ($check_user_data > 0) {
        ?>
        <div class="result-h2">
            <h2>result data :</h2>
        </div>
        <div class="table-container">
            <table id="table_data">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>quiz name</th>
                        <th>total Questions</th>
                        <th>correct</th>
                        <th>wrong</th>
                        <th>time</th>
                    </tr>
                </thead>

                <?php
                while ($row = mysqli_fetch_array($result_data)) {
                    $count++;
                    ?>
                    <tbody>
                        <tr>
                            <td><?php echo $count; ?></td>
                            <td><?php echo $row['exam_type']; ?></td>
                            <td><?php echo $row['total_question']; ?></td>
                            <td><?php echo $row['correct_answer']; ?></td>
                            <td><?php echo $row['wrong_answer']; ?></td>
                            <td><?php echo $row['exam_date']; ?></td>
                        </tr>
                    </tbody>
                    <?php
                }
    } else {
        echo "<script>
            Document.getElementById('table_data').style.display= 'none';
        </script>";
    }
    ?>
        </table>
    </div>
    <!-- about us code -->
    <div class="main-con" id="About_Us">
        <h1>About Us</h1>
        <p class="intro">Welcome to <span class="highlight">QuizMaster</span>! We are excited to bring you an online
            quiz system designed to make learning fun and interactive.</p>
        <h2>Our Mission</h2>
        <p>Our goal is to help you learn and test your knowledge in an enjoyable way.</p>
        <h2>Who We Are</h2>
        <p>We are a team led by <strong>Ashish Kalsara</strong>, passionate about technology and education.</p>
        <h2>What We Offer</h2>
        <ul class="features">
            <li>🌟 Easy to Use</li>
            <li>🎓 Variety of Quizzes</li>
            <li>⚡ Instant Feedback</li>
            <li>🏆 Fun Challenges</li>
        </ul>
        <h2>Join Us!</h2>
        <p class="join">Dive into QuizMaster and enjoy learning through quizzes!</p>
    </div>

    <!-- massage us code -->
    <div class="massage" id="Message_Us">
        <div class="ms-img">
            <h2>message us:</h2><img src="img/123.png" alt="">
        </div>
        <div class="ms-form">
            <form method="post">
                <label for="">name:</label>
                <div><input type="text" name="name" autocomplete="off" required></div>
                <label for="">email:</label>
                <div><input type="email" name="email" autocomplete="off" required></div>
                <label for="">Message:</label>
                <div> <textarea class="ms-box" name="message" rows="3" cols="40" required></textarea></div>
                <div><input type="submit" name="add"></div>
            </form>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let submenu = document.getElementById("sub-menu");
        function open_menu() {
            submenu.classList.toggle("open");
        }

    </script>
</body>
<?php
include "footer.php";
?>

</html>
<?php


if (isset($_POST["add"])) {
    $message = mysqli_query($con, "insert into user_feedback values($_SESSION[user_id],'$_SESSION[username]','$_POST[name]','$_POST[email]','$_POST[message]')");
    echo "<script>
        alert('thanks for feedback');
         </script>";
}
?>