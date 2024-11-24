<?php
include "header.php";
include "../conn.php";
if (!isset($_SESSION["admin"])) {
  ?>
  <script>
    window.location = "../login.php";
  </script>
  <?php
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User</title>
  <link rel="stylesheet" href="../css/user.css">
</head>

<body>

  <div class="main">
    <table>
      <tr>
        <th>Id</th>
        <th>First name</th>
        <th>Last name</th>
        <th>email</th>
        <th>contact no</th>
        <th>Gender</th>
        <th>user name</th>
        <th>password</th>
        <th>Delete</th>
      </tr>
      <?php
      $count = 0;
      $data = mysqli_query($con, "select * from user_data");
      while ($row = mysqli_fetch_array($data)) {
        $count++;
        ?>
        <tr>
          <td><?php echo $count; ?></td>
          <td><?php echo $row["firstname"] ?></td>
          <td><?php echo $row["lastname"] ?></td>
          <td><?php echo $row["email"] ?></td>
          <td><?php echo $row["contact_no"] ?></td>
          <td><?php echo $row["gender"] ?></td>
          <td><?php echo $row["username"] ?></td>
          <td><?php echo $row["password"] ?></td>
          <td><a href="delete_user.php?id=<?php echo $row["user_id"] ?>"
              onclick="return confirm('Are you sure you want to Delete this data?');">Delete</a></td>
        </tr>
        <?php
      }
      ?>

    </table>
  </div>
</body>


</html>