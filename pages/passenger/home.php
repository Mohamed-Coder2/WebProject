<?php 
  include '../../config.php';
  session_start();
  if(isset($_SESSION["user_id"])){
    $user_id = $_SESSION['user_id'];
    $sql_query = "SELECT * FROM users WHERE user_id = '$user_id' AND user_type = 'passenger'";
    $result = mysqli_query($conn, $sql_query);
  
    $row = mysqli_fetch_assoc($result);
    $name = $row['name'];
    $user_type = $row['user_type'];
    $email = $row['email'];
    $phone = $row['phone'];
    $address = $row['address'];
    $password= $row['password'];
    echo "
    <h1>Passenger Home</h1>
    <div>
      <h2>Name: $name </h2>
      <h2>Email: $email </h2>
      <h4>Phone: $phone </h4>
      <h3>another list? what do you want</h3>
      <h4>your flights</h4>
      <a href='./profile.php'>Profile</a>
    </div>
    ";
    echo "<a href='../logout.php'>Logout</a>";

  }else{
    echo "Login in first <a href='../login.php'>Login</a>";
  }

?>
