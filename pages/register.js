document.getElementById('registerForm').addEventListener('submit', function(e) {
  e.preventDefault();

  const name = document.getElementById('name').value.trim();
  const email = document.getElementById('email').value.trim();
  const password = document.getElementById('password').value.trim();
  const phone = document.getElementById('phone').value.trim();
  const userType = document.querySelector('input[name="userType"]:checked'); // Selected radio button

  if (!name || !email || !password || !phone) {
    alert('Please fill in all fields.');
    return;
  }

  if (!userType) {
    alert('Please select either Company or Passenger.');
    return;
  }

  const userData = {
    name,
    email,
    password,
    phone,
    userType: userType.value,
  };

  console.log('Form Data:', userData);

  // fetch('https://database-endpoint.com/register', {
  //   method: 'POST',
  //   headers: {
  //     'Content-Type': 'application/json',
  //   },
  //   body: JSON.stringify(userData),
  // })
  //   .then(response => response.json())
  //   .then(data => {
  //     console.log('Success:', data);
  //     alert('Registration successful!');
  //   })
  //   .catch(error => {
  //     console.error('Error:', error);
  //     alert('Registration failed!');
  //   });
});
