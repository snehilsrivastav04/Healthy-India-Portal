<?php
// Establish a database connection (You need to configure your database connection)

// Database configuration
$servername = '127.0.0.1'; // Use 'localhost' for local connections
$port = '3310'; // Replace with your database server port if it's not the default (3306)
$dbname = 'smart_india'; 
$username = 'root'; 
$password = ''; 

try {
    $conn = new mysqli("$servername:$port", $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $full_name = $_POST["full-name"];
        $registration_number = $_POST["registration-number"];
        $username = $_POST["username"];
        $password = $_POST["password"];
        $specialization = $_POST["specialization"];
        $age = $_POST["age"];
        $availability_start = $_POST["availability-start"];
        $availability_end = $_POST["availability-end"];
        $pincode = $_POST["pincode"];

        // Insert data into the database
        $sql = "INSERT INTO doctors (full_name, registration_number, username, password, specialization, age, availability_start, availability_end, pincode)
                VALUES ('$full_name', '$registration_number', '$username', '$password', '$specialization', '$age', '$availability_start', '$availability_end', '$pincode')";

        if ($conn->query($sql) === TRUE) {
            
                    
                // JavaScript pop-up and redirect
                echo '<script>';
                echo 'alert("Data saved successfully!");';
                echo 'window.location.href = "index.html";'; // Redirect to the homepage
                echo '</script>';
        } else {
            throw new Exception("Error: " . $sql . "<br>" . $conn->error);
        }
    }
    
    // Close the database connection
    $conn->close();
} catch (Exception $e) {
    echo "An error occurred: " . $e->getMessage();
}
?>
