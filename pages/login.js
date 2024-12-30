document.getElementById('loginForm').addEventListener('submit', function(e) {
  e.preventDefault();

  // Collect input values
  const email = document.getElementById('email').value.trim();
  const password = document.getElementById('password').value.trim();

  // Validate input fields
  if (!email || !password) {
    alert('Please fill in all fields.');
    return;
  }

  // Create data object
  const userData = {
    email,
    password,
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
