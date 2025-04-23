<?php
session_start();
require_once 'login/config.php';

function get_current_year() {
    return date("Y");
}

function get_value_cards() {
    return array(
        array(
            'image' => 'https://i.pinimg.com/736x/5c/ee/6d/5cee6de0fdd620632c968d21c2b1e037.jpg',
            'title' => 'Learn And Play',
            'description' => 'Join the intense of playing and learning to make your child comfortable',
            'background-color' => '#b06486'
        ),
        array(
            'image' => 'https://i.pinimg.com/736x/13/49/c9/1349c904cd84cc45af0490636b4fed79.jpg',
            'title' => 'Nutritious Meal',
            'description' => 'Children need meals full of nutrition necessary for a day of life.',
            'background-color' => '#c99bb0'
        ),
        array(
            'image' => 'https://i.pinimg.com/736x/61/c7/85/61c785305b4588d05082a896520d2a25.jpg',
            'title' => 'Great  Teachers',
            'description' => 'Experienced and well trained teachers help your child grow in all aspects.',
            'background-color' => '#b06486'
        ),
        array(
            'image' => 'https://i.pinimg.com/736x/0c/e0/b7/0ce0b7e0f53ef5136241939e596d0c04.jpg',
            'title' => 'Good Environment',
            'description' => 'A colorful environment that helps your child feel more at home.',
            'background-color' => '#c99bb0'
        )
    );
}

function get_babysitters() {
    return array(
        array(
            'name' => 'Surbhi',
            'image' => 'pic1.jpg',
            'description' => 'Experienced babysitter with a passion for childcare.',
            'experience' => '5 years',
            'availability' => 'Mon-Fri, 9am-5pm'
        ),
        array(
            'name' => 'Ritika',
            'image' => 'pic4.jpg',
            'description' => 'Certified in CPR and First Aid, dedicated to child safety.',
            'experience' => '3 years',
            'availability' => 'Weekends, flexible hours'
        ),
        array(
            'name' => 'Vanshika',
            'image' => 'pic3.jpg',
            'description' => 'Specializes in early childhood education and development.',
            'experience' => '7 years',
            'availability' => 'Mon-Fri, 10am-6pm'
        ),
   
   
    );
}

