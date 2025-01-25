<?php
include 'config.php';

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $users = getUsers();

    foreach ($users as $user) {
        if ($user['email'] === $email && $user['password'] === $password) {
            if ($user['role'] === 'admin') {
                $_SESSION['admin_name'] = $user['username'];
                header('Location: admin_page.php');
                exit();
            } else {
                $_SESSION['user_name'] = $user['username'];
                header('Location: user_page.php');
                exit();
            }
        }
    }

    $error[] = 'Incorrect email or password!';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login Page</title>
</head>

<body>
    <div class="form-container">
        <form method="post">
            <h3>Login Now</h3>
            <?php
            if (isset($error)) {
                foreach ($error as $err) {
                    echo '<span class="error-msg">' . $err . '</span>';
                }
            }
            ?>
            <input type="email" name="email" required placeholder="Enter your email">
            <input type="password" name="password" required placeholder="Enter your password">
            <input type="submit" name="submit" value="Login Now" class="form-btn">
            <p>Don't have an account? <a href="index.html">Register now</a></p>
        </form>
    </div>
</body>

</html>