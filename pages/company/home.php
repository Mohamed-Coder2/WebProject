
<?php 
  include '../../config.php';
  session_start();
  if(isset($_SESSION["user_id"])){
  $con = mysqli_connect("localhost", "root", "", "webProject");
  $user_id = $_SESSION['user_id'];
  $sql_query = "SELECT * FROM users WHERE user_id = '$user_id' AND user_type = 'company'";
  $result = mysqli_query($conn, $sql_query);

  $row = mysqli_fetch_assoc($result);
  $name = $row['name'];
  $user_type = $row['user_type'];
  $email = $row['email'];
  $phone = $row['phone'];
  $address = $row['address'];
  $password = $row['password'];
  $bio = $row['bio'];
  $location = $row['location'];

    echo "
    <html>
      <head>
        <title>Company Home</title>
      <h1>Company Home</h1>
      <div>
        <h2>Company Name: $name</h2>
        <h2>Email: $email</h2>
        <h2>Password: $password</h2>
        <h4>Phone: $phone</h4>
        <h4>Address: $address</h4>
        <h4>Bio: $bio</h4>
        <h4>Location: $location</h4>
        <a href='./add_flight.php'>Add flight</a>
        <br>
        <a href='./profile.php'>Profile</a>
      </div>
    </html>
    
    ";
  echo "<a href='../logout.php'>Logout</a>";

  }else{
    echo "Login in first <a href='../login.php'>Login</a>";
  }
?>

