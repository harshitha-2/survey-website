<?php
// Replace these with your RDS database credentials
$host = 'database123.c5ggywjdqkq1.us-east-1.rds.amazonaws.com';
$dbname = 'database123';
$username = 'harshitha';
$password = 'harshu2003';

try {
    // Create a PDO database connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Process the submitted survey data (assuming a POST request)
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $feedback = $_POST['feedback'];

        // Insert the data into the database
        $sql = "INSERT INTO survey_responses (name, email, feedback) VALUES (:name, :email, :feedback)";
        $stmt = $pdo->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':feedback', $feedback);

        // Execute the SQL statement
        if ($stmt->execute()) {
            echo 'Survey response submitted successfully!';
        } else {
            echo 'Error: ' . $stmt->errorInfo()[2];
        }
    }
} catch (PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
}
?>
