<?php
// session_start();
include("header.php");
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
    <title>update Profile</title>
    <link rel="stylesheet" href="css/update_profile.css">
</head>

<body>
    <div class="body">
        <div class="profile-container">
            <div class="profile-header">
                <img src="<?php
                if ($data['gender'] == 'male') {
                    echo 'images/male.png';
                } else {
                    echo 'images/female.png';
                }
                ?>" alt="User Image" class="profile-image">
            </div>

            <h2>Edit Profile</h2>
            <form action="update_profile.php" method="POST">
                <div class="profile-info">
                    <label for="firstname">First Name:</label>
                    <input type="text" id="firstname" name="fistname" value="<?php echo $data['firstname']; ?>"
                        required>
                </div>

                <div class="profile-info">
                    <label for="lastname">Last Name:</label>
                    <input type="text" id="lastname" name="lastname" value="<?php echo $data['lastname']; ?>" required>
                </div>

                <div class="profile-info">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo $data['email']; ?>" required>
                </div>

                <div class="profile-info">
                    <label for="contact_no">Contact No:</label>
                    <input type="text" id="contact_no" name="contect_no" value="<?php echo $data['contact_no']; ?>"
                        required>
                </div>

                <div class="profile-info">
                    <label for="gender">Gender:</label>
                    <select id="gender" name="gender" required>
                        <option value="male" <?php if ($data['gender'] == 'male')
                            echo 'selected'; ?>>Male</option>
                        <option value="female" <?php if ($data['gender'] == 'female')
                            echo 'selected'; ?>>Female</option>
                    </select>
                </div>

                <div class="profile-info">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" value="<?php echo $data['username']; ?>" required>
                </div>

                <div class="profile-info">
                    <label for="password">Password:</label>
                    <input type="password" id="pass" name="password" value="<?php echo $data['password']; ?>" required>

                </div>
                <div class="show-password">
                    <input type="checkbox" onclick="showpass()">
                    <label>Show password</label>
                </div>

                <div class="button-container">
                    <input type="submit" value="save changes" name="submit"
                        onclick="return confirm('Are you sure you want to update this data?');">
                </div>
            </form>
        </div>
    </div>
</body>
<script type="text/javascript">
    function showpass() {
        var show = document.getElementById('pass');
        if (show.type == 'password') {
            show.type = 'text';
        }
        else {
            show.type = 'password';
        }
    }
</script>

</html>
<?php
if (isset($_POST['submit'])) {
    $query = "UPDATE user_data SET firstname = '$_POST[fistname]', lastname = '$_POST[lastname]',email = '$_POST[email]',contact_no = '$_POST[contect_no]',gender = '$_POST[gender]',username = '$_POST[username]',password = '$_POST[password]' WHERE user_id = $_SESSION[user_id]";
    // $uname='$_POST[username]';
    $q = mysqli_query($con, $query);

    if ($q) {
        $_SESSION['username'] = $_POST['username'];
        echo "<script>
        window.location= 'user_profile.php';</script>";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
// else {
//     echo "Error: Form not submitted.";
// }
?>