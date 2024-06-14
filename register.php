<?php
session_start();
include('config.php'); // Ensure this file correctly sets up $connection

$message = ""; // Initialize the message variable

if (isset($_POST['register'])) {
    if (!isset($connection)) {
        $message = "Database connection failed";
    }

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $repeat_password = $_POST['repeat_password'];

    if ($password !== $repeat_password) {
        $message = "Passwords do not match!";
    } else {
        $password_hash = password_hash($password, PASSWORD_BCRYPT);

        try {
            $query = $connection->prepare("SELECT * FROM users WHERE email=:email");
            $query->bindParam(":email", $email, PDO::PARAM_STR);
            $query->execute();

            if ($query->rowCount() > 0) {
                $message = "The email address is already registered!";
            } else {
                $query = $connection->prepare("INSERT INTO users (username, password, email) VALUES (:username, :password_hash, :email)");
                $query->bindParam(":username", $username, PDO::PARAM_STR);
                $query->bindParam(":password_hash", $password_hash, PDO::PARAM_STR);
                $query->bindParam(":email", $email, PDO::PARAM_STR);
                $result = $query->execute();

                if ($result) {
                    $_SESSION['user_name'] = $username; // Set the session variable
                    header("Location: main.php"); // Redirect to main.php after successful registration
                    exit;
                } else {
                    $message = "Your registration was not successful!";
                }
            }
        } catch (PDOException $e) {
            $message = "Error: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - PO Beans</title>
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

/* Form Container */
.form-container {
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

.form-container h2 {
    margin-bottom: 20px;
}

.form-container input {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.form-container button {
    width: 100%;
    padding: 10px;
    background-color: #839A71;
    border: none;
    color: white;
    border-radius: 5px;
    cursor: pointer;
}

.form-container button:hover {
    background-color: #218838;
}

.form-container p {
    margin-top: 10px;
}

.form-container p a {
    color: #839A71;
    text-decoration: none;
}

.form-container p a:hover {
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
            <h1>Register</h1>
            <div class="icons">
                <i class="fa-solid fa-house icon"></i>
                <i class="fa-solid fa-cart-shopping icon"></i>
                <i class="fa-solid fa-bars icon"></i>
            </div>
        </header>
        <?php if ($message): ?>
            <div class="message-container" style="display: block;">
                <p><?php echo $message; ?></p>
            </div>
        <?php endif; ?>
        <div class="form-container">
            <h2>Register</h2>
            <form method="post" action="">
                <input type="text" name="username" placeholder="Full Name" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="password" name="repeat_password" placeholder="Repeat Password" required>
                <button type="submit" name="register" value="register">Register</button>
                <p>Already have an account? <a href="login.php">Login</a></p>
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
