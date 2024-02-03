<?php
$host = '127.0.0.1';
$port = '3310';
$dbname = 'smart_india';
$username = 'root';
$password = '';

try {
  // Create a PDO database connection
  $conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Check if the form has been submitted
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve user input from the form
    $full_name = $_POST['full-name'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password for security
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $blood_group = $_POST['blood-group'];
    $dob = $_POST['dob'];
    $phone_number = $_POST['phone-number'];
    $email = $_POST['email'];

    // Generate a unique patient ID
    
    // SQL query to insert user data into the table
    $sql = "INSERT INTO patient_users (full_name, username, password, age, gender, blood_group, dob, phone_number, email)
      VALUES (:full_name, :username, :password, :age, :gender, :blood_group, :dob, :phone_number, :email)";

    $stmt = $conn->prepare($sql);

    // Bind parameters to the SQL statement
    $stmt->bindParam(':full_name', $full_name);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':age', $age);
    $stmt->bindParam(':gender', $gender);
    $stmt->bindParam(':blood_group', $blood_group);
    $stmt->bindParam(':dob', $dob);
    $stmt->bindParam(':phone_number', $phone_number);
    $stmt->bindParam(':email', $email);
    

    // Execute the SQL statement
    $stmt->execute();

    // Redirect to a success page after data insertion
    header("Location: Loginsuccess.html");
    exit(); // Ensure no further code execution after redirection
  }
} catch (PDOException $e) {
  // Handle database connection errors
  echo "Error: " . $e->getMessage();
}

?>
