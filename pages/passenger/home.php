<?php 
include '../../config.php';
session_start();
if (isset($_SESSION["user_id"])) {
  $user_id = $_SESSION['user_id'];
  $sql_query = "SELECT * FROM users WHERE user_id = '$user_id' AND user_type = 'passenger'";
  $result = mysqli_query($conn, $sql_query);
  
  $row = mysqli_fetch_assoc($result);
  $name = $row['name'];
  $user_type = $row['user_type'];
  $email = $row['email'];
  $phone = $row['phone'];
  $address = $row['address'];
  $password = $row['password'];

  // Handle search input
  $search_term = isset($_POST['search_flight']) ? mysqli_real_escape_string($conn, $_POST['search_flight']) : '';
  
  // Modify flights query based on the search term
  $flights_query = "SELECT * FROM flights";
  if (!empty($search_term)) {
    $flights_query .= " WHERE name LIKE '%$search_term%'";
  }
  $flights_result = mysqli_query($conn, $flights_query);

  echo "<h1>Passenger Home</h1>";
  echo "<h2>Welcome, $name</h2>";
  
  // Search bar form
  echo "
    <form method='POST' action=''>
      <input type='text' name='search_flight' placeholder='Search for flights' value='$search_term'>
      <input type='submit' value='Search'>
    </form>
  ";

  if (mysqli_num_rows($flights_result) > 0) {
    echo "<h4>Available Flights</h4>";
    echo "<table border='1'>
        <tr>
          <th>Flight Name</th>
          <th>Flight Number</th>
          <th>Fees</th>
          <th>Departure</th>
          <th>Action</th>
        </tr>";
    while ($flight = mysqli_fetch_assoc($flights_result)) {
      echo "<tr>
          <td>{$flight['name']}</td>
          <td>{$flight['flight_number']}</td>
          <td>{$flight['fees']}</td>
          <td>{$flight['start_date']}</td>
          <td>
            <form method='POST' action=''>
              <input type='hidden' name='flight_id' value='{$flight['flight_id']}'>
              <input type='submit' name='book_flight' value='Book'>
            </form>
          </td>
          </tr>";
    }
    echo "</table>";
  } else {
    echo "<p>No flights available.</p>";
  }

  if (isset($_POST['book_flight'])) {
    $flight_id = $_POST['flight_id'];
    $book_query = "INSERT INTO `passengers` (passenger_id, flight_id) VALUES ('$user_id', '$flight_id')";
    if (mysqli_query($conn, $book_query)) {
      echo "<p>Flight booked successfully!</p>";
    } else {
      echo "<p>Error booking flight: " . mysqli_error($conn) . "</p>";
    }
  }

  $flight_query = "SELECT flight_id FROM passengers WHERE passenger_id = '$user_id'";
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
  <div>
    <h4>Your Flights</h4>";
  foreach ($flights_data as $flight) {
    echo "
      <li>
        <h4>Flight Name: {$flight['name']}</h4>
        <p>Destination: {$flight['flight_number']}</p>
        <p>Departure: {$flight['fees']}</p>
        <p>Arrival: {$flight['start_date']}</p>
        <p>Price: {$flight['end_date']}</p>
      </li>";
  }
  echo "
    <a href='./profile.php'>Profile</a>
  </div>
  ";
  echo "<a href='../logout.php'>Logout</a>";

} else {
  echo "Login in first <a href='../login.php'>Login</a>";
}
?>
