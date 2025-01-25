<?php
session_start();

// Redirect to login if admin is not logged in
if (!isset($_SESSION['admin_name'])) {
    header('Location: login_form.php');
    exit();
}

$directory = 'mostafa/';
$createdPages = [];

// Handle form submission to add a new page
if (isset($_POST['addPageButton'])) {
    $pageName = trim($_POST['pageName']);

    if (!empty($pageName)) {
        $pageName = filter_var($pageName, FILTER_SANITIZE_SPECIAL_CHARS);
        $newPageName = $directory . $pageName . '.php';

        // Sanitize and prepare page content
        $escapedCode = htmlspecialchars($_POST['pageContent'], ENT_QUOTES, 'UTF-8');
        $newPageContent = '<?php ' . $escapedCode . ' ?>';
        $newPageContent .= '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
            <title>' . $pageName . '</title>
        </head>
        <body>
            <!-- Navbar and other HTML content -->
        </body>
        </html>';

        // Write content to the new file
        file_put_contents($newPageName, $newPageContent);

        // Redirect to prevent form resubmission
        header("Location: admin_page.php");
        exit();
    } else {
        echo 'Page name cannot be empty!';
    }
}

// Get list of created pages
$createdPages = scandir($directory);
$createdPageNames = array_map(function ($page) {
    return pathinfo($page, PATHINFO_FILENAME);
}, array_diff($createdPages, array('..', '.')));
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Admin Page</title>
</head>

<body>
    <!-- Admin page content -->
</body>

</html>