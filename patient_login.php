<?php
// Database connection parameters
$host = '127.0.0.1';
$port = '3310';
$dbname = 'smart_india';
$username = 'root';
$password = '';

// Attempt to connect to the database
try {
    $db = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Perform user authentication against the "users" table
    $query = "SELECT * FROM patient_users WHERE username = :username AND password = :password";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
    
    // Check if a matching user was found
    if ($stmt->rowCount() > 0) {
        // User is authenticated, you can redirect to a dashboard or another page
        header("Location: Patients dashboard.html");
        exit();
    } else {
        // Authentication failed, you can display an error message or redirect to a login error page
        echo "Authentication failed. Please check your username and password.";
    }
}
?>
