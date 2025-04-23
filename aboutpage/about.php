<?php
require_once 'config.php';

// Get database connection
// $conn = getDBConnection();

// // Fetch team members from database
// function getTeamMembers($conn) {
//     try {
//         $stmt = $conn->prepare("SELECT * FROM team_members WHERE active = 1 ORDER BY position_order");
//         $stmt->execute();
//         return $stmt->fetchAll(PDO::FETCH_ASSOC);
//     } catch(PDOException $e) {
//         error_log("Error fetching team members: " . $e->getMessage());
//         return [];
//     }
// }

// Get content from database
// $team_members = getTeamMembers($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - DOODLEDESK</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Comic+Neue:wght@400;700&family=Quicksand:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body>
    <header class="header">
        <div class="logo-container">
            <i class="fas fa-pencil-alt logo-icon"></i>
            <h1>DOODLEDESK</h1>
        </div>
    </header>

    <main>
        <section class="hero">
            <div class="hero-content">
                <h2>Welcome to Our Family</h2>
                <p>Where creativity meets learning and every child's imagination flourishes!</p>
            </div>
        </section>

        <section class="mission-vision">
            <div class="card mission">
                <i class="fas fa-paint-brush card-icon"></i>
                <h3>Our Mission</h3>
                <p>To provide a nurturing, safe, and stimulating environment where children can grow, learn, and develop their unique potential.</p>
            </div>
            <div class="card vision">
                <i class="fas fa-lightbulb card-icon"></i>
                <h3>Our Vision</h3>
                <p>To be the leading daycare center that shapes confident, creative, and compassionate future leaders through quality early childhood education.</p>
            </div>
        </section>

        <section class="team">
            <h2>Meet Our Team</h2>
            <div class="team-grid">
                <?php if (!empty($team_members)): ?>
                    <?php foreach ($team_members as $member): ?>
                        <div class="team-member">
                            <div class="member-image">
                                <?php if (!empty($member['image_url'])): ?>
                                    <img src="<?php echo htmlspecialchars($member['image_url']); ?>" alt="<?php echo htmlspecialchars($member['name']); ?>">
                                <?php else: ?>
                                    <i class="fas fa-child"></i>
                                <?php endif; ?>
                            </div>
                            <h4><?php echo htmlspecialchars($member['name']); ?></h4>
                            <p><?php echo htmlspecialchars($member['position']); ?></p>
                            <?php if (!empty($member['bio'])): ?>
                                <p class="member-bio"><?php echo htmlspecialchars($member['bio']); ?></p>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="team-member">
                        <div class="member-image">
                            <i class="fas fa-child"></i>
                        </div>
                        <h4>Surbhi</h4>
                        <p>Director</p>
                    </div>
                    <div class="team-member">
                        <div class="member-image">
                            <i class="fas fa-child"></i>
                        </div>
                        <h4>Ritika</h4>
                        <p>Lead Teacher</p>
                    </div>
                    <div class="team-member">
                        <div class="member-image">
                            <i class="fas fa-child"></i>
                        </div>
                        <h4>Vanshika</h4>
                        <p>Art Specialist</p>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> DOODLEDESK. All rights reserved.</p>
    </footer>

    <script src="script.js"></script>
</body>
</html> 