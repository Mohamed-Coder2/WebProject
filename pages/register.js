document.getElementById('registerForm').addEventListener('submit', async function (e) {
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
});
