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
