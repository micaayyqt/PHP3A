<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: Index.php");
    exit();
}

// Database connection
$host = "localhost"; // Change if needed
$user = "root"; // Your database username
$password = ''; // Your database password
$database = "db3a"; // Your database name

$conn = new mysqli($host, $user, $password, $database); // Use $password and $database

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// CSRF Token generation
if (empty($_SESSION['csrf_token'])) {
    // Check if random_bytes exists
    if (function_exists('random_bytes')) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    } else {
        // Fallback for older versions
        $_SESSION['csrf_token'] = bin2hex(openssl_random_pseudo_bytes(16));
    }
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check CSRF token
    if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        die('CSRF token mismatch.');
    }

    $userId = $_SESSION['user_id']; // Assuming you store user ID in session
    $newPassword = $_POST['new_password'];

    // Validate password strength
    if (strlen($newPassword) < 8 || !preg_match("/[a-z]/i", $newPassword) || !preg_match("/[0-9]/", $newPassword)) {
        echo "Password must be at least 8 characters long and contain both letters and numbers.";
    } else {
        // Hash the new password
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Update the password in the database
        $stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
        $stmt->bind_param("si", $hashedPassword, $userId);

        if ($stmt->execute()) {
            echo "Password updated successfully.";
        } else {
            echo "Error updating password: " . $stmt->error;
        }

        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
</head>
<body>

<h2>Change Password</h2>
<form method="post" action="">
    <label for="new_password">New Password:</label>
    <input type="password" name="new_password" required>
    <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
    <button type="submit">Change Password</button>
</form>

</body>
</html>