<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PO Beans</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <style>
    /* General Styles */
    html, body {
      margin: 0;
      padding: 0;
      height: 100%;
      width: 100%;
      font-family: Arial, sans-serif;
    }

    body {
      display: flex;
      flex-direction: column;
    }

    /* Header Styles */
    header {
      background-color: white ;
      color: white;
      text-align: center;
      padding: 1em 0;
      position: relative;
      width: 100%;
    }

    header .banner-container {
      padding: 5em 1em;
      position: relative;
      width: 100%;
      box-sizing: border-box;
    }

    header .heading-content {
      position: relative;
      z-index: 1;
    }

    header h1 {
      font-size: 4em;
      margin: 0.5em 0;
      color: #8B7769;
    }

    header p {
      font-size: 1.5em;
      color: #8B7769;
    }

    header .nav-button {
      position: absolute;
      top: 1em;
      right: 1em;
    }

    header .nav-button button {
      font-size: 1.5em;
      background-color: white;
      color: #000000;
      border: none;
      padding: 0.5em 1em;
      cursor: pointer;
    }

    header .dropdown-content {
      display: none;
      position: absolute;
      right: 0;
      background-color: white;
      box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
      z-index: 1;
    }

    header .dropdown-content a {
      color: #333;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
      text-align: left;
    }

    header .dropdown-content a:hover {
      background-color: #ddd;
    }

    header .show {
      display: block;
    }

    .welcome-message {
       font-size: 4em;
      margin: 0.5em 0;
      color: #8B7769;
    }
    /* Profile Dropdown */
.profile-link {
    position: relative;
    display: inline-block;
}

.profile-link .profile-icon {
    font-size: 24px;
}

.profile-dropdown {
    display: none;
    position: absolute;
    background-color: white;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

.profile-dropdown a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.profile-dropdown a:hover {
    background-color: #ddd;
}

.profile-link:hover .profile-dropdown {
    display: block;
}


    /* Logout Button */
    .logout-button {
      font-size: 1.2em;
      background-color: #f44336;
      color: #fff;
      border: none;
      padding: 0.5em 1em;
      cursor: pointer;
      border-radius: 5px;
    }

    /* About Us Section */
    #about-us {
      display: flex;
      flex-wrap: wrap;
      padding: 20px;
      background-color: #f4f4f4;
      color: #333;
      width: 100%;
      box-sizing: border-box;
    }

    #about-us img {
      max-width: 100%;
      height: auto;
      border-radius: 8px;
      margin-right: 20px;
      flex: 1 1 40%;
    }

    .about-us-text {
      flex: 1 1 60%;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .about-us-text h2 {
      font-size: 2.5em;
      margin-bottom: 0.5em;
      color: #4C301F;
    }

    .about-us-text p {
      font-size: 1.2em;
      line-height: 1.6;
      margin-bottom: 1em;
    }

    @media screen and (max-width: 768px) {
      #about-us {
        flex-direction: column;
        align-items: center;
      }

      #about-us img {
        margin-right: 0;
        margin-bottom: 20px;
      }

      .about-us-text {
        align-items: center;
        text-align: center;
      }
    }

    /* Order Section Styles */
    .order {
      background-color: #fff;
      padding: 2em 1em;
      text-align: center;
      width: 100%;
      box-sizing: border-box;
    }

    .order h2 {
      font-size: 2.5em;
      margin-bottom: 0.5em;
      color: #4C301F;
    }

    .order p {
      font-size: 1.2em;
      line-height: 1.6;
      margin-bottom: 1em;
    }

    .order .order-button {
      display: inline-block;
      margin-top: 1em;
      padding: 0.5em 1.5em;
      background-color: #e0c097;
      color: #4a2f2f;
      text-decoration: none;
      border-radius: 5px;
      font-weight: bold;
    }

    /* Features Section Styles */
    .features {
      background-color: #fff;
      padding: 2em 1em;
      text-align: center;
      width: 100%;
      box-sizing: border-box;
    }

    .features h2 {
      font-size: 2.5em;
      margin-bottom: 1em;
      color: #4C301F;
    }

    .features-container {
      width: 100%;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      overflow: hidden;
      position: relative;
    }

    .features-image {
      width: 50%;
      height: 50%;
      display: block;
    }

    /* Products Section Styles */
    .products {
      background-color: #f8f8f8;
      padding: 2em 1em;
      text-align: center;
      width: 100%;
      box-sizing: border-box;
    }

    .products h2 {
      font-size: 2.5em;
      margin-bottom: 1em;
      color: #4C301F;
    }

    .products-container {
      display: flex;
      flex-wrap: wrap;
      gap: 2em;
      justify-content: center;
      width: 100%;
    }

    .product-item {
      flex: 0 1 calc(33.333% - 2em);
      box-sizing: border-box;
      text-align: center;
      background-color: #fff;
      padding: 1em;
      border: 1px solid #ccc;
      border-radius: 5px;
      max-width: 25%;
    }

    .product-item img {
		width: 100%;
      height: auto;
      border-radius: 5px;
    }

    .product-item h3 {
      margin-top: 0.5em;
      font-size: 1.5em;
    }

    .product-item p {
      font-size: 1em;
      color: #666;
    }

    .product-item .price {
      font-size: 1.2em;
      font-weight: bold;
      margin-top: 0.5em;
      color: #4a2f2f;
    }

    .product-item .add-to-cart {
      display: inline-block;
      margin-top: 1em;
      padding: 0.5em 1.5em;
      background-color: #e0c097;
      color: #4a2f2f;
      text-decoration: none;
      border-radius: 5px;
      font-weight: bold;
      cursor: pointer;
    }

    .add-to-cart:hover {
      background-color: #d2b17b;
    }

    /* Footer Styles */
    footer {
      background-color: ##8B7769;
      color: white;
      text-align: center;
      padding: 1em 0;
      width: 100%;
      box-sizing: border-box;
    }

    footer p {
      margin: 0;
      font-size: 1em;
    }

   * Contact Form Styles */
