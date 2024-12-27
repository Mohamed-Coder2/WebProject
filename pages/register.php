<?php 
  include '../config.php';

  if(isset($_POST['btn'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $userType = $_POST['userType'];

    $create_user_sql = "INSERT INTO `users` (`user_type`, `name`, `email`, `password`, `phone`) VALUES (?, ?, ?, ?, ?)";
                        $stmt = $conn->prepare($create_user_sql);
                        $stmt->bind_param("sssss", $userType, $name, $email, $password, $phone);
                        $stmt->execute();
                        $stmt->close();
    if($create_user_sql) {
      echo "<script>alert('Data inserted')</script>";
    }
    else {
      echo "<script>alert('Error Inserting Data')</script>";
    }
  }
  else {
    echo "<p>Not in IF</p>";
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Booking</title>
  <link rel="stylesheet" href="./register.css">
  <link rel="icon" href="../icon.png" type="image/x-icon">
</head>
<body>
  <p>Go to <a href="../index.php">HOME</a></p>
  <div class="container">
    <div class="cont">
      <h1>Register</h1>
      <div class="Form">
        <form id="registerForm" method="POST" action="register.php">
          <input name="name" id="name" placeholder="Name" type="text" required>
          <input name="email" id="email" placeholder="Email" type="email" required>
          <input name="password" id="password" placeholder="Password" type="password" required>
          <input name="phone" id="phone" placeholder="Phone" type="tel" required>

          <div>
            <label for="company">Company</label>
            <input name="userType" id="company" type="radio" value="Company">
            <label for="passenger">Passenger</label>
            <input name="userType" id="passenger" type="radio" value="Passenger">
          </div>
          <p>Have an Account? <a href="./login.php">Login Here</a></p>
          <button name="btn" type="submit">Submit</button>
        </form>
      </div>
    </div>
  </div>
  <!-- <script src="./register.js"></script> -->
</body>
</html>