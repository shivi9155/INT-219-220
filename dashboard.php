<?php
session_start();

// Check if the user is enrolled
if (!isset($_SESSION['enrolled']) || $_SESSION['enrolled'] !== true) {
    header("Location: index.php"); // Redirect to the form if not enrolled
    exit();
}

// Retrieve the enrollment data from the session
$parentFirstName = $_SESSION['parentFirstName'];
$parentLastName = $_SESSION['parentLastName'];
$parentEmail = $_SESSION['parentEmail'];
$parentPhone = $_SESSION['parentPhone'];
$childFirstName = $_SESSION['childFirstName'];
$childLastName = $_SESSION['childLastName'];
$childDOB = $_SESSION['childDOB'];
$programType = $_SESSION['programType'];
$startDate = $_SESSION['startDate'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Daycare Enrollment - Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="style copy.css">
</head>
<body>
  <div class="container">
    <div class="header text-center">
      <h1 class="font-bold">You Are Already Enrolled!</h1>
      <p class="mt-3">Thank you for enrolling in our daycare program. Here are the details:</p>
    </div>

    <div class="enrollment-summary">
      <h2 class="font-bold text-lg">Parent Information</h2>
      <p><strong>Name:</strong> <?= htmlspecialchars($parentFirstName) . ' ' . htmlspecialchars($parentLastName) ?></p>
      <p><strong>Email:</strong> <?= htmlspecialchars($parentEmail) ?></p>
      <p><strong>Phone:</strong> <?= htmlspecialchars($parentPhone) ?></p>

      <h2 class="font-bold text-lg mt-4">Child Information</h2>
      <p><strong>Child's Name:</strong> <?= htmlspecialchars($childFirstName) . ' ' . htmlspecialchars($childLastName) ?></p>
      <p><strong>Date of Birth:</strong> <?= htmlspecialchars($childDOB) ?></p>

      <h2 class="font-bold text-lg mt-4">Program Information</h2>
      <p><strong>Program Type:</strong> <?= htmlspecialchars($programType) ?></p>
      <p><strong>Start Date:</strong> <?= htmlspecialchars($startDate) ?></p>
    </div>

    <div class="mt-4 text-center">
      <a href="index.php" class="btn-secondary inline-flex items-center rounded-lg">
        <i class="fas fa-arrow-left mr-2"></i> Go Back to Enrollment Form
      </a>
    </div>
  </div>
</body>
</html>
