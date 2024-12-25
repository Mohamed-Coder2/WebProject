<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Booking</title>
  <link rel="stylesheet" href="index.css">
  <link rel="icon" href="./icon.png" type="image/x-icon">
</head>
<body>
  <div class="Routes">
    <div class="loginRoutes">
      <a href="./pages/login.html">login</a>
      <a href="./pages/register.html">register</a>
    </div>
    <div class="companyRoutes">
      <a href="./pages/company/home.html">Company Home</a>
      <a href="./pages/company/profile.html">Company Profile</a>
    </div>
    <div class="passengerRoutes">
      <a href="./pages/passenger/home.html">Passenger Home</a>
      <a href="./pages/passenger/profile.html">Passenger Profile</a>
    </div>
  </div>

  <?php
    $connection = pg_connect("host=localhost dbname=webproject user=postgres password=100603");
    if(!$connection) {
      echo "DB Connection Failed";
      exit;
    }
  ?>
</body>
</html>