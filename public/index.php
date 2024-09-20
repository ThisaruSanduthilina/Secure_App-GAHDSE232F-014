<?php
// Start session and include any required config or helpers
session_start();
require_once __DIR__ . '/../config/config.php'; 

// Check if user is logged in and redirect accordingly
if (isset($_SESSION['user_role'])) {
    if ($_SESSION['user_role'] == 'admin') {
        header('Location: /admin.php');
        exit;
    } else {
        header('Location: /user.php');
        exit;
    }
}

// Basic landing page content


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="./assets/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body class="index-background">
    <header>
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="logo">
                        <img src="images/logo.jpeg" alt="Library Logo" class="img-responsive">
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="logo-text">
                        <h1>Online Library Management System</h1>
                        <p>Your gateway to a world of books</p>
                    </div>
                </div>
            </div>
        </div>
      
        <nav class="navbar">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"></a>
                </div>
                <div class="navbar-collapse" id="navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="login.php">Login</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <section>
       
        <div class="homebg">
           
            <div class="box">
                <br><br>
                <h1>Welcome To Library</h1>
                <br>
                <p>Books Ignite Imagination And Expand Horizons</p>
                <p>Please <a href="login.php">Login</a> or <a href="register.php">Register</a>.</p>
            </div>
        </div>
    </section>
    <footer>
        <div class="container">
            <p style="color: white; text-align: center;">
                Email : Thisrusanduthilina@gmail.com <br><br>
                Mobile : +0751234567
            </p>
        </div>
    </footer>
</body>
</html>