$user_name = '';
$user_full_name = '';
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT username, full_name FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 1) {
        $user_data = $result->fetch_assoc();
        $user_name = $user_data['username'];
        $user_full_name = $user_data['full_name'] ? $user_data['full_name'] : $user_name;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doodle Desk - Kindergarten School</title>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }

        .brand-logo img {
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .slider .slides li img {
            object-fit: cover;
        }

        .slider .slides {
            text: black;
        }

        .value-card {
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            color: white;
            transition: transform 0.3s ease;
        }

        .value-card:hover {
            transform: scale(1.03);
        }

        .babysitter-card {
            background-color: #f0f0f0;
            padding: 10px;
            text-align: center;
            gap: 20%;
            border-radius: 8px;
            transition: transform 0.3s ease-in-out;
            margin: 30px; 
            /* width: 150px;
            height: 150px; */
        }

        .babysitter-card:hover {
            transform: scale(1.05); 
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); 
        }

        .babysitter-card img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            margin-bottom: 10px;
        }

        .how-to-enroll,
        .contact-us {
            text-align: center;
            padding: 20px 20px;
        }

        footer {
            background-color: #333;
            color: white;
            padding: 20px;
            text-align: center;
        }

        nav,
        .nav-wrapper {
            background-color: #b06486;
        }

        .how-to-enroll-content {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: 0 auto;
        }

        .how-to-enroll-content h4 {
            color: #b06486;
            margin-bottom: 20px;
        }

        .how-to-enroll-content p {
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .how-to-enroll-content button {
            background-color: #b06486;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .brand-logo {
            font: italic 1.2rem "Fira Sans", serif;
            font-size: 2em;
        }

        .user-profile {
            display: flex;
            align-items: center;
            color: white;
            cursor: pointer;
            padding: 0 15px;
        }

        .user-profile i {
            margin-right: 8px;
            font-size: 1.2em;
        }

        .user-profile-dropdown {
            position: absolute;
            top: 64px;
            right: 15px;
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            display: none;
            z-index: 1000;
            min-width: 200px;
        }

        .user-profile-dropdown.show {
            display: block;
        }

        .user-profile-dropdown a {
            display: block;
            padding: 10px 15px;
            color: #333;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .user-profile-dropdown a:hover {
            background-color: #f5f5f5;
        }

        .user-profile-dropdown a i {
            margin-right: 8px;
            color: #b06486;
        }

        nav .nav-wrapper .brand-logo {
            order: 2;
            margin-left: 5px;
            margin-bottom: 5px;
        }
    </style>
</head>

<body>

    <div class="navbar-fixed">
        <nav>
            <div class="nav-wrapper container">
                <a href="#" class="brand-logo"><img src="3.png" alt="" style="font-family: Algerian;">Doodle Desk</a>
                <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                <ul class="right hide-on-med-and-down">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <li>
                            <div class="user-profile" id="userProfileDropdown">
                                <i class="fas fa-user-circle"></i>
                                <span><?php echo htmlspecialchars($user_full_name); ?></span>
                                <div class="user-profile-dropdown" id="userDropdownMenu">
                                    <a href="login/profile.php"><i class="fas fa-user"></i> My Profile</a>
                                    <a href="login/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                                </div>
                            </div>
                        </li>
                    <?php else: ?>
                        <li><a href="login/login.html">Login</a></li>
                    <?php endif; ?>
                    
                    <li><a href="login/gallery/gallery.html" onclick="toggleModal();">Gallery</a></li>
                    <li><a href="Classes.php">Classes</a></li>
                    <li><a href="aboutpage/about.php" target="_blank">About Us</a></li>
                    <li><a href="daycareenroll.html">Enroll</a></li>
                </ul>
            </div>
        </nav>
    </div>
    <ul class="sidenav" id="mobile-demo">
        <?php if (isset($_SESSION['user_id'])): ?>
            <li><a href="login/profile.php"><i class="fas fa-user"></i> My Profile</a></li>
            <li><a href="login/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        <?php else: ?>
            <li><a href="login/login.html">Login</a></li>
        <?php endif; ?>
        <!-- <li><a href="daycareenroll.html">Enroll</a></li> -->
        <li><a href="login/gallery/gallery.html">Gallery</a></li>
        <li><a href="Classes.php">Classes</a></li>
        <li><a href="aboutpage/about.php">About Us</a></li>
        <li><a href="daycareenroll.html">Enroll</a></li>
    </ul>
    <div class="slider">
        <ul class="slides">
            <li>
                <img src="pic2.jpeg" alt="Slide 1">
                <div class="caption center-align">
                    <h3 color="black">Doodle Desk - Nurturing Creativity</h3>
                    <h5>Where every child discovers their unique potential.</h5>
                </div>
            </li>
            <li>
                <img src="pic5.jpg" alt="Slide 2">
                <div class="caption center-align">
                    <h3>Safe and Engaging Environment</h3>
                    <h5>Building strong foundations for lifelong learning.</h5>
                </div>
            </li>
            <li>
                <img src="table-3281047_1920.jpg" alt="Slide 3">
                <div class="caption center-align">
                    <h3>Personalized Attention</h3>
                    <h5>Ensuring each child grows with confidence and joy.</h5>
                </div>
            </li>
        </ul>
    </div>

    <div class="container section">
        <h4 class="center-align">Our Core Values</h4>
        <div class="row">
            <?php foreach (get_value_cards() as $card): ?>
                <div class="col s12 m3 13">
                    <div class="value-card" style="background-color: <?= $card['background-color'] ?>;">
                        <img src="<?= $card['image'] ?>" alt="<?= $card['title'] ?>" style="width:80px;">
                        <h5><?= $card['title'] ?></h5>
                        <p><?= $card['description'] ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="how-to-enroll">
        <div class="how-to-enroll-content">
            <h4>How To Let Your Child Study At Doodle Desk?</h4>
            <p>At Doodle Desk Daycare, we understand that choosing the right place for your child is one of the most
                important decisions you'll make as a parent. That's why we're dedicated to creating a nurturing, safe, and
                engaging environment where every child feels at home.</p>
            <p>Our experienced caregivers and educators focus on holistic development—encouraging creativity, building
                social skills, and laying strong foundations for lifelong learning. With structured programs, playful
                activities, and personalized attention, we ensure each child grows with confidence, joy, and curiosity.</p>
            <p>More than just a daycare, we're a trusted partner in your child's early journey.</p>

        </div>
    </div>

    <div class="container section">
        <h4 class="center-align">Our Babysitters</h4>
        <div class="row">
            <?php 
            $babysitters = get_babysitters();
            $total = count($babysitters);
            $first_row = array_slice($babysitters, 0, 3);
            $second_row = array_slice($babysitters, 3);
            ?>
            
            <!-- First row: 3 cards -->
            <div class="row">
                <?php foreach ($first_row as $sitter): ?>
                    <div class="col s12 m4">
                        <div class="babysitter-card">
                            <img src="<?= $sitter['image'] ?>" alt="<?= $sitter['name'] ?>">
                            <h5><?= $sitter['name'] ?></h5>
                            <p><?= $sitter['description'] ?></p>
                            <p><strong>Experience:</strong> <?= $sitter['experience'] ?></p>
                            <p><strong>Availability:</strong> <?= $sitter['availability'] ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <!-- Second row: 2 cards -->
            <div class="row">
                <?php foreach ($second_row as $sitter): ?>
                    <div class="col s12 m6">
                        <div class="babysitter-card">
                            <img src="<?= $sitter['image'] ?>" alt="<?= $sitter['name'] ?>">
                            <h5><?= $sitter['name'] ?></h5>
                            <p><?= $sitter['description'] ?></p>
                            <p><strong>Experience:</strong> <?= $sitter['experience'] ?></p>
                            <p><strong>Availability:</strong> <?= $sitter['availability'] ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div class="contact-us pink lighten-3">
        <h4>Contact Us</h4>
        <p>Email: sharma.shivani9155@gmail.com</p>
        <p>Phone: 7004675031</p>
        <p>Address: Jalandhar, Punjab</p>
    </div>

    <footer>
        <p>&copy; <?= get_current_year(); ?> Doodle Desk. All rights reserved.</p>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            M.Slider.init(document.querySelectorAll('.slider'), {
                height: 500,
                interval: 4000
            });

            M.Sidenav.init(document.querySelectorAll('.sidenav'));
            

            const userProfileDropdown = document.getElementById('userProfileDropdown');
            const userDropdownMenu = document.getElementById('userDropdownMenu');
            
            if (userProfileDropdown && userDropdownMenu) {
                userProfileDropdown.addEventListener('click', function() {
                    userDropdownMenu.classList.toggle('show');
                });
                
                
                document.addEventListener('click', function(event) {
                    if (!userProfileDropdown.contains(event.target)) {
                        userDropdownMenu.classList.remove('show');
                    }
                });
            }
        });
    </script>
</body>

</html>