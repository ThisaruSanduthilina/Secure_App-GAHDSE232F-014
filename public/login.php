<?php
// Include config and AuthModel
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../src/Model/AuthModel.php'; 

// Initialize AuthModel with PDO instance
$authModel = new AuthModel($pdo);

// Initialize variables for form processing
$username = $password = "";
$username_err = $password_err = $login_err = "";

// Process the form when it is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Check if there are no errors before performing the login
    if (empty($username_err) && empty($password_err)) {
        // Attempt to login
        $user = $authModel->login($username, $password);
        
        if ($user) {
            // Store user information in session
            session_start();
            $_SESSION['username'] = $user['username'];
            $_SESSION['role_id'] = $user['role_id']; // Store role_id in session
            
            // Redirect based on user role
            if ($user['role_id'] == 1) {
                header("location: ../src/View/Admin/dashboard.php");
            } elseif ($user['role_id'] == 2) {
                header("location: ../src/View/User/profile.php");
            } else {
                header("location: ../src/View/User/profile.php"); // Default fallback
            }
            exit();
        } else {
            $login_err = "Invalid username or password.";
        }
    }
}
?>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
        }
        .wrapper {
            width: 350px;
            padding: 20px;
            margin: 0 auto;
            background-color: #fff;
            border: 1px solid #ddd;
            margin-top: 50px;
            border-radius: 5px;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Login</h2>
        <?php if (!empty($login_err)) : ?>
            <p class="error"><?php echo htmlspecialchars($login_err); ?></p>
        <?php endif; ?>
        <form action="login.php" method="post">
            <div>
                <label>Username</label>
                <input type="text" name="username" value="<?php echo htmlspecialchars($username); ?>" required>
                <span class="error"><?php echo htmlspecialchars($username_err); ?></span>
            </div>
            <div>
                <label>Password</label>
                <input type="password" name="password" required>
                <span class="error"><?php echo htmlspecialchars($password_err); ?></span>
            </div>
            <div>
                <input type="submit" value="Login">
            </div>
            <p>Don't have an account? <a href="register.php">Register here</a>.</p>
        </form>
    </div>
</body>
</html> -->



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style type="text/css">
        nav {
            margin-bottom: 1px;
        }
        .custom-message {
            max-width: 400px;
            width: 80%;
            height:50px;
            margin: 20px auto;
            padding: 10px 20px;
            font-size: 16px;
            text-align: center;
            position: fixed;
            top: 29%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1000;
        }
        .custom-message.success {
            background-color: #dff0d8;
            color: #3c763d;
        }
        .custom-message.danger {
            background-color: #f2dede;
            color: #a94442;
        }
    </style>
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $(".custom-message").fadeOut("slow", function() {
                    $(this).remove();
                });
            }, 3000); 
        });
    </script>
</head>
<body class="login-background">
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
                <div class="collapse navbar-collapse" id="navbar-collapse">
                    
                    <ul class="navbar1">
                        <br>
                        <li><a href="login.php"><span class="glyphicon glyphicon-log-in">Login</span></a>
                        <a href="index.php"><span class="glyphicon glyphicon-log-in">Log Out</span></a>
                        <a href="registration.php"><span class="glyphicon glyphicon-log-in">Admin Login</span></a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <section>
        <div class="login_img">
            
            <div class="box1">
            <?php if (!empty($login_err)) : ?>
            <p class="error"><?php echo htmlspecialchars($login_err); ?></p>
        <?php endif; ?>
                <h2>Library Management System</h2>
                <h3>Login</h3>
               
                <form name="login" action="login.php" method="post">
                    <div class="login">
                        <input type="text" name="username" placeholder="Username"value="<?php echo htmlspecialchars($username); ?>"  class="form-control" required><br><br>
                        <span class="error"><?php echo htmlspecialchars($username_err); ?></span>
                        <input type="password" name="password" placeholder="password" class="form-control" required><br><br>
                        <span class="error"><?php echo htmlspecialchars($password_err); ?></span>
                        <input class="btn btn-gold btn-block" type="submit" name="submit" value="Login"><br><br><br><br><br><br>
                   
                   
                        <p><a href="register.php">Forgot Password</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;You are new to this website? <a style="color: white;" href="register.php">Sign Up</a></p>
    
                   
                   
                   
                    </div>
                </form>
            </div>
        </div>
    </section>
    <footer>
        <p style="color: white;text-align: right;">
            Email :&nbsp; Thisrusanduthilina@gmail.com <br><br>
            Mobile :&nbsp; +0751234567
        </p>
    </footer>
</body>
</html>
 