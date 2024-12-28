<?php
  include '../../config.php';
  session_start();
  if(isset($_SESSION["user_id"])){
    $user_id = $_SESSION['user_id'];
    $con = mysqli_connect("localhost", "root", "", "webProject");
    $flightName=$_POST['flightName'];
    $flightID=$_POST['flightID'];
    $itinerary=$_POST['itinerary'];
    $registered=$_POST['registered'];
    $pending=$_POST['pending'];
    $fees=$_POST['fees'];
    $startDate=$_POST['startDate'];
    $endDate=$_POST['endDate'];
    $perCity=$_POST['perCity'];
    $status=$_POST['status'];
    // $sql_query = "INSERT INTO flights (flightName,flightID,itinerary,registered,pending,fees,startDate,endDate,perCity,status,company_id) VALUES ('$flightName','$flightID','$itinerary','$registered','$pending','$fees','$startDate','$endDate','$perCity','$status','$user_id') WHERE user_id = '$user_id'";

  }else{
    echo "Login in first <a href='../login.php'>Login</a>";
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="./add_flight.css">
</head>
<body>
<form id="flightForm" method="POST" action="add_flight.php">
  <label for="flightName">Flight Name</label>
  <input type="text" id="flightName" name="flightName" placeholder="Enter flight name" required>

  <label for="flightID">Flight ID</label>
  <input type="text" id="flightID" name="flightID" placeholder="Enter flight ID" required>

  <label for="itinerary">Itinerary (Cities to Pass Through)</label>
  <textarea id="itinerary" name="itinerary" placeholder="Enter cities (comma separated)" rows="3" required></textarea>

  <label for="passengers">Number of Passengers</label>
  <div class="inline">
    <input type="number" id="registered" name="registered" placeholder="Registered" required>
    <input type="number" id="pending" name="pending" placeholder="Pending" required>
  </div>

  <label for="fees">Fees</label>
  <input type="number" id="fees" name="fees" placeholder="Enter fees" required>

  <label for="startDate">Start Date and Hour</label>
  <input type="datetime-local" id="startDate" name="startDate" required>

  <label for="endDate">End Date and Hour</label>
  <input type="datetime-local" id="endDate" name="endDate" required>

  <label for="perCity">Per City Fees (if applicable)</label>
  <input type="text" id="perCity" name="perCity" placeholder="Enter fees per city">

  <label for="status">Completion Status</label>
  <select id="status" name="status">
    <option value="completed">Completed</option>
    <option value="notCompleted">Not Completed</option>
  </select>

  <div class="actions">
    <button type="submit">Submit</button>
    <button type="reset">Reset</button>
  </div>
</form>

</body>
</html>