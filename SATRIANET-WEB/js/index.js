document.getElementById('loginForm').addEventListener('submit', function(event) {
  event.preventDefault();

  const formData = new FormData(event.target);

  fetch('index.php', {
      method: 'POST',
      body: formData
  })
  .then(response => response.json())
  .then(data => {
      if (data.status === 'success') {
          // Redirect to a protected page or show success message
          window.location.href = 'dashboard.php';
      } else {
          // Display error message
          document.getElementById('error-message').textContent = data.message;
      }
  })
  .catch(error => {
      console.error('Error:', error);
      document.getElementById('error-message').textContent = 'An error occurred';
  });
});
