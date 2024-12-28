<?php 
  include '../../config.php';
  session_start();
  if(isset($_SESSION["user_id"])){
    $con = mysqli_connect("localhost", "root", "", "webProject");
    $user_id = $_SESSION['user_id'];
    $sql_query = "SELECT * FROM users WHERE user_id = '$user_id' AND user_type = 'company'";
    $result = mysqli_query($conn, $sql_query);

    if ($result) {
      $row = mysqli_fetch_assoc($result);
      $name = htmlspecialchars($row['name']);
      $user_type = htmlspecialchars($row['user_type']);
      $email = htmlspecialchars($row['email']);
      $phone = htmlspecialchars($row['phone']);
      $address= htmlspecialchars($row['address']);
      $bio = htmlspecialchars($row['bio']);
      $location = htmlspecialchars($row['location']);
      $password = htmlspecialchars($row['password']);
    } else {
        echo "Error fetching user data: " . mysqli_error($con);
        exit;
    }

    if (isset($_POST['submit'])) {
        $name = mysqli_real_escape_string($con, $_POST['name']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $phone = mysqli_real_escape_string($con, $_POST['phone']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $address = mysqli_real_escape_string($con, $_POST['address']);
        $bio = mysqli_real_escape_string($con, $_POST['bio']);
        $location=mysqli_real_escape_string($con, $_POST['location']);

        $update_profile_sql = "
        UPDATE users 
        SET 
            name = '$name', 
            user_type = '$user_type', 
            email = '$email', 
            phone = '$phone', 
            password = '$password' 
            address = '$address' 
            bio = '$bio' 
            location = '$location' 
        WHERE user_id = $user_id";

    if (mysqli_query($con, $update_profile_sql)) {
        echo "Profile updated successfully.";
    } else {
        echo "Error updating profile: " . mysqli_error($con);
    }
}
  }
  else{
    echo "Login in first <a href='../login.php'>Login</a>";
  }
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="./profile.css">
</head>
<body>
  
<div class="container">
    <h1>Company Profile</h1>
    <form action="profile.php" method="post">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>"><br><br>

    <label for="user_type">User Type:</label>
    <input type="text" id="user_type" name="user_type" value="<?php echo htmlspecialchars($user_type); ?>"><br><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>"><br><br>

    <label for="phone">Phone:</label>
    <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($phone); ?>"><br><br>

    <label for="address">Address:</label>
    <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($address); ?>"><br><br>

    <label for="bio">Bio:</label>
    <input type="text" id="bio" name="bio" value="<?php echo htmlspecialchars($bio); ?>"><br><br>

    <label for="address">Location:</label>
    <input type="text" id="location" name="location" value="<?php echo htmlspecialchars($location); ?>"><br><br>

    <input name="submit" type="submit" value="Update Profile">
  </form>
  </div>
</body>
</html>