<?php
  include_once './includes/sidebar.php';
?>

      <!-- Main -->
      <main id="container" class="main-container ">
        <div class="main-title">
          <p class="font-weight-bold">CATEGORY</p>
        </div>
        <div class="add-category">
        <button class="btnAddCat">Add Category</button>
        </div>

            <table id="products" >
                <thead>
                    <tr>
                        <th>Category Id</th>
                        <th>Image</th>
                        <th>Category Name</th>
                        <th>Edit Category</th>
                        <th>Delete Category</th>
                    </tr>
                </thead>
                <tbody id="products-body" >
                    <tr>
                        <td>1</td>
                        <td><img src="../images/bg1.png" alt=""></td>
                        <td>All Products</td>
                        <td><button class="edit-btn" data-id="">Edit</button></td>
                        <td><button class="delete-btn" data-id="">Delete</button></td>
                    </tr>
                </tbody>
            </table>

    <div class="modal-edit">
        <div class="modals">
            <h2>Edit Category</h2>
            <img src="../images/bg1.png" alt="" width="20%"     height="25%">
            <input type="file" id="myFile" name="filename">
            <p>Category Name:</p>
        <input type="text" placeholder="All Product">
        <div class="order-btn">
            <button class="btnSubmit">Submit</button>
            <button class="btnBack">Back</button>
        </div>
    </div>
</div>

<div class="modal-add">
        <div class="modals-addCat">
        <div class="form-group">
                <label for="title">Category Title</label>
                <input type="text" id="title" name="title" placeholder="Title" required>
            </div>
            <div class="form-group">
                <label for="img1">Image</label>
                <input type="file" id="img1" name="img1" accept="image/*" required>
            </div>
            <div class="order-btn">
            <button class="btnaddSubmit">Submit</button>
            <button class="btnaddBack">Back</button>
        </div>
        </div>
    </div>
</div>

<style>

    .add-category{
        display: flex;
        justify-content: flex-end;
        margin-bottom: 10px;
    }

    .modal-active1 {
    visibility: visible;
    opacity: 1;
}
    .modal-edit, .modal-add{
    position: fixed;
    width: 100%;
    height: 100vh;
    top: 0;
    left: 0;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    visibility: hidden;
    opacity: 0;
    transition: visibility 0s, opacity 0.3s ease-in-out;
    }

.modal-active {
    visibility: visible;
    opacity: 1;
}
.modals-addCat{
    background-color: white;
    width: 25%;
    height: 40%;
    display: flex;
    justify-content: space-around;
    align-items: center;
    flex-direction: column;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
}

.modals{
    background-color: white;
    width: 40%;
    height: 60%;
    display: flex;
    justify-content: space-around;
    align-items: center;
    flex-direction: column;
    padding: 10px;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
}
.btnBack, .btnSubmit, .btnAddCat, .btnaddSubmit, .btnaddBack{
    padding: 10px 20px;
    background-color: green;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}
.btnaddBack, .btnBack{
    background-color: #e53935;

}
.btnAddCat, .btnaddSubmit, .btnSubmit{
    background-color: #28a745;

}
</style>
    <script>
    var modalBtn = document.querySelector('.edit-btn');
    var modalBg = document.querySelector('.modal-edit');
    var modalClose = document.querySelector('.btnBack');
    var modalBtn1 = document.querySelector('.btnAddCat');
    var modalBg1 = document.querySelector('.modal-add');
    var modalClose1 = document.querySelector('.btnaddBack');
    
    modalBtn.addEventListener('click', function() {
        modalBg.classList.add('modal-active');
    });
    modalClose.addEventListener('click', function(){
        modalBg.classList.remove('modal-active');
    });

    modalBtn1.addEventListener('click', function() {
        modalBg1.classList.add('modal-active');
    });
    modalClose1.addEventListener('click', function(){
        modalBg1.classList.remove('modal-active');
    });

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
