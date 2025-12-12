<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopify Style Shop</title>
    <link rel="stylesheet" href="shopify.css">
</head>
<style>
    /* GLOBAL */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Inter", sans-serif;
}

body {
    background: #fafafa;
    color: #222;
}

/* HEADER */
.header {
    height: 70px;
    background: white;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 40px;
    position: sticky;
    top: 0;
    z-index: 100;
}

.logo {
    font-size: 24px;
    font-weight: bold;
}

.nav a {
    margin: 0 15px;
    text-decoration: none;
    color: #333;
    font-weight: 500;
}

.cart-icon {
    font-size: 22px;
}

/* HERO SECTION */
.hero {
    text-align: center;
    padding: 80px 20px;
    background: white;
    margin-bottom: 40px;
}

.hero h1 {
    font-size: 48px;
    font-weight: 700;
    margin-bottom: 10px;
}

.hero p {
    font-size: 18px;
    margin-bottom: 20px;
}

.btn-primary {
    background: black;
    color: white;
    padding: 12px 28px;
    border-radius: 6px;
    text-decoration: none;
    font-weight: 500;
    transition: 0.2s;
}

.btn-primary:hover {
    opacity: 0.85;
}

/* PRODUCT SECTION */
.section-title {
    text-align: center;
    font-size: 32px;
    margin-bottom: 30px;
}

.product-section {
    padding: 20px 60px;
}

.product-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
    gap: 30px;
}

.product-card {
    background: white;
    padding: 20px;
    border-radius: 12px;
    text-align: center;
    transition: transform 0.2s ease;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
}

.product-card:hover {
    transform: translateY(-5px);
}

.product-card img {
    width: 100%;
    margin-bottom: 15px;
    border-radius: 8px;
}

.price {
    font-size: 20px;
    font-weight: bold;
    margin: 10px 0;
}

.btn {
    background: black;
    color: white;
    padding: 10px 24px;
    border-radius: 6px;
    border: none;
    cursor: pointer;
}

.btn:hover {
    opacity: 0.85;
}

/* FOOTER */
.footer {
    margin-top: 40px;
    padding: 25px;
    text-align: center;
    background: white;
    border-top: 1px solid #eee;
}

</style>
<body>

<header class="header">
    <div class="logo">MyStore</div>

    <nav class="nav">
        <a href="#">Home</a>
        <a href="#">Shop</a>
        <a href="#">Collections</a>
        <a href="#">Contact</a>
    </nav>

    <div class="cart-icon">🛒</div>
</header>

<section class="hero">
    <h1>Shop the Latest Trends</h1>
    <p>Minimalist, clean, and modern just like Shopify.</p>
    <a class="btn-primary" href="#">Explore Products</a>
</section>

<section class="product-section">
    <h2 class="section-title">Featured Products</h2>

    <div class="product-grid">

        <div class="product-card">
            <img src="https://via.placeholder.com/300" alt="Product 1">
            <h3>Premium Headphones</h3>
            <p class="price">$149</p>
            <button class="btn">Add to Cart</button>
        </div>

        <div class="product-card">
            <img src="https://via.placeholder.com/300" alt="Product 2">
            <h3>Leather Backpack</h3>
            <p class="price">$199</p>
            <button class="btn">Add to Cart</button>
        </div>

        <div class="product-card">
            <img src="https://via.placeholder.com/300" alt="Product 3">
            <h3>Smart Watch</h3>
            <p class="price">$99</p>
            <button class="btn">Add to Cart</button>
        </div>

        <div class="product-card">
            <img src="https://via.placeholder.com/300" alt="Product 4">
            <h3>Running Shoes</h3>
            <p class="price">$129</p>
            <button class="btn">Add to Cart</button>
        </div>

    </div>
</section>

<footer class="footer">
    <p>© 2025 MyStore — Designed Shopify Style</p>
</footer>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\agentbestex\resources\views/backend/settings/create.blade.php ENDPATH**/ ?>