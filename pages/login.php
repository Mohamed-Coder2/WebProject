<?php 
  include '../config.php';
  session_start();

  if(isset($_POST['btn'])) 
  {
    $con = mysqli_connect("localhost", "root", "", "webProject");
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql_username_profile = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $sql_username_profile);
    if(mysqli_num_rows($result) == 1)
    {
      $row = mysqli_fetch_assoc($result);
      $user_type = $row['user_type'];
      $_SESSION['user_id'] = $row['user_id'];

      if($user_type == "Passenger") 
      {
        header('Location: passenger/home.php');
      }
      else if($user_type == "Company") 
      {
        header('Location: company/home.php');
      }
    }
    else {
      echo "<p>the email or password is not correct</p>";
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Booking</title>
  <link rel="stylesheet" href="./login.css">
  <link rel="icon" href="../icon.png" type="image/x-icon">
</head>
<body>
  <p>Go to <a href="../index.php">HOME</a></p>
  <div class="container">
    <div class="cont">
      <h1>Login</h1>
      <div class="Form">
        <form id="loginForm" method="POST" action="login.php">
          <input name="email" id="email" placeholder="Email" type="text">
          <input name="password" id="password" placeholder="Password" type="password">
          <p>No Account? <a href="./register.php">Register Here</a></p>
          <button name="btn" type="submit">Login</button>
        </form>
      </div>
    </div>
  </div>

  <!-- <script src="./login.js"></script> -->
</body>
</html>