<?php 
  include '../../config.php';
  session_start();

  $user_id = $_SESSION['user_id'];
  $sql_query = "SELECT * FROM users WHERE user_id = '$user_id'";
  $result = mysqli_query($conn, $sql_query);

  $row = mysqli_fetch_assoc($result);
  $name = $row['name'];
  $user_type = $row['user_type'];
  $email = $row['email'];
  $phone = $row['phone'];
  $address = $row['address'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Booking</title>
  <link rel="stylesheet" href="index.css">
  <link rel="icon" href="../../icon.png" type="image/x-icon">
</head>
<body>
  <h1>Passenger Home</h1>
  <div>
    <h2><?php echo "Name: " . $name ?></h2>
    <h2><?php echo "Email: " . $email ?></h2>
    <img src="" alt="your img" width="50" height="50">
    <h4><?php echo "Phone: " . $phone ?></h4>
    <h3>another list? what do you want</h3>
    <h4>your flights</h4>
    <a href="./profile.php">Profile</a>
  </div>
</body>
</html>