<?php
// session_start();
include("header.php");
if (!isset($_SESSION["username"])) { ?>
    <script>window.location = "login.php";</script>
<?php }
include("conn.php");
$userdata = mysqli_query($con, "select * from user_data where user_id=$_SESSION[user_id];");
$data = mysqli_fetch_array($userdata);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile - QuizMaster</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
        body { font-family: 'Poppins', sans-serif; background: linear-gradient(135deg,#1e1b4b,#312e81,#1e40af); min-height: 100vh; }
        .glass { background: rgba(255,255,255,0.08); backdrop-filter: blur(14px); border: 1px solid rgba(255,255,255,0.15); }
    </style>
</head>
<body class="text-white py-10 px-4">
    <div class="max-w-lg mx-auto">
        <div class="glass rounded-2xl shadow-2xl p-8">
            <div class="flex flex-col items-center mb-6">
                <img src="<?php echo ($data['gender']=='male') ? 'images/male.png' : 'images/female.png'; ?>"
                    alt="User" class="h-20 w-20 rounded-full border-4 border-indigo-400 object-cover shadow-lg mb-3">
                <h2 class="text-2xl font-bold text-white">Edit Profile</h2>
            </div>

            <form action="update_profile.php" method="POST" class="space-y-4">
                <div>
                    <label class="block text-indigo-200 text-sm font-medium mb-1">First Name</label>
                    <input type="text" name="fistname" value="<?php echo $data['firstname']; ?>" required
                        class="w-full px-4 py-2.5 rounded-xl bg-white/10 text-white border border-white/20 focus:outline-none focus:ring-2 focus:ring-indigo-400 transition">
                </div>
                <div>
                    <label class="block text-indigo-200 text-sm font-medium mb-1">Last Name</label>
                    <input type="text" name="lastname" value="<?php echo $data['lastname']; ?>" required
                        class="w-full px-4 py-2.5 rounded-xl bg-white/10 text-white border border-white/20 focus:outline-none focus:ring-2 focus:ring-indigo-400 transition">
                </div>
                <div>
                    <label class="block text-indigo-200 text-sm font-medium mb-1">Email</label>
                    <input type="email" name="email" value="<?php echo $data['email']; ?>" required
                        class="w-full px-4 py-2.5 rounded-xl bg-white/10 text-white border border-white/20 focus:outline-none focus:ring-2 focus:ring-indigo-400 transition">
                </div>
                <div>
                    <label class="block text-indigo-200 text-sm font-medium mb-1">Contact No.</label>
                    <input type="text" name="contect_no" value="<?php echo $data['contact_no']; ?>" required
                        class="w-full px-4 py-2.5 rounded-xl bg-white/10 text-white border border-white/20 focus:outline-none focus:ring-2 focus:ring-indigo-400 transition">
                </div>
                <div>
                    <label class="block text-indigo-200 text-sm font-medium mb-2">Gender</label>
                    <select name="gender" required
                        class="w-full px-4 py-2.5 rounded-xl bg-indigo-900 text-white border border-white/20 focus:outline-none focus:ring-2 focus:ring-indigo-400 transition">
                        <option value="male" <?php if($data['gender']=='male') echo 'selected'; ?>>Male</option>
                        <option value="female" <?php if($data['gender']=='female') echo 'selected'; ?>>Female</option>
                    </select>
                </div>
                <div>
                    <label class="block text-indigo-200 text-sm font-medium mb-1">Username</label>
                    <input type="text" name="username" value="<?php echo $data['username']; ?>" required
                        class="w-full px-4 py-2.5 rounded-xl bg-white/10 text-white border border-white/20 focus:outline-none focus:ring-2 focus:ring-indigo-400 transition">
                </div>
                <div>
                    <label class="block text-indigo-200 text-sm font-medium mb-1">Password</label>
                    <input type="password" id="pass" name="password" value="<?php echo $data['password']; ?>" required
                        class="w-full px-4 py-2.5 rounded-xl bg-white/10 text-white border border-white/20 focus:outline-none focus:ring-2 focus:ring-indigo-400 transition">
                </div>
                <div class="flex items-center gap-2">
                    <input type="checkbox" class="accent-indigo-400 w-4 h-4 cursor-pointer" onclick="showpass()">
                    <label class="text-indigo-300 text-sm cursor-pointer" onclick="showpass()">Show password</label>
                </div>
                <button type="submit" name="submit"
                    onclick="return confirm('Are you sure you want to update this data?')"
                    class="w-full py-3 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white font-semibold shadow-lg transition-all hover:scale-[1.02]">
                    💾 Save Changes
                </button>
            </form>
        </div>
    </div>
    <script>
        function showpass() {
            var show = document.getElementById('pass');
            show.type = show.type === 'password' ? 'text' : 'password';
        }
    </script>
</body>
</html>
<?php
if (isset($_POST['submit'])) {
    $query = "UPDATE user_data SET firstname = '$_POST[fistname]', lastname = '$_POST[lastname]',email = '$_POST[email]',contact_no = '$_POST[contect_no]',gender = '$_POST[gender]',username = '$_POST[username]',password = '$_POST[password]' WHERE user_id = $_SESSION[user_id]";
    $q = mysqli_query($con, $query);
    if ($q) {
        $_SESSION['username'] = $_POST['username'];
        echo "<script>window.location= 'user_profile.php';</script>";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>