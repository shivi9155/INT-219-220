<?php
session_start();
require_once 'config.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

// Get user information
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Handle profile update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = sanitize_input($_POST['full_name']);
    $email = sanitize_input($_POST['email']);
    $phone = sanitize_input($_POST['phone']);
    $address = sanitize_input($_POST['address']);
    $occupation = sanitize_input($_POST['occupation']);
    
    // Update user information
    $update_sql = "UPDATE users SET full_name = ?, email = ?, phone = ?, address = ?, occupation = ? WHERE id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("sssssi", $full_name, $email, $phone, $address, $occupation, $user_id);
    
    if ($update_stmt->execute()) {
        $success_message = "Profile updated successfully!";
        // Refresh user data
        $stmt->execute();
        $user = $result->fetch_assoc();
    } else {
        $error_message = "Error updating profile: " . $conn->error;
    }
}

// Function to sanitize input
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile - Doodle Desk</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body class="min-h-screen bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-lg p-6 max-w-2xl mx-auto">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-gray-800">User Profile</h1>
                <a href="../index.php" class="bg-pink-500 text-white px-4 py-2 rounded-lg hover:bg-pink-600 transition duration-300">
                    <i class="fas fa-home mr-2"></i>Back to Dashboard
                </a>
            </div>
            
            <?php if (isset($success_message)): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    <?php echo $success_message; ?>
                </div>
            <?php endif; ?>
            
            <?php if (isset($error_message)): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <?php echo $error_message; ?>
                </div>
            <?php endif; ?>
            
            <form method="POST" action="" class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                            Username
                        </label>
                        <input type="text" id="username" value="<?php echo htmlspecialchars($user['username']); ?>" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-pink-500" disabled>
                    </div>
                    
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="full_name">
                            Full Name
                        </label>
                        <input type="text" id="full_name" name="full_name" value="<?php echo isset($user['full_name']) ? htmlspecialchars($user['full_name']) : ''; ?>" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-pink-500">
                    </div>
                    
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                            Email
                        </label>
                        <input type="email" id="email" name="email" value="<?php echo isset($user['email']) ? htmlspecialchars($user['email']) : ''; ?>" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-pink-500">
                    </div>
                    
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="phone">
                            Phone
                        </label>
                        <input type="tel" id="phone" name="phone" value="<?php echo isset($user['phone']) ? htmlspecialchars($user['phone']) : ''; ?>" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-pink-500">
                    </div>
                    
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="gender">
                            Gender
                        </label>
                        <input type="text" id="gender" value="<?php echo ucfirst(htmlspecialchars($user['gender'])); ?>" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-pink-500" disabled>
                    </div>
                    
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="role">
                            Role
                        </label>
                        <input type="text" id="role" value="<?php echo ucfirst(htmlspecialchars($user['role'])); ?>" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-pink-500" disabled>
                    </div>
                    
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="occupation">
                            Occupation
                        </label>
                        <input type="text" id="occupation" name="occupation" value="<?php echo isset($user['occupation']) ? htmlspecialchars($user['occupation']) : ''; ?>" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-pink-500">
                    </div>
                </div>
                
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="address">
                        Address
                    </label>
                    <textarea id="address" name="address" rows="3" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-pink-500"><?php echo isset($user['address']) ? htmlspecialchars($user['address']) : ''; ?></textarea>
                </div>
                
                <div class="flex justify-end">
                    <button type="submit" class="bg-pink-500 text-white px-6 py-2 rounded-lg hover:bg-pink-600 transition duration-300">
                        <i class="fas fa-save mr-2"></i>Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html> 