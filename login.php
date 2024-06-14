<?php
session_start();
include('config.php'); // Ensure this file correctly sets up $connection

$message = ""; // Initialize the message variable

if (isset($_POST['login'])) {
    if (!isset($connection)) {
        $message = "Database connection failed";
    }

    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        $query = $connection->prepare("SELECT * FROM users WHERE username=:username");
        $query->bindParam(":username", $username, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            $message = "Username password combination is wrong!";
        } else {
            if (password_verify($password, $result['password'])) {
                $_SESSION['user_name'] = $result['username'];
                header("Location: main.php"); // Redirect to main.php after successful login
                exit;
            } else {
                $message = "Username password combination is wrong!";
            }
        }
    } catch (PDOException $e) {
        $message = "Error: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PO Beans</title>
    <!-- Include FontAwesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<style>
/* General Styles */
body, html {
    margin: 0;
    padding: 0;
    height: 100%;
    font-family: Arial, sans-serif;
    box-sizing: border-box;
}

/* Background Image */
.background-image {
    position: relative;
    background-image: url('Bpic.jpg');
    background-size: cover;
    background-position: center;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

/* Header */
.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px;
    background-color: rgba(0, 0, 0, 0.5);
    color: white;
    width: 100%;
}

.header .icons {
    display: flex;
    align-items: center;
}

.header .icon {
    margin: 30px;
}

/* Login Form Container */
.login-container {
    position: relative;
    margin: auto;
    background-color: rgba(255, 255, 255, 0.9);
    padding: 20px;
    border-radius: 10px;
    width: 300px;
    text-align: center;
}

/* Message Container */
.message-container {
    position: relative;
    margin: auto;
    background-color: rgba(255, 0, 0, 0.1);
    padding: 10px;
    border-radius: 5px;
    width: 300px;
    text-align: center;
    color: red;
    display: none; /* Hidden by default */
}

.message-container p {
    margin: 0;
}

.login-container h2 {
    margin-bottom: 20px;
}

.login-container input {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.login-container button {
    width: 100%;
    padding: 10px;
    background-color: #839A71;
    border: none;
    color: white;
    border-radius: 5px;
    cursor: pointer;
}

.login-container button:hover {
    background-color: #218838;
}

.login-container p {
    margin-top: 10px;
}

.login-container p a {
    color: #839A71;
    text-decoration: none;
}

.login-container p a:hover {
    text-decoration: underline;
}

/* Footer */
.footer {
    background-color: rgba(0, 0, 0, 0.5);
    color: white;
    padding: 10px;
    text-align: center;
}

.footer .social-icons {
    margin-top: 10px;
}

.footer .social-icons .icon {
    margin: 0 10px;
    font-size: 20px;
    color: white;
}

.footer .copyright {
    margin-top: 10px;
    font-size: 14px;
}
</style>
<body>
    <div class="background-image">
        <header class="header">
            <h1>Login</h1>
            <div class="icons">
                <i class="fa-solid fa-house icon"></i>
                <i class="fa-solid fa-cart-shopping icon"></i>
                <i class="fa-solid fa-bars icon"></i>
            </div>
        </header>
        <?php if ($message): ?>
            <div class="message-container">
                <p><?php echo $message; ?></p>
            </div>
        <?php endif; ?>
        <div class="login-container">
            <h2>Login</h2>
            <form method="post" action="">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit" name="login" value="login">Log In</button>
                <p>Do not have an account? <a href="register.php">Register</a></p>
            </form>
        </div>
        <footer class="footer">
            <div class="social-icons">
                <i class="fab fa-instagram icon"></i>
                <i class="fab fa-facebook-f icon"></i>
                <i class="fab fa-twitter icon"></i>
            </div>
            <div class="copyright">
                &copy; 2024 PO Beans. All rights reserved.
            </div>
        </footer>
    </div>
</body>
</html>


