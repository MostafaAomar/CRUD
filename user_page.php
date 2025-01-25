<?php
session_start();

if (!isset($_SESSION['user_name'])) {
    header('location:login_form.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>User Page</title>
</head>

<body>
    <div class="container">
        <h1>Welcome <span><?php echo $_SESSION['user_name']; ?></span></h1>
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>
</body>

</html>