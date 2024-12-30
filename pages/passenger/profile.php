<?php
session_start();

if (isset($_SESSION["user_id"])) {
    $con = mysqli_connect("localhost", "root", "", "webProject");

    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $user_id = (int)$_SESSION['user_id']; // Cast to integer for safety
    $sql_query = "SELECT * FROM users WHERE user_id = '$user_id'";
    $result = mysqli_query($con, $sql_query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $name = htmlspecialchars($row['name']);
        $user_type = htmlspecialchars($row['user_type']);
        $email = htmlspecialchars($row['email']);
        $phone = htmlspecialchars($row['phone']);
        $password = htmlspecialchars($row['password']);
    } else {
        echo "Error fetching user data: " . mysqli_error($con);
        exit;
    }

    if (isset($_POST['submit'])) {
        $name = mysqli_real_escape_string($con, $_POST['name']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $phone = mysqli_real_escape_string($con, $_POST['phone']);
        $password = mysqli_real_escape_string($con, $_POST['password']);

        $update_profile_sql = "
        UPDATE users 
        SET 
            name = '$name', 
            user_type = '$user_type', 
            email = '$email', 
            phone = '$phone', 
            password = '$password' 
        WHERE user_id = $user_id";

        if (mysqli_query($con, $update_profile_sql)) {
            echo "Profile updated successfully.";
        } else {
            echo "Error updating profile: " . mysqli_error($con);
        }
    }
    ?>

    <h1>Passenger Profile</h1>
    <form action="profile.php" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $name; ?>"><br><br>

        <label for="user_type">User Type:</label>
        <input type="text" id="user_type" name="user_type" value="<?php echo $user_type; ?>" readonly><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $email; ?>"><br><br>

        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" value="<?php echo $phone; ?>"><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" value="<?php echo $password; ?>"><br><br>

        <input name="submit" type="submit" value="Update Profile">
    </form>

    <?php
    mysqli_close($con); // Close the database connection
} else {
    echo "Please login first <a href='../login.php'>Login</a>";
}
?>
