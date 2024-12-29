<?php 
  include '../../config.php';
  session_start();
  
  if(isset($_SESSION["user_id"])){
    $user_id = $_SESSION['user_id'];
    $info_query = "SELECT * FROM users WHERE user_id = '$user_id' AND user_type = 'company'";
    $result = mysqli_query($conn, $info_query);

    $row = mysqli_fetch_assoc($result);
    $name = $row['name'];
    $user_type = $row['user_type'];
    $email = $row['email'];
    $phone = $row['phone'];
    $address = $row['address'];
    $password = $row['password'];
    $bio = $row['bio'];
    $location = $row['location'];

    $flight_query = "SELECT flight_id FROM companies WHERE company_id = '$user_id'";
    $flights_result = mysqli_query($conn, $flight_query);
    $flight_ids = array();

    while ($row = mysqli_fetch_assoc($flights_result)) {
      $flight_ids[] = $row['flight_id'];
    }

    $flights_data = array();
    if (!empty($flight_ids)) {
      foreach ($flight_ids as $flight_id) {
      $flight_data_query = "SELECT * FROM flights WHERE flight_id = '$flight_id'";
      $flight_data_result = mysqli_query($conn, $flight_data_query);
      if ($flight_data_result) {
        $flights_data[] = mysqli_fetch_assoc($flight_data_result);
      }
      }
    }

  echo "
    <html>
    <head>
      <title>Company Home</title>
    </head>
    <body>
      <h1>Company Home</h1>
      <div>
        <h2>Company Name: $name</h2>
        <h2>Email: $email</h2>
        <h2>Password: $password</h2>
        <h4>Phone: $phone</h4>
        <h4>Address: $address</h4>
        <h4>Bio: $bio</h4>
        <h4>Location: $location</h4>
        <h3>Flights:</h3>
      <ul>";

  foreach ($flights_data as $flight) {
    echo "
    <li>
      <h4>Flight ID: {$flight['name']}</h4>
      <p>Destination: {$flight['flight_number']}</p>
      <p>Departure: {$flight['fees']}</p>
      <p>Arrival: {$flight['start_date']}</p>
      <p>Price: {$flight['end_date']}</p>
    </li>";
  }

  echo "
    </ul>
    <a href='./add_flight.php'>Add flight</a>
    <br>
    <a href='./profile.php'>Profile</a>
    </div>
    <a href='../logout.php'>Logout</a>
    </body>
    </html>";
  } else {
    echo "Log in first <a href='../login.php'>Login</a>";
  }
?>

