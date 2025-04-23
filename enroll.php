<?php
session_start();
require 'db_connection.php';

// Assume user is already logged in
$user_id = $_SESSION['user_id'] ?? null;
if (!$user_id) {
  header("Location: login.php");
  exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Normally you'd sanitize and validate input here
    $programType = $_POST['programType'] ?? '';
    $childName = $_POST['childName'] ?? '';

    // Save enrollment info (simplified)
    $stmt = $conn->prepare("INSERT INTO enrollments (user_id, child_name, program_type) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $user_id, $childName, $programType);
    $stmt->execute();
    $stmt->close();

    // Mark user as enrolled
    $conn->query("UPDATE users SET is_enrolled = 1 WHERE id = $user_id");

    $_SESSION['enrolled'] = true;
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Daycare Enrollment</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css">
</head>
<body class="p-10">
  <h1 class="text-2xl font-bold mb-4">Enroll Your Child</h1>
  <form method="POST" class="space-y-4">
    <div>
      <label class="block">Child Name:</label>
      <input type="text" name="childName" required class="border p-2 rounded w-full">
    </div>
    <div>
      <label class="block">Program Type:</label>
      <select name="programType" required class="border p-2 rounded w-full">
        <option value="">Select Program</option>
        <option value="fullTime">Full Time</option>
        <option value="halfDay">Half Day</option>
        <option value="afterSchool">After School</option>
      </select>
    </div>
    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Submit Enrollment</button>
  </form>
</body>
</html>
