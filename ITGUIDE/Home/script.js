$(document).ready(function() {
    $('#signupForm').submit(function(event) 
    {
      var password = $('#password').val();
      var confirmPassword = $('#confirmPassword').val();
  
      // Validate password confirmation
      if (password !== confirmPassword) 
      {
        alert('Passwords do not match.');
        event.preventDefault(); // Prevent form submission
      }
    });
  });