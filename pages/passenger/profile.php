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

  if(isset($_POST['submit'])) {
    $name = $_POST['name'];
    $user_type = $_POST['user_type'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $update_profile_sql = "UPDATE users SET name = ?, user_type = ?, email = ?, phone = ?, address = ? WHERE user_id = ?";
    $stmt = $conn->prepare($update_profile_sql);
    $stmt->bind_param("sssssi", $name, $user_type, $email, $phone, $address, $user_id);
    $stmt->execute();
    $stmt->close();
  }
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
  <h1>Passenger Profile</h1>
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

    <input name="submit" type="submit" value="Update Profile">
  </form>
</body>
</html>