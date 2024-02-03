<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database configuration
$host = '127.0.0.1'; 
$port = '3310'; 
$dbname = 'smart_india'; 
$username = 'root'; 
$password = ''; 

// Create a database connection
$connection = new mysqli($host, $username, $password, $dbname, $port);

// Check the connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $message = htmlspecialchars($_POST['message']);
    
    if (empty($name) || empty($email) || empty($message)) {
        echo "Please fill in all the fields.";
    } else {
        $query = "INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)";
        
        // Prepare the statement
        $stmt = $connection->prepare($query);
        
        if ($stmt) {
            // Bind parameters
            $stmt->bind_param("sss", $name, $email, $message);
            
            // Execute the statement
            if ($stmt->execute()) {
                // Data inserted successfully
                echo "Data saved successfully!";
                    
                // JavaScript pop-up and redirect
                echo '<script>';
                echo 'alert("Data saved successfully!");';
                echo 'window.location.href = "index.html";'; // Redirect to the homepage
                echo '</script>';
                exit;
            } else {
                // Error in data insertion
                echo "Error: " . $stmt->error;
            }
            
            // Close the statement
            $stmt->close();
        } else {
            // Error in preparing the statement
            echo "Error: " . $connection->error;
        }
    }
}

// Close the database connection
$connection->close();
?>
