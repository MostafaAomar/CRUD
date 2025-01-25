<?php
include 'config.php';

if (isset($_POST['submit'])) {
   $username = $_POST['username'];
   $password = md5($_POST['password']); // Using md5 for simplicity, consider using password_hash() in production
   $email = $_POST['email'];
   $role = 'user'; // Default role

   $users = getUsers();

   // Check if user already exists
   foreach ($users as $user) {
      if ($user['email'] === $email) {
         echo "User already exists!";
         exit();
      }
   }

   // Add new user
   $users[] = [
      'username' => $username,
      'password' => $password,
      'email' => $email,
      'role' => $role
   ];

   saveUsers($users);

   echo "User registered successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="style.css">
   <title>Register Form</title>
</head>

<body>
   <div class="form-container">
      <form method="post">
         <h3>Register Now</h3>
         <input type="text" name="username" required placeholder="Enter your name">
         <input type="email" name="email" required placeholder="Enter your email">
         <input type="password" name="password" required placeholder="Enter your password">
         <input type="submit" name="submit" value="Register Now" class="form-btn">
         <p>Already have an account? <a href="login_form.php">Login now</a></p>
      </form>
   </div>
</body>

</html>