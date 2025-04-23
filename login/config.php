<?php
// Database configuration
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'daycare_db';

// Create connection without database
$conn = new mysqli($db_host, $db_user, $db_pass);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database if it doesn't exist
$sql = "CREATE DATABASE IF NOT EXISTS $db_name";
if ($conn->query($sql) === TRUE) {
    // Select the database
    $conn->select_db($db_name);
    
    // Create users table if it doesn't exist
    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) UNIQUE NOT NULL,
        password VARCHAR(255) NOT NULL,
        gender ENUM('male', 'female', 'others') NOT NULL,
        role ENUM('parent', 'volunteer') NOT NULL,
        full_name VARCHAR(100),
        email VARCHAR(100),
        phone VARCHAR(20),
        address TEXT,
        occupation VARCHAR(100),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    
    if (!$conn->query($sql)) {
        die("Error creating table: " . $conn->error);
    }
    
    // Check if new columns exist, if not add them
    $result = $conn->query("SHOW COLUMNS FROM users LIKE 'full_name'");
    if ($result->num_rows == 0) {
        $conn->query("ALTER TABLE users ADD COLUMN full_name VARCHAR(100)");
    }
    
    $result = $conn->query("SHOW COLUMNS FROM users LIKE 'email'");
    if ($result->num_rows == 0) {
        $conn->query("ALTER TABLE users ADD COLUMN email VARCHAR(100)");
    }
    
    $result = $conn->query("SHOW COLUMNS FROM users LIKE 'phone'");
    if ($result->num_rows == 0) {
        $conn->query("ALTER TABLE users ADD COLUMN phone VARCHAR(20)");
    }
    
    $result = $conn->query("SHOW COLUMNS FROM users LIKE 'address'");
    if ($result->num_rows == 0) {
        $conn->query("ALTER TABLE users ADD COLUMN address TEXT");
    }
    
    $result = $conn->query("SHOW COLUMNS FROM users LIKE 'occupation'");
    if ($result->num_rows == 0) {
        $conn->query("ALTER TABLE users ADD COLUMN occupation VARCHAR(100)");
    }
} else {
    die("Error creating database: " . $conn->error);
}
?> 