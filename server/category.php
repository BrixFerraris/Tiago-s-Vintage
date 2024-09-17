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
            <form method="POST" action="category.php">
                <input type="text" name="new_category_tops" placeholder="Add new Tops category" required>
                <button type="submit" class="add-btn">Add Category</button>
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
            <form method="POST" action="category.php">
                <input type="text" name="new_category_bottoms" placeholder="Add new Bottoms category" required>
                <button type="submit" class="add-btn">Add Category</button>
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
            <form method="POST" action="category.php">
                <input type="text" name="new_category_shoes" placeholder="Add new Shoes category" required>
                <button type="submit" class="add-btn">Add Category</button>
            </form>
        </div>
    </div>
</body>
</html>
