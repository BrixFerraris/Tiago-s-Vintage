<?php
session_start();

if (isset($_SESSION["role"])) {
    $role = $_SESSION["role"];
    if ($role === 'Super Admin') {
        include_once './includes/sidebar.php';
    } elseif ($role === 'Add Product') {
        include_once './includes/sidebarAdd_Product.php';
    } else {
        header("location: adminDashboard.php");
        exit();
    }
} else {
    header("location: ./adminLogin.php?error=NotLoggedIn");
    exit();
}
?>

<!-- Main -->
<main class="main-container">
    <div class="main-title">
        <p class="font-weight-bold">ADD PRODUCT</p>
    </div>

    <!-- form add products -->
    <div class="form-container">
        <form action="./includes/uploadSingleProduct.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Product Title</label>
                <input type="text" id="title" name="title" placeholder="Title" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" placeholder="Description" required></textarea>
            </div>

            <div class="form-group">
                <label for="price">Price (PHP)</label>
                <input type="text" id="price" name="price" placeholder="Price (PHP)" required pattern="^\d+(\.\d{2})?$"
                    title="Enter a valid amount in PHP, e.g., 123.45">
            </div>

            <div class="form-group">
                <label for="categories">Category</label>
                <select name="category" id="categories" required>
                    <option value="Tops">
                    <option value="Bottoms">
                    <option value="Shoes">
                    <option value="Accessories">
                </select>
            </div>

            <div class="form-group">
                <div class="media-upload">
                    <label class="btn-upload-photo">
                        <span>Add Photo</span>
                        <br>
                        <input type="file" name="photoInput[]" accept="image/*" multiple id="photoInput" >
                        
                    </label>
                    <small>(Max 4 images)</small>
                </div>
                <div class="media-preview" id="photoPreview"></div>
            </div>

            <button name="submit" type="submit">Add Product</button>
        </form>
    </div>
</main>
<!-- End Main -->

</div>

<script>

    // SIDEBAR TOGGLE

    let sidebarOpen = false;
    const sidebar = document.getElementById('sidebar');

    function openSidebar() {
        if (!sidebarOpen) {
            sidebar.classList.add('sidebar-responsive');
            sidebarOpen = true;
        }
    }

    function closeSidebar() {
        if (sidebarOpen) {
            sidebar.classList.remove('sidebar-responsive');
            sidebarOpen = false;
        }
    }

    $(document).ready(function () {
        function fetchCategories() {
            $.ajax({
                url: '../server/includes/getCategories.php',
                method: 'GET',
                dataType: 'json',
                success: function (data) {
                    $('#categories').empty();
                    if (Array.isArray(data) && data.length > 0) {
                        $('#categories').append('<option value="">Select a category</option>');
                        $.each(data, function (index, category) {
                            $('#categories').append(`
                            <option value="${category.category}">${category.category}</option>
                        `);
                        });
                    } else {
                        $('#categories').append('<option value="">No categories found</option>');
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error("Error fetching categories: ", textStatus, errorThrown);
                    $('#categories').append('<option value="">Error loading categories</option>');
                }
            });
        }
        fetchCategories();
    });



        // Images
        document.getElementById('photoInput').addEventListener('change', function(event) {
    const photoPreview = document.getElementById('photoPreview');
    const existingImages = photoPreview.getElementsByTagName('img'); // Get existing images
    const existingCount = existingImages.length; // Count of existing images

    const files = Array.from(event.target.files);

    // Check how many more images can be added
    const availableSlots = 4 - existingCount;

    // Limit the selection to 3 images in total
    if (files.length > availableSlots) {
        alert('You can upload a maximum of 4 images in total.');
        event.target.value = ''; // Clear the file input if limit exceeded
        return;
    }

    // Loop through each selected file and create an image preview
    let imageCount = existingCount; // Start counting from the existing images
    files.forEach(file => {
        if (file.type.startsWith('image/') && imageCount < 4) {
            const reader = new FileReader();
            reader.onload = function(e) {
                // Create a container for the image and the close button
                const imageContainer = document.createElement('div');
                imageContainer.classList.add('image-container');

                // Create the image element
                const img = document.createElement('img');
                img.src = e.target.result;
                img.classList.add('photo-thumbnail');

                // Create the close button
                const closeButton = document.createElement('button');
                closeButton.classList.add('close-button');
                closeButton.innerHTML = '✖'; // X mark

                // Add event listener to remove the image
                closeButton.addEventListener('click', function() {
                    photoPreview.removeChild(imageContainer);
                });

                // Append the image and close button to the container
                imageContainer.appendChild(img);
                imageContainer.appendChild(closeButton);

                // Append the container to the preview
                photoPreview.appendChild(imageContainer);
                imageCount++;
            };
            reader.readAsDataURL(file);
        }
    });
});

</script>
</body>

</html>