// CampusCart Express - Simple Cart System

// Load cart from localStorage or start empty
let cart = JSON.parse(localStorage.getItem('campusCart')) || [];

// Update cart count in the navigation
function updateCartCount() {
    const countElements = document.querySelectorAll('#cart-count');
    const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
    
    countElements.forEach(el => {
        el.textContent = totalItems;
    });
}

// Add product to cart
function addToCart(name, price) {
    // Check if product already exists in cart
    const existingItem = cart.find(item => item.name === name);

    if (existingItem) {
        existingItem.quantity += 1;
    } else {
        cart.push({
            name: name,
            price: price,
            quantity: 1
        });
    }

    // Save to localStorage
    localStorage.setItem('campusCart', JSON.stringify(cart));
    
    // Update the cart count display
    updateCartCount();

    // Feedback to user
    alert(`✅ "${name}" added to cart!`);
}

// Display cart items on the payment page
function displayCart() {
    const cartItemsContainer = document.getElementById('cart-items');
    const cartTotalElement = document.getElementById('cart-total');

    if (!cartItemsContainer) return; // Only run on payment page

    if (cart.length === 0) {
        cartItemsContainer.innerHTML = '<p style="color: #64748b;">Your cart is currently empty. Go to the Shop and add some items.</p>';
        cartTotalElement.textContent = 'KES 0';
        return;
    }

    let html = '';
    let total = 0;

    cart.forEach(item => {
        const itemTotal = item.price * item.quantity;
        total += itemTotal;

        html += `
            <div style="display: flex; justify-content: space-between; margin-bottom: 0.8rem; padding-bottom: 0.8rem; border-bottom: 1px solid #e2e8f0;">
                <div>
                    <strong>${item.name}</strong><br>
                    <small>KES ${item.price.toLocaleString()} × ${item.quantity}</small>
                </div>
                <div style="font-weight: 600;">
                    KES ${itemTotal.toLocaleString()}
                </div>
            </div>
        `;
    });

    cartItemsContainer.innerHTML = html;
    cartTotalElement.textContent = `KES ${total.toLocaleString()}`;
}

// Run when page loads
document.addEventListener('DOMContentLoaded', function() {
    updateCartCount();
    displayCart();
});