.contact-form {
  text-align: center;
  padding: 20px;
  margin: 20px auto;
  max-width: 500px;
}

.contact-form h2 {
  margin-bottom: 20px;
}

.contact-form label {
  display: block;
  margin-bottom: 5px;
}

.contact-form input[type="text"],
.contact-form input[type="email"],
.contact-form textarea {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

.contact-form textarea {
  height: 150px;
}

.contact-form button {
  background-color: #3498DB;
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  margin-top: 10px;
}

.contact-form button:hover {
  background-color: #2980B9;
}
    /* Main Content Styles */
    main {
      flex: 1;
      width: 100%;
      box-sizing: border-box;
    }

    .logout-button {
      margin-top: 10px;
    }
	.see-more {
    margin-top: 1em;
}

.see-more a {
    display: inline-block;
    padding: 0.5em 1.5em;
    background-color: #e0c097;
    color: #4a2f2f;
    text-decoration: none;
    border-radius: 5px;
    font-weight: bold;
    cursor: pointer;
}

.see-more a:hover {
    background-color: #c9a781; /* Adjust the hover background color as needed */
}
  </style>
</head>
<body>
<header>
  < class="banner-container">
    <div class="heading-content">
      <h1>PO Beans</h1>
      <p>The best place to let your taste bites explore our exclusive beans</p>
    </div>
    <div class="nav-button">
      <button onclick="toggleDropdown()">☰</button>
      <div class="dropdown-content" id="myDropdown">
        <a href="#about-us">About Us</a>
        <a href="#features">Menu</a>
        <a href="#products">Products</a>
        <a href="#order">Order</a>
        <a href="profile.php">Profile</a>
        <a href="logout.php">Logout</a>
        
      </div>
    </div>
  
   <i class="fas fa-user profile-icon"></i>
                    <div class="profile-dropdown">
                        <a href="login.php">Login</a>
                        <a href="logout.php">Logout</a>
                    </div>
                
    </a>
   <?php if(isset($_SESSION['user_name'])) : ?>
      <div class="welcome-message">
        Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!
      </div>
    <?php endif; ?>
    <?php if(isset($_SESSION['registration_success']) && $_SESSION['registration_success'] === true) : ?>
      <div class="welcome-message">
        Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?>! You have successfully registered.
      </div>
    <?php endif; ?>
  </div>
  </div>
</header>


<main>
  <section id="about-us">
    <img src="Aboutpic.jpg" alt="About Us Image">
    <div class="about-us-text">
      <h2>About Us</h2>
      <p>Welcome to PO Beans, your cozy neighborhood coffee shop that specializes in serving premium quality coffee and delightful treats. Our passion for coffee drives us to provide an exceptional experience to our customers. Our passion for coffee starts with sourcing the finest beans from around the world. We roast them in-house to create unique and flavorful blends that will tantalize your taste buds. Pair your coffee with one of our delicious homemade treats, from decadent pastries to fresh-baked varieties. We have something to satisfy every sweet tooth.</p>
    </div>
  </section>

  <section id="features" class="features">
    <h2>Our Menu</h2>
    <div class="features-container">
      <img src="themenu.png" class="features-image" alt="Features Image" onclick="zoomImage(this)">
    </div>
  </section>

 <section id="order" class="order">
    <h2>Pre-Order Now!</h2>
    <p>Order your favorite coffee and treats in advance and pick them up at your convenience. Click below to place your order.</p>
    <a href="Menu.php" class="order-button">Order Now</a>
  </section>
  
  <section id="products" class="products">
    <h2>Our Products</h2>
    <div class="products-container">
        <div class="product-item">
            <img src="espresso.jpg" alt="Product 1">
            <h3>Espresso</h3>
            <p>Strong, roasted coffee beans for espresso drinks.</p>
            <p class="price">R90.99</p>
        </div>
        <div class="product-item">
            <img src="Wsocks.png" alt="Product 2">
            <h3>White Socks</h3>
            <p>Typically made from cotton or synthetic materials. They are a versatile clothing item, but can get dirty easily.</p>
            <p class="price">R19.98</p>
        </div>
        <div class="product-item">
            <img src="bag.png" alt="Product 2">
            <h3>Tote Bag</h3>
            <p>A versatile bag for carrying groceries, books, or other everyday items.</p>
            <p class="price">R42.35</p>
        </div>
    </div>
    <div class="see-more">
        <a href="shop.php" id="see-more-link">
			<p>See More</p>
        </a>
    </div>
</section>



</main>
<form action="send_email.php" method="POST">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>

    <label for="message">Message:</label>
    <textarea id="message" name="message" rows="4" required></textarea>

    <input type="submit" value="Send">
</form>

<footer>
  <p>&copy; 2024 PO Beans. All rights reserved.</p>
  
</footer>


<script>
 function toggleDropdown() {
            document.getElementById("myDropdown").classList.toggle("show");
        }

        function redirectToPage() {
            window.location.href = "login.php"; // Redirect to profile page
        }

        document.getElementById('logoutButton').addEventListener('click', function() {
            // Perform logout operations here
            // For example, clearing session storage or cookies
            sessionStorage.clear();
            localStorage.clear();

            // Redirect to the login page or homepage
            window.location.href = '/login';
        });

        window.onclick = function(event) {
            if (!event.target.matches('.nav-button button')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        };

        document.addEventListener('DOMContentLoaded', (event) => {
            var userName = "<?php echo isset($_SESSION['user_name']) ? htmlspecialchars($_SESSION['user_name']) : ''; ?>";
            var welcomeMessage = document.createElement('div');
            welcomeMessage.className = 'welcome-message';
            var logoutButton = document.createElement('button');
            logoutButton.id = 'logoutButton';
            logoutButton.className = 'logout-button';
            logoutButton.textContent = 'Logout';
            logoutButton.onclick = function() {
                window.location.href = 'logout.php';
            };

            if (userName) {
                welcomeMessage.textContent = 'Welcome, ' + userName + '!';
                document.getElementById('title').insertAdjacentElement('afterend', welcomeMessage);
                document.getElementById('title').insertAdjacentElement('afterend', logoutButton);
            }

            var seeMoreLink = document.getElementById("see-more-link");
            var isLoggedIn = userName !== '';

            if (isLoggedIn) {
                seeMoreLink.href = "online-shop.php";
            } else {
                seeMoreLink.href = "login.php";
                seeMoreLink.addEventListener("click", function(event) {
                    event.preventDefault();
                    alert("Please log in to access the online shop.");
                    window.location.href = "login.php";
                });
                if (welcomeMessage) {
                    welcomeMessage.style.display = 'none';
                }
                if (logoutButton) {
                    logoutButton.style.display = 'none';
                }
            }
        });
    </script>
</body>
</html>