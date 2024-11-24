<?php
include "conn.php";
$firstnm = "";
$lastnm = "";
$email = "";
$con_no = "";
$gender = "";
$uname = "";
$pass = "";

$firstnm_er = "";
$lastnm_er = "";
$email_er = "";
$con_no_er = "";
$gender_er = "";
$uname_er = "";
$pass_er = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $firstnm = $_POST['firstname'];
    $lastnm = $_POST['lastname'];
    $email = $_POST['email'];
    $con_no = $_POST['contect_no'];
    $gender = $_POST['r1'];
    $uname = $_POST['username'];
    $pass = $_POST['password'];

    if (empty($firstnm)) {
        $firstnm_er = "*Firstname is required";
    } else {
        $firstnm = trim($firstnm);
        $firstnm = htmlspecialchars($firstnm);
        if (!preg_match("/^[a-zA-Z ]+$/", $firstnm)) {
            $firstnm_er = "*Firstname should only contain letters and space";
        }
    }
    if (empty($lastnm)) {
        $lastnm_er = "*Lastname is required";
    } else {
        $lastnm = trim($lastnm);
        $lastnm = htmlspecialchars($lastnm);
        if (!preg_match("/^[a-zA-Z ]+$/", $lastnm)) {
            $lastnm_er = "*Lastname should only contain letters and space";
        }
    }
    if (empty($email)) {
        $email_er = "*Email is required";
    } else {

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_er = "*Invalid email";
        }
    }
    if (empty($con_no)) {
        $con_no_er = "*Mobile number is required";
    } else {

        if (!preg_match("/^[0-9]{10}$/", $con_no)) {
            $con_no_er = "*It should be 10 digits";
        }
    }
    $male = "images/male.png";
    $female = "images/female.png";
    if (empty($gender)) {

        if ($gender === 'male') {
            $image = 'male.png';
        } elseif ($gender === 'female') {
            $image = 'female.png';
        } else {
            $gender_er = "Select any one";
        }

    }

    if (empty($uname)) {
        $uname_er = "Name is required";
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
    if (empty($firstnm_er) && empty($lastnm_er) && empty($email_er) && empty($con_no_er) && empty($gender_er) && empty($uname_er) && empty($pass_er)) {
        $count = 0;
        $check = mysqli_query($con, "select * from user_data where username='$_POST[username]'");
        $count = mysqli_num_rows($check);

        if ($count > 0) {

            echo "<script>
                alert('you are Already register')
            </script>";

        } else {
            mysqli_query($con, "insert into user_data(user_id,firstname,lastname,email,contact_no,gender,username,password) values(null,'$firstnm','$lastnm','$email',$con_no,'$gender','$uname','$pass')") or die(mysqli_error($con));
            echo "<script>
                alert('register successfully');
                window.location = 'login.php';
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
    <title>registaration</title>
    <link rel="shortcut icon" type="x-icon" href="img/quiz_time.png">
    <link rel="stylesheet" href="css/register.css">
</head>

<body class="flex">
    <img src="img/bg2.jpg" class="bg">
    <div class="main-container flex">
        <form action="" method="POST">
            <h1>Register Information</h1>
            <label for="">First Name :</label>
            <div>
                <input type="text" name="firstname" placeholder="Enter First Name" autocomplete="off"
                    value="<?php echo htmlspecialchars($firstnm); ?>">
            </div>
            <div class="formerror"><span><?php echo $firstnm_er; ?></span></div>
            <label for="">Last Name :</label>
            <div id="lname">
                <input type="text" placeholder="Enter Last Name" name="lastname" autocomplete="off"
                    value="<?php echo htmlspecialchars($lastnm); ?>">
            </div>
            <div class="formerror"><span><?php echo $lastnm_er; ?></span></div>
            <label for="">Email :</label>
            <div id="email">
                <input type="emali" name="email" placeholder="Enter Email" autocomplete="off"
                    value="<?php echo htmlspecialchars($email); ?>">
            </div>
            <div class="formerror"><span><?php echo $email_er; ?></span></div>
            <label for="">Contect No. :</label>
            <div id="con">
                <input type="number" placeholder="Enter Contect" name="contect_no" autocomplete="off"
                    value="<?php echo htmlspecialchars($con_no); ?>">
            </div>
            <div class="formerror"><span><?php echo $con_no_er; ?></span></div>
            <label for="">Gender :</label>
            <div class="set-red flexf">
                <input type="radio" name="r1" value="male" checked><label for="">Male</label>
                <input type="radio" name="r1" value="female"><label for="">Female</label>
            </div>
            <div class="formerror"><span id="error"><?php echo $gender_er; ?></span></div>
            <label for="">Username :</label>
            <div id="unm">
                <input type="text" placeholder="Enter Username" name="username" autocomplete="off"
                    value="<?php echo htmlspecialchars($uname); ?>">
            </div>
            <div class="formerror"><span><?php echo $uname_er; ?></span></div>
            <label for="">Password :</label>
            <div id="pas">
                <input type="password" placeholder="Enter Password" name="password" id="ps" autocomplete="off"
                    value="<?php echo htmlspecialchars($pass); ?>">
            </div>
            <div class="formerror"><span><?php echo $pass_er; ?></span></div>
            <div class="set-checkbox flexf">
                <input type="checkbox" class="checkbox" onclick="showpass()">
                <label class="ch-label">Show password</label>
            </div>
            <div>
                <input type="submit" value="Submit" class="Sign-in" name="submit">
            </div>
            <div class="log-in">
                <p>Already have an account?<a href="login.php">log-in</a></p>
            </div>
        </form>
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