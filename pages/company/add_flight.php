<?php
include '../../config.php';
session_start();

if (!isset($_SESSION["user_id"])) {
    echo "Login first <a href='../login.php'>Login</a>";
    exit();
}

$userId = $_SESSION["user_id"];
echo "User ID: $userId";
$query = "SELECT user_type FROM users WHERE user_id = '$userId'";
$result = mysqli_query($conn, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    if ($row['user_type'] != 'Company') {
        echo "Access denied. Only company users can add flights.";
        exit();
    }
} else {
    echo "Error fetching user type: " . mysqli_error($conn);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn'])) {
    $flightName = mysqli_real_escape_string($conn, $_POST['flightName']);
    $flightNumber = mysqli_real_escape_string($conn, $_POST['flightNumber']);
    $itinerary = mysqli_real_escape_string($conn, $_POST['itinerary']);
    $passengerCapacity = mysqli_real_escape_string($conn, $_POST['passengerCapacity']);
    $registered = mysqli_real_escape_string($conn, $_POST['registered']);
    $fees = mysqli_real_escape_string($conn, $_POST['fees']);
    $pending = mysqli_real_escape_string($conn, $_POST['pending']);
    $startDate = mysqli_real_escape_string($conn, $_POST['startDate']);
    $startTime = mysqli_real_escape_string($conn, $_POST['startTime']);
    $endDate = mysqli_real_escape_string($conn, $_POST['endDate']);
    $endTime = mysqli_real_escape_string($conn, $_POST['endTime']);
    $from = mysqli_real_escape_string($conn, $_POST['from']);
    $to = mysqli_real_escape_string($conn, $_POST['to']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    $allowedStatuses = ['scheduled', 'cancelled', 'completed'];
    if (!in_array($status, $allowedStatuses)) {
        echo "<script>alert('Invalid status value');</script>";
        exit();
    }

    $q = "INSERT INTO `flights` (`name`, `flight_number`, `itinerary`, `passenger_capacity`, `registered_passengers`, `fees`, `pending_passengers`, `start_date`, `start_time`, `end_date`, `end_time`, `From`, `To`, `status`) 
    VALUES ('$flightName', '$flightNumber', '$itinerary', '$passengerCapacity', '$registered', '$fees', '$pending', '$startDate', '$startTime', '$endDate', '$endTime', '$from', '$to', '$status')";

    if (mysqli_query($conn, $q)) {
        $flightQuery = "SELECT flight_id FROM flights ORDER BY flight_id DESC LIMIT 1";
        $flightResult = mysqli_query($conn, $flightQuery);

        if ($flightResult && mysqli_num_rows($flightResult) > 0) {
            $flightRow = mysqli_fetch_assoc($flightResult);
            $flightId = $flightRow['flight_id'];
            echo "Flight ID: $flightId";

            $insertCompanyQuery = "INSERT INTO `companies` (`company_id`, `flight_id`) VALUES ('$userId', '$flightId')";

            if (mysqli_query($conn, $insertCompanyQuery)) {
                echo "<script>alert('Company and flight linked successfully');</script>";
                header('Location: ./home.php');
                exit();
            } else {
                echo "<script>alert('Error inserting into companies: " . mysqli_error($conn) . "');</script>";
            }
        } else {
            echo "<script>alert('Error fetching flight ID: " . mysqli_error($conn) . "');</script>";
        }
    } else {
        echo "<script>alert('Error inserting flight: " . mysqli_error($conn) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <form action="add_flight.php" method="post">
    <label for="flightName">Flight Name:</label>
    <input type="text" id="flightName" name="flightName" required><br><br>

    <label for="flightNumber">Flight Number:</label>
    <input type="text" id="flightNumber" name="flightNumber" required><br><br>

    <label for="itinerary">Itinerary:</label>
    <input type="text" id="itinerary" name="itinerary" required><br><br>

    <label for="passengerCapacity">Passenger Capacity:</label>
    <input type="number" id="passengerCapacity" name="passengerCapacity" required><br><br>

    <label for="registered">Registered:</label>
    <input type="text" id="registered" name="registered" required><br><br>

    <label for="fees">Fees:</label>
    <input type="number" id="fees" name="fees" required><br><br>

    <label for="pending">Pending:</label>
    <input type="text" id="pending" name="pending" required><br><br>

    <label for="startDate">Start Date:</label>
    <input type="date" id="startDate" name="startDate" required><br><br>

    <label for="startTime">Start Time:</label>
    <input type="time" id="startTime" name="startTime" required><br><br>

    <label for="endDate">End Date:</label>
    <input type="date" id="endDate" name="endDate" required><br><br>

    <label for="endTime">End Time:</label>
    <input type="time" id="endTime" name="endTime" required><br><br>

    <label for="from">From:</label>
    <input type="text" id="from" name="from" required><br><br>

    <label for="to">To:</label>
    <input type="text" id="to" name="to" required><br><br>

    <label for="status">Status:</label>
    <input type="text" id="status" name="status" placeholder="scheduled, cancelled, completed" required><br><br>

    <input type="submit" name="btn" value="Add Flight">
  </form>
</body>
</html>