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
            <div class="category-items-tops"></div> 
            <form method="POST" action="./includes/addCategory.php">
                <input type="text" name="category" placeholder="Add new Tops category" required>
                <input type="hidden" name="parent" value="Tops">
                <button type="submit" name="submit" class="add-btn">Add Category</button>
            </form>
        </div>


        <!-- Bottoms Category -->
        <div class="category-section">
            <h2>Bottoms</h2>
            <div class="category-items-bottoms"></div> 
            <form method="POST" action="./includes/addCategory.php">
                <input type="text" name="category" placeholder="Add new Bottoms category" required>
                <input type="hidden" name="parent" value="Bottoms">
                <button type="submit" name="submit" class="add-btn">Add Category</button>

            </form>
        </div>

        <!-- Shoes Category -->
        <div class="category-section">
            <h2>Shoes</h2>
            <div class="category-items-shoes"></div> 
            <form method="POST" action="./includes/addCategory.php">
                <input type="text" name="category" placeholder="Add new Shoes category" required>
                <input type="hidden" name="parent" value="Shoes">
                <button type="submit" name="submit" class="add-btn">Add Category</button>
            </form>
        </div>
    </div>
    <script>
document.addEventListener('DOMContentLoaded', function() {
    // WebSocket connection
    var conn = new WebSocket('ws://localhost:8080');
    conn.onopen = function(e) {
        conn.send(JSON.stringify({ type: 'loadParentCategory'}));
        // conn.send(JSON.stringify({ type: 'loadCategories'}));
    };
    conn.onmessage = function(e) {
        var category = JSON.parse(e.data);
        console.log(category);
        if (category.parent === 'Tops') {
            let categoryItemsContainer = document.querySelector('.category-items-tops');
            var categoryItem = document.createElement('div');
            categoryItem.className = 'category-item';
            categoryItem.innerHTML = `
                <span class="child">${category.child}</span>
                <div class="action-buttons">
                    <button class="edit-btn" data-id="${category.id}">✏️</button>
                    <button class="delete-btn" data-id="${category.id}">🗑️</button>
                </div>
            `;
            categoryItemsContainer.appendChild(categoryItem);
        }
        if (category.parent === 'Bottoms') {
            let categoryItemsContainer = document.querySelector('.category-items-bottoms');
            var categoryItem = document.createElement('div');
            categoryItem.className = 'category-item';
            categoryItem.innerHTML = `
                <span class="child">${category.child}</span>
                <div class="action-buttons">
                    <button class="edit-btn" data-id="${category.id}">✏️</button>
                    <button class="delete-btn" data-id="${category.id}">🗑️</button>
                </div>
            `;
            categoryItemsContainer.appendChild(categoryItem);
            console.log(category);
        }
        if (category.parent === 'Shoes') {
            let categoryItemsContainer = document.querySelector('.category-items-shoes');
            var categoryItem = document.createElement('div');
            categoryItem.className = 'category-item';
            categoryItem.innerHTML = `
                <span class="child">${category.child}</span>
                <div class="action-buttons">
                    <button class="edit-btn" data-id="${category.id}">✏️</button>
                    <button class="delete-btn" data-id="${category.id}">🗑️</button>
                </div>
            `;
            categoryItemsContainer.appendChild(categoryItem);
            console.log(category);
        }
        else {
            console.error('Unknown category parent:', category.parent);
        }
    };
    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('delete-btn')) {
            var id = event.target.getAttribute('data-id');
            conn.send(JSON.stringify({ type: 'deleteCategory', id: id }));
            alert('Category deleted successfully');
            location.reload();
            conn.send(JSON.stringify({ type: 'loadCategories'}));
        } else if (event.target.classList.contains('edit-btn')) {
            var id = event.target.getAttribute('data-id');
            var categoryItem = event.target.closest('.category-item');
            var childElement = categoryItem.querySelector('.child');
            var currentText = childElement.textContent;
            var input = document.createElement('input');
            input.type = 'text';
            input.value = currentText;
            input.className = 'edit-input';
            childElement.replaceWith(input);
            input.focus();

            input.addEventListener('blur', function() {
                saveChanges(input, id);
            });
            input.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    saveChanges(input, id);
                }
            });
        }
    });
    function saveChanges(input, id) {
        var newValue = input.value;
        var span = document.createElement('span');
        span.className = 'child';
        span.textContent = newValue;
        input.replaceWith(span);
        conn.send(JSON.stringify({ type: 'updateCategory', id: id, newValue: newValue }));
    }
});

    </script>

</body>
</html>
