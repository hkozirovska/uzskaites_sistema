<?php
session_start();
date_default_timezone_set('Europe/Athens');
$UserIP = strval($_SERVER['REMOTE_ADDR']);

// Savienojums ar datubāzi
$server = "127.0.0.1:3306";
$database = "uzskaite";
$user = "root";
$password = "";
$mysqli = new mysqli($server, $user, $password, $database);

// Check if user is not logged in, redirect to login page
if (!isset($_SESSION['username'])) {
    header("Location: /login");
    exit();
}

// Session expiration check
$CheckSessionQuery = "SELECT * FROM sesija WHERE lietotajsIP = '{$UserIP}'";
$CheckSession = mysqli_query($mysqli, $CheckSessionQuery);
$Session = mysqli_fetch_assoc(mysqli_query($mysqli, $CheckSessionQuery));

if (mysqli_num_rows($CheckSession) == 0) { // If session doesn't exist
    session_destroy();
    header("Location: login.blade.php?login=1");
    exit();
} else if (mysqli_num_rows($CheckSession) > 0) { // If session exists
    $SessionExpiration = strtotime($Session['Expires']);
    $currDate = strtotime(date("Y-m-d H:i:s", time()));

    if ($SessionExpiration < $currDate) { // If session has expired
        $DeleteSession = "DELETE FROM sesija WHERE lietotajsIP = '{$UserIP}';";
        mysqli_query($mysqli, $DeleteSession);
        session_destroy();
        header("Location: login.blade.php?login=1");
        exit();
    }
}

?>

<head>
    <title>SUS</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/overview.css">
</head>

<body>

    <section class="augsa">
        <div id="page-container">
        <div class="top_banner section">
                <div class="top">
                     <div id="logo"><img src="../images/LOGO.png" alt="Logo"></div>
                    <div class="sveicinajums">Sveicināti, <?php echo $Session['lietotajvards']; ?></div>
                </div>
                
        </div>
        <nav id="main-menu" class="section">
            <ul class="parent-menu">
                <li class="sub-menu-caption">+
                    <ul class="sub-menu">
                        <li><a href="https://www.nezinu.lv">Jauni analīžu rezultāti</a></li>
                        <li><a href="https://www.nezinu.lv">Jauna zāļu izmantošana</a></li>
                        <li><a href="https://www.nezinu.lv">Pacients</a></li>
                    </ul>
                </li>
                <li class="upper-menu"><a href="overview.blade.php">Pacienti</a></li>
                <li class="upper-menu"><a href="https://www.nezinu.lv">Maiņu grafiks</a></li>
                <li class="upper-menu"><a href="https://www.nezinu.lv">Info par zālēm</a></li>
                <li class="upper-menu"><a href="https://www.nezinu.lv">Pasts</a></li>
                <li class="upper-menu"><a href="https://www.nezinu.lv">Drošības atskaites</a></li>
                <li class="upper-menu"><a href="https://www.nezinu.lv">Lietotāji</a></li>
                <li class="upper-menu"><a href="https://www.nezinu.lv">Darbā pieņemšanas</a></li>
                <li class="upper-menu"><a href="https://www.nezinu.lv">Paziņojumi</a></li>
                <li class="upper-menu"><a href="https://www.nezinu.lv">Meklēšana</a></li>
                <li class="upper-menu"><a href="https://www.nezinu.lv">Izrakstu saraksts</a></li>
            </ul>
        </nav>

        <div id="content-wrap">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="jumbotron" id="jumbotron-size">
                                    <h2>Sveiki, <?php echo $Session['lietotajvards']; ?></h2>
                                    <p>Laipni lūdzam Uzskaites sistēmā!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
