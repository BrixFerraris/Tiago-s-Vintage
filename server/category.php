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
    <div id="ewan" class="content">
        <h1>Category Management</h1>
        
   


        <!-- add new main Category -->
        <div class="category-section">
            <div class="new-category"></div> 
            <form action="./includes/addMainCategory.php" method="POST">
                <input type="text" name="category" placeholder="Add New Main Category" required>
                <button type="submit" name="submit" class="add-btn">Add New Main Category</button>
            </form>
        </div>

        
    </div>
    <script>
document.addEventListener('DOMContentLoaded', function() {
    // WebSocket connection
    var conn = new WebSocket('ws://localhost:8080');
    conn.onopen = function(e) {
        conn.send(JSON.stringify({ type: 'loadParentCategory'}));
        conn.send(JSON.stringify({ type: 'loadCategories'}));
    };
    conn.onmessage = function(e) {
    var category = JSON.parse(e.data);
    console.log(category);
    category.forEach(function(cat) {
        if (cat.type === 'parentCategory') {
            const parentCategory = cat.parent.toLowerCase();
            const categorySection = document.createElement('div');
            categorySection.className = 'category-section';

            const h2 = document.createElement('h2');
            h2.textContent = cat.parent;

            const categoryItemsContainer = document.createElement('div');
            categoryItemsContainer.className = `category-items-${parentCategory}`;

            const form = document.createElement('form');
            form.method = 'POST';
            form.action = './includes/addCategory.php';

            const inputCategory = document.createElement('input');
            inputCategory.type = 'text';
            inputCategory.name = 'category';
            inputCategory.placeholder = `Add new ${cat.parent} category`;
            inputCategory.required = true;

            const inputParent = document.createElement('input');
            inputParent.type = 'hidden';
            inputParent.name = 'parent';
            inputParent.value = cat.parent;

            const submitBtn = document.createElement('button');
            submitBtn.type = 'submit';
            submitBtn.name = 'submit';
            submitBtn.className = 'add-btn';
            submitBtn.textContent = 'Add Category';

            form.appendChild(inputCategory);
            form.appendChild(inputParent);
            form.appendChild(submitBtn);

            categorySection.appendChild(h2);
            categorySection.appendChild(categoryItemsContainer);
            categorySection.appendChild(form);

            var container = document.getElementById('ewan');
            container.appendChild(categorySection); // or append to a specific container
        } else if (cat.type === "categories") {
            const parentCategory = cat.parent.toLowerCase();
            const categoryItemsContainer = document.querySelector(`.category-items-${parentCategory}`);
            if (categoryItemsContainer) {
                let categoryItem = document.createElement('div');
                categoryItem.className = 'category-item';
                categoryItem.innerHTML = `
                    <span class="child">${cat.child}</span>
                    <div class="action-buttons">
                        <button class="edit-btn" data-id="${cat.id}">✏️</button>
                        <button class="delete-btn" data-id="${cat.id}">🗑️</button>
                    </div>
                `;
                categoryItemsContainer.appendChild(categoryItem);
            }
        }
    });
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
