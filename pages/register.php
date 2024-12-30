<?php
$con = mysqli_connect("localhost", "root", "", "webProject");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userType = $_POST['userType'];

    if ($userType == 'Company') {
        $companyName = $_POST['companyName'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $phone = $_POST['phone'];
        $bio = $_POST['bio'];
        $address = $_POST['address'];
        $location = $_POST['location'];

        // $logo = $_POST['logo'];

        $q = "INSERT INTO `users` (`user_type`, `name`, `email`, `password`, `phone`, `bio`, `address`, `location`) VALUES ('$userType', '$companyName', '$email', '$password', '$phone', '$bio', '$address', '$location')";
    } else {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $phone = $_POST['phone'];
        // $passportImg = $_POST['passportImg'];

        $q = "INSERT INTO `users` (`user_type`, `name`, `email`, `password`, `phone`) VALUES ('$userType', '$name', '$email', '$password', '$phone')";
    }

    if (mysqli_query($con, $q)) {
        echo "<script>alert('Data inserted')</script>";
        header('Location: login.php');
    } else {
        echo "<script>alert('Error Inserting Data: " . mysqli_error($con) . "')</script>";
    }

    mysqli_close($con);
} else {
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
    <input name="userType" id="passenger" type="radio" value="Passenger" checked>
  </div>
    <script defer>
      const selectedRadio = document.querySelectorAll('input[type="radio"]');
      const form = document.querySelector("#registerForm");

      function addCompanyFields() {
        const fields = [
          { name: "companyName", placeholder: "Company Name", type: "text" },
          { name: "bio", placeholder: "Bio", type: "text" },
          { name: "address", placeholder: "Address", type: "text" },
          { name: "location", placeholder: "Location (optional)", type: "text" },
          { name: "password", placeholder: "Password", type: "password" },
          { name: "email", placeholder: "Email", type: "email" },
          { name: "phone", placeholder: "phone", type: "phone" },
          { name: "logo", placeholder: "Logo Image", type: "file" },
          
        ];

        fields.forEach(field => {
          const input = document.createElement("input");
          input.setAttribute("name", field.name);
          input.setAttribute("placeholder", field.placeholder);
          input.setAttribute("type", field.type);
          if (field.name !== "location") input.required = true;
          form.appendChild(input);
        });
      }

      function addPassengerFields() {
        const fields = [
          { name: "name", placeholder: "Name", type: "text" },
          { name: "email", placeholder: "Email", type: "email" },
          { name: "password", placeholder: "Password", type: "password" },
          { name: "phone", placeholder: "phone", type: "text" },
          { name: "passportImg", placeholder: "Passport Image", type: "file" },
        
        ];

        fields.forEach(field => {
          const input = document.createElement("input");
          input.setAttribute("name", field.name);
          input.setAttribute("placeholder", field.placeholder);
          input.setAttribute("type", field.type);
          input.required = true;
          form.appendChild(input);
          
        });
      }

      function removeFields() {
          const inputs = form.querySelectorAll('input[name]:not([name="userType"])');
          inputs.forEach(input => input.remove());
      }

      function handleRadioChange(e) {
        removeFields();
        if (e.target.value === "Company") {
          addCompanyFields();
        } else {
          addPassengerFields();
        }
        addSubmitButton();
      }

      function addSubmitButton() {
        let submitButton = form.querySelector('button[type="submit"]');
        if (!submitButton) {
          submitButton = document.createElement("button");
          submitButton.setAttribute("name", "btn");
          submitButton.setAttribute("type", "submit");
          submitButton.textContent = "Submit";
          form.appendChild(submitButton);
        } else {
          form.appendChild(submitButton);
        }
      }

      selectedRadio.forEach(element => {
        element.addEventListener("change", handleRadioChange);
      });

      // Check the selected radio button on page load
      selectedRadio.forEach(e => {
        if (e.checked) {
          handleRadioChange({ target: e });
        }
      });
    </script>
            
          </form>
        </div>
      </div>
    </div>
    <!-- <script src="./register.js"></script> -->
  </body>
</html>