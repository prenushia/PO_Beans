<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <style>
        body {
  font-family: sans-serif;
  background-color: #f5f5f5;
  margin: 0;
  padding: 0;
}

header {
  background-color: #839A71;
  color: black;
  padding: 10px 0;
  text-align: center;
}

header .nav-button {
  position: absolute;
  top: 1em;
  right: 1em;
}

header .nav-button button {
  font-size: 1.5em;
  background-color: transparent; /* Set a transparent background */
  color: black; /* Change to black */
  border: none;
  padding: 0.5em 1em;
  cursor: pointer;
}

header .dropdown-content {
  display: none;
  position: absolute;
  right: 0;
  background-color: white;
  box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
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
  background-color: #f5f5f5; /* Change hover background */
}

header .show {
  display: block;
}

main {
  max-width: 800px;
  margin: 20px auto;
  padding: 20px;
  background-color: white;
  border: 1px solid #ddd;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

h2 {
  text-align: center;
  color: #839A71;
}

.cart {
  padding: 2em;
  text-align: center;
}

.cart-items {
  list-style: none;
  padding: 0;
  display: flex;
  flex-direction: column;
}

.cart-item {
  margin-bottom: 10px;
  border: 1px solid #ddd;
  border-radius: 5px;
  padding: 10px;
}

.cart-item:last-child {
  margin-bottom: 0;
}

.cart-total {
  font-size: 1.2em;
  margin-top: 1em;
}

.checkout-container {
  margin-top: 2em;
  text-align: center;
}

.checkout-button {
  display: inline-block;
  padding: 0.5em 1.5em;
  background-color: #e0c097;
  color: #4a2f2f;
  text-decoration: none;
  border-radius: 5px;
  font-weight: bold;
  cursor: pointer;
  border: none;
}

.checkout-button:hover {
  background-color: #8B7769;
}

    </style>
</head>
<body>
    <h1>Your Cart</h1>
 
 <div class="cart">
      <ul class="cart-items"></ul>
      <p class="cart-total">Total: R<span id="cart-total">0.00</span></p>
     
    </div>
        <label>
          <input type="radio" name="delivery-option" value="delivery" id="delivery-option">
          Delivery
        </label>
        <label>
          <input type="radio" name="delivery-option" value="collection" id="collection-option">
          Collection
        </label>
      </div>
      <button class="checkout-button" onclick="proceedToCheckout()">Proceed to Checkout</button>

    </section>
  </main>


  <script>
let cart = [];

// Function to add item to cart
function addToCart(itemName, itemPrice = null) {
  // Check if user is logged in
  if (!isLoggedIn()) {
    alert("Please log in to add items to your cart.");
    return;
  }

  if (itemPrice !== null) {
    // Adding an item without size and milk options (like Croissant)
    let existingItem = cart.find(item => item.name === itemName);
    if (existingItem) {
      existingItem.quantity++;
    } else {
      cart.push({
        name: itemName,
        price: itemPrice,
        quantity: 1
      });
    }
  } else {
    // Adding items with size and milk options
    const priceElement = document.getElementById(itemName.toLowerCase().replace(/ /g, '-') + '-price');
    const selectedSize = document.querySelector(`input[name="${itemName.toLowerCase().replace(/ /g, '-') + '-size'}"]:checked`);
    const selectedMilk = document.querySelector(`input[name="${itemName.toLowerCase().replace(/ /g, '-') + '-milk'}"]:checked`);

    if (selectedSize) {
      let price = parseFloat(selectedSize.getAttribute('data-price'));

      if (selectedMilk) {
        // Assuming no extra cost for different milk options
      }

      priceElement.innerText = price.toFixed(2);

      let existingItem = cart.find(item => item.name === itemName);
      if (existingItem) {
        existingItem.quantity++; // Update quantity for existing item
      } else {
        // Check for existing item with just the size (no milk)
        existingItem = cart.find(item => item.name === itemName && item.size === selectedSize.id);
      }

      if (existingItem) {
        existingItem.quantity++; // Update quantity for existing item
      } else {
        cart.push({
          name: itemName,
          size: selectedSize.id,
          milk: selectedMilk ? selectedMilk.id : 'none',
          price: price,
          quantity: 1
        });
      }
    } else {
      alert(`Please select a size for the ${itemName}`);
    }
  }
  updateCartDisplay(); // Update cart display after adding item
}

// Function to check if user is logged in
function isLoggedIn() {
  // Implement your logic to check if the user is logged in
  // For simplicity, let's assume a global variable isLoggedIn represents the login status
  return isLoggedIn; // Return true if user is logged in, false otherwise
}

// ... other functions remain unchanged



function removeFromCart(button, itemPrice) {
  const itemName = button.parentNode.querySelector('.cart-item-name').textContent;
  const item = cart.find(item => item.name === itemName);
  if (item) {
    item.quantity--;
    if (item.quantity === 0) {
      cart = cart.filter(cartItem => cartItem.name !== itemName);
    }
    updateCartDisplay();
    const cartTotal = document.getElementById('cart-total');
    const currentTotal = parseFloat(cartTotal.textContent);
    const newTotal = currentTotal - itemPrice;
    cartTotal.textContent = newTotal.toFixed(2);
  }
}

 function proceedToCheckout() {
  // Check the delivery or collection option
  const deliveryOption = document.getElementById('delivery-option').checked;
  const collectionOption = document.getElementById('collection-option').checked;

  if (deliveryOption) {
    // Redirect to the delivery page
    window.location.href = "delivery.html";
  } else if (collectionOption) {
    // Redirect to the collection page
    window.location.href = "collection.html";
  } else {
    // Prompt user to select an option if neither is selected
    alert('Please select a delivery or collection option.');
  }
}

      });
    });
  }
    </script>
</body>
</html>
