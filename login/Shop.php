<?php
session_start();

// Check if the user is logged in
$is_logged_in = isset($_SESSION['user_name']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Shop</title>
    <style>
        /* Some basic styling */
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
            background-color: #839A71;
            color: Black;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
        }

        .cart {
            border: 1px solid #ccc;
            padding: 10px;
            margin-top: 20px;
        }

        .checkout-button {
            display: inline-block;
            margin-top: 1em;
            padding: 0.5em 1.5em;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
        }

        .modal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        .modal button {
            margin-top: 10px;
        }

        .modal .close {
            position: absolute;
            top: 10px;
            right: 10px;
            background: none;
            border: none;
            font-size: 1.5em;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Welcome to Our Online Shop</h1>
    
    <div id="items">
        <section id="products" class="products">
            <h2>Our Products</h2>
            <div class="products-container">
                <div class="product-item">
                    <img src="espresso.jpg" alt="Product 1">
                    <h3>Espresso</h3>
                    <p>Strong, roasted coffee beans for espresso drinks.</p>
                    <p class="price">R90.99</p>
                    <button class="add-to-cart" data-name="Espresso" data-price="90.99">Add to Cart</button>
                </div>
                <div class="product-item">
                    <img src="arabica.jpg" alt="Product 2">
                    <h3>Arabica</h3>
                    <p>The most popular type of coffee bean, known for its smooth, balanced flavor and pleasant aroma.</p>
                    <p class="price">R90.00</p>
                    <button class="add-to-cart" data-name="Arabica" data-price="90.00">Add to Cart</button>
                </div>
                <div class="product-item">
                    <img src="french toast.jpg" alt="Product 3">
                    <h3>French Roast</h3>
                    <p>A dark roast coffee with a bold, intense flavor and smoky notes.</p>
                    <p class="price">R85.98</p>
                    <button class="add-to-cart" data-name="French Roast" data-price="85.98">Add to Cart</button>
                </div>
                <div class="product-item">
                    <img src="Wsocks.png" alt="Product 4">
                    <h3>White Socks</h3>
                    <p>Typically made from cotton or synthetic materials. They are a versatile clothing item, but can get dirty easily.</p>
                    <p class="price">R19.98</p>
                    <button class="add-to-cart" data-name="White Socks" data-price="19.98">Add to Cart</button>
                </div>
                <div class="product-item">
                    <img src="bsocks.png" alt="Product 5">
                    <h3>Black Socks</h3>
                    <p>Similar to white socks, but provide a more formal look and tend to hide dirt better.</p>
                    <p class="price">R20.00</p>
                    <button class="add-to-cart" data-name="Black Socks" data-price="20.00">Add to Cart</button>
                </div>
                <div class="product-item">
                    <img src="bag.png" alt="Product 6">
                    <h3>Tote Bag</h3>
                    <p>A versatile bag for carrying groceries, books, or other everyday items.</p>
                    <p class="price">R42.35</p>
                    <button class="add-to-cart" data-name="Tote Bag" data-price="42.35">Add to Cart</button>
                </div>
            </div>
        </section>
    
        <!-- Cart section -->
        <div class="cart">
            <h2>Shopping Cart</h2>
            <ul id="cartItems"></ul>
            <p>Total: R<span id="total">0</span></p>
            <button class="checkout-button" id="checkoutButton">Checkout</button>
        </div>

        <!-- Modal for Checkout Options -->
        <div id="checkoutModal" class="modal">
            <button class="close" id="closeModal">&times;</button>
            <h3>Choose Checkout Option</h3>
            <label>
                <input type="radio" name="checkoutOption" value="collect">
                Collect
            </label>
            <label>
                <input type="radio" name="checkoutOption" value="deliver">
                Deliver
            </label>
            <button id="proceedButton">Proceed</button>
        </div>

        <script>
            // Check if the user is logged in
            var isLoggedIn = <?php echo json_encode($is_logged_in); ?>;

            // Function to add items to the cart
            function addToCart(itemName, price) {
                // Create a new list item
                var listItem = document.createElement("li");
                listItem.textContent = itemName + " - R" + price;
                
                // Append the item to the cart
                document.getElementById("cartItems").appendChild(listItem);
                
                // Update total
                var total = parseFloat(document.getElementById("total").textContent);
                total += parseFloat(price);
                document.getElementById("total").textContent = total.toFixed(2);
            }

            // Add event listeners to "Add to Cart" buttons
            document.querySelectorAll('.add-to-cart').forEach(button => {
                button.addEventListener('click', function() {
                    if (!isLoggedIn) {
                        alert("You need to log in to add items to the cart.");
                        window.location.href = 'login.php';
                    } else {
                        var itemName = this.getAttribute('data-name');
                        var price = this.getAttribute('data-price');
                        addToCart(itemName, price);
                    }
                });
            });

            // Add event listener to "Checkout" button
           
            document.getElementById('checkoutButton').addEventListener('click', function() {
                document.get
                document.getElementById('checkoutModal').style.display = 'block';
            });

            // Add event listener to "Close" button
            document.getElementById('closeModal').addEventListener('click', function() {
                document.getElementById('checkoutModal').style.display = 'none';
            });

            // Add event listener to "Proceed" button
            document.getElementById('proceedButton').addEventListener('click', function() {
                var selectedOption = document.querySelector('input[name="checkoutOption"]:checked');
                if (selectedOption) {
                    if (selectedOption.value === 'collect') {
                        window.location.href = 'Collection.html';
                    } else if (selectedOption.value === 'deliver') {
                        window.location.href = 'delivery.html';
                    }
                } else {
                    alert("Please select a checkout option.");
                }
            });
        </script>
    </body>
</html>

</html>
