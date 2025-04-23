<?php
function get_current_year() {
    return date("Y");
}

function get_daycare_features() {
    return array(
        array(
            'icon' => 'child_care',
            'title' => 'Arrival & Free Play',
            'description' => 'Gentle start with free play to help children settle in.'
        ),
        array(
            'icon' => 'restaurant',
            'title' => 'Snack Time',
            'description' => 'Healthy snacks like fruits and yogurt to keep energy levels up.'
        ),
        array(
            'icon' => 'groups',
            'title' => 'Social Play',
            'description' => 'Activities that foster friendship and social skills.'
        ),
        array(
            'icon' => 'restaurant',
            'title' => 'Nutritious Meals',
            'description' => 'Balanced meals to support healthy growth.'
        ),
        array(
            'icon' => 'palette',
            'title' => 'Creative Activities',
            'description' => 'Art, music, and imaginative play.'
        ),
        array(
            'icon' => 'record_voice_over',
            'title' => 'Parent Updates',
            'description' => 'Regular communication to keep parents informed.'
        ),
    );
}

function get_daycare_routines() {
    return array(
        'Half-Time' => array(
            array('time' => '9:00 - 9:30 AM', 'activity' => 'Arrival & Free Play'),
            array('time' => '9:30 - 10:00 AM', 'activity' => 'Breakfast'),
            array('time' => '10:00 - 10:30 AM', 'activity' => 'Circle Time'),
            array('time' => '10:30 - 11:30 AM', 'activity' => 'Learning Activities'),
            array('time' => '11:30 - 12:00 PM', 'activity' => 'Outdoor Play'),
        ),
        'Full-Time' => array(
            array('time' => '9:00 - 9:30 AM', 'activity' => 'Arrival & Free Play'),
            array('time' => '9:30 - 10:00 AM', 'activity' => 'Breakfast'),
            array('time' => '10:00 - 10:30 AM', 'activity' => 'Circle Time'),
            array('time' => '10:30 - 11:30 AM', 'activity' => 'Learning Activities'),
            array('time' => '11:30 - 12:30 PM', 'activity' => 'Outdoor/Large Motor Play'),
            array('time' => '12:30 - 1:00 PM', 'activity' => 'Story/Quiet Time'),
            array('time' => '1:00 - 2:00 PM', 'activity' => 'Lunch Time'),
            array('time' => '2:00 - 3:00 PM', 'activity' => 'Nap/Rest Time'),
            array('time' => '3:00 - 3:30 PM', 'activity' => 'Afternoon Snack'),
            array('time' => '3:30 - 4:00 PM', 'activity' => 'Clean-up & Departure'),
        ),
        'Only Evening' => array(
            array('time' => '4:00 - 4:30 PM', 'activity' => 'Arrival & Free Play'),
            array('time' => '4:30 - 5:00 PM', 'activity' => 'Evening Snack'),
            array('time' => '5:00 - 5:30 PM', 'activity' => 'Creative Activities'),
            array('time' => '5:30 - 6:00 PM', 'activity' => 'Story Time'),
            array('time' => '6:00 - 6:30 PM', 'activity' => 'Pick-up & Wrap Up'),
        ),
    );
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Daycare Royale</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css"/>
    <style>
        body { font-family: 'Roboto', sans-serif; margin: 0; padding: 0; }
        .nav-color { background-color: #880e4f; }
        .process-card { padding: 20px; text-align: center; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); transition: transform 0.3s ease; }
        .process-card:hover { transform: translateY(-5px); }
        .process-card i { font-size: 48px; color: #880e4f; }
        .striped th, .striped td { text-align: center; }
        .footer-two { padding: 20px 0; }
        .infomodal { position: fixed; top: 0; left: 0; width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; background: rgba(0, 0, 0, 0.5); z-index: 1000; display: none; }
        .infomodal .modal { width: 80%; max-width: 600px; padding: 20px; background: white; border-radius: 8px; }
        h4.section-title { margin-top: 40px; color: #880e4f; }
    </style>
</head>

<body id="home" class="scrollspy">
    <section class="mynav">
        <div class="navbar-fixed">
            <nav class="nav-color">
                <div class="container">
                    <div class="nav-wrapper">
                        <a href="#" class="brand-logo">Doodle Desk</a>
                        <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                        <ul id="nav-mobile" class="right hide-on-med-and-down">
                            <li><a href="login/login.php">Login</a></li>
                            <li><a href="daycareenroll.html">Enroll</a></li>
                            <li><a href="login/gallery/gallery.html" onclick="toggleModal();">Gallery</a></li>
                            <li><a href="classes.php">Classes</a></li>
                            <li><a href="aboutpage/about.php">About Us</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <ul class="sidenav" id="mobile-demo">
            <li><a href="login/login.php">Login</a></li>
            <li><a href="daycareenroll.html">Enroll</a></li>
            <li><a href="login/gallery/gallery.html" onclick="toggleModal();">Gallery</a></li>
            <li><a href="ContactUs.html">Classes</a></li>
            <li><a href="aboutpage/about.php" onclick="toggleModal();">About Us</a></li>
        </ul>
    </section>

    <section class="process">
        <div class="section section-icons lighten-4 center">
            <div class="container space">
                <h3>Our Daycare Features</h3>
                <div class="row">
                    <?php foreach (get_daycare_features() as $feature): ?>
                        <div class="col s12 m6 6">
                            <div class="card-panel hoverable process-card">
                                <i class="material-icons"><?= $feature['icon'] ?></i>
                                <h4><?= $feature['title'] ?></h4>
                                <p><?= $feature['description'] ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <section class="process">
        <div class="section section-icons lighten-4 center">
            <div class="container space">
                <h3>Daily Routine</h3>
                <?php foreach (get_daycare_routines() as $program => $routine): ?>
                    <h4 class="section-title"><?= $program ?> Program</h4>
                    <div class="row">
                        <div class="col s12 m12">
                            <table class="striped">
                                <thead>
                                    <tr>
                                        <th>Time</th>
                                        <th>Activity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($routine as $item): ?>
                                        <tr>
                                            <td><?= $item['time'] ?></td>
                                            <td><?= $item['activity'] ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <footer class="section brown darken-3 white-text footer-two">
        <div class="container">
            <div class="row">
                <div class="col l6 s6"><p>&copy; <?= get_current_year(); ?> Doodle Desk</p></div>
                <div class="col l6 s6"><p style="text-align: right;"></p></div>
            </div>
        </div>
    </footer>

    <section class="infomodal" id="modal3">
        <div class="modal">
            <h4>Link Disabled</h4>
            <p>Sorry! All links are disabled as of now.</p>
            <a href="#" class="modal-close waves-effect btn-flat">Close</a>
        </div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            M.Sidenav.init(document.querySelectorAll('.sidenav'));
        });
        function toggleModal(){
            document.getElementById('modal3').style.display='flex';
        }
        document.onclick = function(e){
            if(e.target.id == 'modal3'){
                document.getElementById('modal3').style.display = 'none';
            }
        }
    </script>
</body>
</html>
