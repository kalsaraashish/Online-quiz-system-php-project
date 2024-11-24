<?php
include "conn.php";
session_start();
$uname = "";
$pass = "";
$uname_er = "";
$pass_er = "";


if (isset($_POST["submit"])) {
    $uname = $_POST['username'];
    $pass = $_POST['password'];

    if (empty($uname)) {
        $uname_er = "*Name is required";
    } else {
        $uname = trim($uname);
        $uname = htmlspecialchars($uname);
        if (!preg_match("/^[a-zA-Z0-9]{3,20}$/", $uname)) {
            $uname_er = "*Name should only contain letters and numbers";
        }
    }

    if (empty($pass)) {
        $pass_er = "*password is required";
    } else {
        if (strlen($pass) <= 8) {
            $pass_er = "*At least 8 digits";
        }
    }


    if (empty($uname_er) && empty($pass_er)) {
        $user_data = mysqli_query($con, "select * from user_data where username='$uname' && password='$pass'");
        $admin_data = mysqli_query($con, "select * from admin_data where username='$uname' && password='$pass'");
        $check_user = mysqli_num_rows($user_data);
        $check_admin = mysqli_num_rows($admin_data);

        $user_fetch = mysqli_fetch_array($user_data);


        if ($check_user > 0) {
            $_SESSION["username"] = $uname;
            $_SESSION["user_id"] = $user_fetch[0];

            echo "<Script>
            window.location = 'home.php';
        </Script>";
        } elseif ($check_admin > 0) {
            $_SESSION["admin"] = $uname;
            echo "<Script>
            window.location = 'admin/dashboard.php';
        </Script>";
        } else {
            echo "<script>
            alert('you are not register');
        </script>";
        }

    }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="shortcut icon" type="x-icon" href="img/quiz_time.png">
    <link rel="stylesheet" href="css/login-style.css">
</head>

<body class="flex">
    <div class="main-container">
        <div class="login-form">
            <div class="header flex">
                <h1>log-in</h1>
            </div>
            <div class="flex">
                <form method="post">
                    <label class="label">Username :</label>
                    <div>
                        <input type="text" name="username" id="" placeholder="Enter Username" autocomplete="off"
                            value="<?php echo htmlspecialchars($uname); ?>">
                    </div>
                    <div class="formerror"><span><?php echo $uname_er; ?></span></div>
                    <label class="label">Password :</label>
                    <div>
                        <input type="password" name="password" id="ps" placeholder="Enter Password" autocomplete="off"
                            value="<?php echo htmlspecialchars($pass); ?>">
                    </div>
                    <div class="formerror"><span><?php echo $pass_er; ?></span></div>
                    <div class="set-checkbox">
                        <input type="checkbox" class="checkbox" onclick="showpass()">
                        <label class="label">Show password</label>
                    </div>
                    <div>
                        <input type="submit" value="Sign-in" class="Sign-in" name="submit">
                    </div>
                    <div class="Register">
                        <p>Don't have account?<a href="register.php">Register</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript">
    function showpass() {
        var show = document.getElementById('ps');
        if (show.type == 'password') {
            show.type = 'text';
        }
        else {
            show.type = 'password';
        }
    }
</script>

</html>