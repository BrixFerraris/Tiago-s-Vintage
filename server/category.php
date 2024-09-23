<?php
  include_once './includes/sidebar.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Category Page</title>
    <link rel="stylesheet" href="../CSS/category.css">
</head>
<body>
    <div class="content">
        <h1>Category Management</h1>
        
        <!-- Tops Category -->
        <div class="category-section">
            <h2>Tops</h2>
            <div class="category-item">
                <span>All Tops</span>
                <div class="action-buttons">
                    <button class="edit-btn">✏️</button>
                    <button class="delete-btn">🗑️</button>
                </div>
            </div>
            <div class="category-item">
                <span>T-Shirt</span>
                <div class="action-buttons">
                    <button class="edit-btn">✏️</button>
                    <button class="delete-btn">🗑️</button>
                </div>
            </div>
            <div class="category-item">
                <span>Hoodies</span>
                <div class="action-buttons">
                    <button class="edit-btn">✏️</button>
                    <button class="delete-btn">🗑️</button>
                </div>
            </div>
            <div class="category-item">
                <span>Longsleeves</span>
                <div class="action-buttons">
                    <button class="edit-btn">✏️</button>
                    <button class="delete-btn">🗑️</button>
                </div>
            </div>
            <form method="POST" action="./includes/addCategory.php">
                <input type="text" name="category" placeholder="Add new Tops category" required>
                <input type="hidden" name="parent" value="Tops">
                <button type="submit" name="submit" class="add-btn">Add Category</button>
            </form>
        </div>

        <!-- Bottoms Category -->
        <div class="category-section">
            <h2>Bottoms</h2>
            <div class="category-item">
                <span>All Bottoms</span>
                <div class="action-buttons">
                    <button class="edit-btn">✏️</button>
                    <button class="delete-btn">🗑️</button>
                </div>
            </div>
            <div class="category-item">
                <span>Pants</span>
                <div class="action-buttons">
                    <button class="edit-btn">✏️</button>
                    <button class="delete-btn">🗑️</button>
                </div>
            </div>
            <div class="category-item">
                <span>Short</span>
                <div class="action-buttons">
                    <button class="edit-btn">✏️</button>
                    <button class="delete-btn">🗑️</button>
                </div>
            </div>
            <div class="category-item">
                <span>Double Knee</span>
                <div class="action-buttons">
                    <button class="edit-btn">✏️</button>
                    <button class="delete-btn">🗑️</button>
                </div>
            </div>
            <form method="POST" action="./includes/addCategory.php">
                <input type="text" name="category" placeholder="Add new Bottoms category" required>
                <input type="hidden" name="parent" value="Bottoms">
                <button type="submit" name="submit" class="add-btn">Add Category</button>
            </form>
        </div>

        <!-- Shoes Category -->
        <div class="category-section">
            <h2>Shoes</h2>
            <div class="category-item">
                <span>All Shoes</span>
                <div class="action-buttons">
                    <button class="edit-btn">✏️</button>
                    <button class="delete-btn">🗑️</button>
                </div>
            </div>
            <div class="category-item">
                <span>Running Shoes</span>
                <div class="action-buttons">
                    <button class="edit-btn">✏️</button>
                    <button class="delete-btn">🗑️</button>
                </div>
            </div>
            <div class="category-item">
                <span>Casual Shoes</span>
                <div class="action-buttons">
                    <button class="edit-btn">✏️</button>
                    <button class="delete-btn">🗑️</button>
                </div>
            </div>
            <form method="POST" action="./includes/addCategory.php">
                <input type="text" name="category" placeholder="Add new Shoes category" required>
                <input type="hidden" name="parent" value="Shoes">
                <button type="submit" name="submit" class="add-btn">Add Category</button>
            </form>
        </div>
    </div>
    <script>
document.addEventListener('DOMContentLoaded', function() {
    //Websocket connection
    var conn = new WebSocket('ws://localhost:8080');
            conn.onopen = function(e) {
                conn.send(JSON.stringify({ type: 'qeqeq'}));
            };
            conn.onmessage = function(e) {
    var category = JSON.parse(e.data);
    if (category.parent === 'Tops') {
        var categorySection = document.querySelector('.category-section-Tops');
        console.log(category);

        // Clear existing categories
        categorySection.innerHTML = '<h2>Tops</h2>';

        // Loop through the received categories and create elements
        category.items.forEach(function(item) {
            categorySection.innerHTML += `
                <div class="category-item">
                    <span>${item.name}</span>
                    <div class="action-buttons">
                        <button class="edit-btn">✏️</button>
                        <button class="delete-btn">🗑️</button>
                    </div>
                </div>
            `;
        });

        // Append the form
        categorySection.innerHTML += `
            <form method="POST" action="./includes/addCategory.php">
                <input type="text" name="category" placeholder="Add new Tops category" required>
                <input type="hidden" name="parent" value="Tops">
                <button type="submit" name="submit" class="add-btn">Add Category</button>
            </form>
        `;
    }
};


        });
    </script>
</body>
</html>
