<?php
// Include config and AuthModel
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../src/Model/AuthModel.php'; 

// Initialize AuthModel
$authModel = new AuthModel($pdo);

// Initialize variables for form processing
$username = $password = $confirmPassword = "";
$username_err = $password_err = $confirmPassword_err = $success_msg = $error_msg = "";

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
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Password must have at least 6 characters.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirmPassword_err = "Please confirm the password.";
    } else {
        $confirmPassword = trim($_POST["confirm_password"]);
        if ($password != $confirmPassword) {
            $confirmPassword_err = "Passwords did not match.";
        }
    }

    // Default role is user (role_id = 2)
    $role_id = '2'; // This sets all registered users as 'user' by default

    // Check if there are no errors before inserting into the database
    if (empty($username_err) && empty($password_err) && empty($confirmPassword_err)) {
        // Register the user with role_id = 2 (user)
        $registerSuccess = $authModel->register($username, $password, $role_id);
        
        if ($registerSuccess) {
            $success_msg = "Registration successful! You can now login.";
        } else {
            $error_msg = "Registration failed. Please try again.";
        }
    }
}
?>

<!-- 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
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
        .success {
            color: green;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Register</h2>
        <?php if (!empty($success_msg)) : ?>
            <p class="success"><?php echo htmlspecialchars($success_msg); ?></p>
        <?php endif; ?>
        <?php if (!empty($error_msg)) : ?>
            <p class="error"><?php echo htmlspecialchars($error_msg); ?></p>
        <?php endif; ?>
        <form action="register.php" method="post">
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
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" required>
                <span class="error"><?php echo htmlspecialchars($confirmPassword_err); ?></span>
            </div>
            <div>
                <label>Role</label>
                <select name="role_id" required>
                    <option value="" disabled selected>Select role</option>
                    <option value="1" <?php echo ($role_id == '1') ? 'selected' : ''; ?>>Admin</option>
                    <option value="2" <?php echo ($role_id == '2') ? 'selected' : ''; ?>>User</option>
                </select>
                <span class="error"><?php echo htmlspecialchars($role_id_err); ?></span>
            </div>
            <div>
                <input type="submit" value="Register">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>
</body>
</html>

 -->



 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
    <link rel="stylesheet" href="./assets/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        .custom-message {
            max-width: 400px;
            height: 50px;
            margin: 20px auto;
            padding: 10px 20px;
            font-size: 14px;
            text-align: center;
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
                    <ul class="nav navbar-nav">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="books.php">Books</a></li>
                        <li><a href="student_login.php">Student Login</a></li>
                        <li><a href="registration.php">Registration</a></li>
                        <li><a href="feedback.php">Feedback</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <section>
        <div class="reg_img">
            <div class="box2">
                <h2>Library Management System</h2>
                <p>Register</p>
                <?php if (!empty($success_msg)) : ?>
                    <p class="success"><?php echo htmlspecialchars($success_msg); ?></p>
                <?php endif; ?>
                <?php if (!empty($error_msg)) : ?>
                    <p class="error"><?php echo htmlspecialchars($error_msg); ?></p>
                <?php endif; ?>
                <form name="registration" action="register.php" method="post">
                    <div>
                        
                        <input class="form-control" placeholder="Username" type="text" name="username" value="<?php echo htmlspecialchars($username); ?>" required>
                        <span class="error"><?php echo htmlspecialchars($username_err); ?></span>
                    </div>
                    <div>
                        
                        <input class="form-control" placeholder="Password" type="password" name="password" required>
                        <span class="error"><?php echo htmlspecialchars($password_err); ?></span>
                    </div>
                    <div>
                        
                        <input class="form-control" placeholder="Confirm Password" type="password" name="confirm_password" required>
                        <span class="error"><?php echo htmlspecialchars($confirmPassword_err); ?></span>
                    </div>
                    <div>
                        <input type="submit" class="btn btn-gold btn-block" value="Register">
                    </div>
                    <p>Already have an account? <a href="login.php">Login here</a>.</p>
                </form>
            </div>
        </div>
    </section>
    <footer>
        <p style="color: white; text-align: right;">
            Email :&nbsp; Thisrusanduthilina@gmail.com <br><br>
            Mobile :&nbsp; +0751234567
        </p>
    </footer>
</body>
</html>
