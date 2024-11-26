<?php
include './header.php';
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">

<!-- Main Content -->
<div class="container">
    <!-- Order Tabs -->
    <div class="tabs">
        <button class="tab-button" onclick="window.location.href='toPay.php'">To Pay</button>
        <button class="tab-button" onclick="window.location.href='toReceived.php'">To Receive</button>
        <button class="tab-button active" onclick="window.location.href='completed.php'">Completed</button>
        <button class="tab-button" onclick="window.location.href='cancelled.php'">Cancelled</button>
    </div>

    <!-- Completed Orders Section -->
    <div class="order-section" id="completed">

    </div>

</div>
<div class="modal-review">
    <div class="modals">
        <form action="./includes/addReview.php" method="post" enctype="multipart/form-data">

            <h5>Write a review</h5>
            <input type="hidden" name="transID" id="transID">
            <input type="hidden" name="title" id="title">
            <input type="hidden" name="variationName" id="variationName">

            <div class="rateyo" id="rating" data-rateyo-rating="4" data-rateyo-num-stars="5" data-rateyo-score="3">
            </div>

            <span class='result'>0</span>
            <input type="hidden" id="rating-value" name="rating">

            <textarea class="comments" name="comments" id="comments" rows="10"
                placeholder="Share more thoughts on the products to help other buy."></textarea>

            <!-- Add Photo Upload Button -->
            <div class="media-upload">
                <label class="btn-upload-photo">
                    <input type="file" name="photoInput[]" accept="image/*" multiple id="photoInput" hidden>
                    <span>Add Photo</span>
                </label>
                <small>(Max 3 images)</small>
            </div>

            <!-- Image Preview Section -->
            <div class="media-preview" id="photoPreview"></div>

            <div class="order-btn">
                <button type="submit" class="btnSubmitReview">Submit</button>
                <button type="button" class="btnCancel">Cancel</button>
            </div>
        </form>
    </div>
</div>
<script>
    $(document).ready(function () {
        $.ajax({
            url: './includes/getOrders.php',
            type: 'GET',
            dataType: 'json',
            success: function (orders) {
                console.log(orders);
                var hasOrders = false;
                $.each(orders, function (index, order) {
                    var itemTitles = order.items.map(item => item.title).join(', ');
                    var itemSizes = order.items.map(item => item.size).join('<br>');
                    var totalQuantity = order.total_quantity;
                    var totalPrice = order.grandtotal;
                    if (order.status === 'Completed') {
                        hasOrders = true;
                        var orderItem = `
                    <div class="order-item">
                        <div class="item-details">
                            <img src="../server/includes/uploads/${order.first_img}" alt="Product Image" style="width: 100px; height: auto;">
                            <div>
                                <h5>${itemTitles}</h5>
                                <p>Size: <br>${itemSizes}</p>
                                <p>Quantity: ${totalQuantity}</p>
                                <p>Total Items: ${totalQuantity}</p>
                            </div>
                        </div>
                        <div class="item-status">
                            <p class="status completed">${order.status}</p>
                        </div>
                        <div class="item-price">
                            <p>₱${totalPrice.toFixed(2)}</p>
                        </div>
                        <div class="item-actions">
                            <div id="review-action-${order.transaction_id}">
                                ${order.reviewed === 'true' ? 
                                    '<span>Reviewed</span>' : 
                                    `<button data-variation="${order.variationName}" data-title="${order.title}" data-id="${order.transaction_id}" data-reviewed="${order.reviewed}" class="confirm-receive-btn">Write Review</button>`}
                            </div>
                        </div>
                    </div>`;
                        $('#completed').append(orderItem);
                    }
                });
                if (!hasOrders) {
                    $('#completed').append('<br><h1>No Completed Orders Yet</h1>');
                }
                $('.confirm-receive-btn').on('click', function () {
                    var transactionId = $(this).data('id');
                    var title = $(this).data('title');
                    var variationName = $(this).data('variation');
                    $('#transID').val(transactionId);
                    $('#title').val(title);
                    $('#variationName').val(variationName);
                    var modalBg = $('.modal-review');
                    modalBg.addClass('modal-active');
                });
                $('.btnCancel').on('click', function () {
                    var modalBg = $('.modal-review');
                    modalBg.removeClass('modal-active');
                });
            },
            error: function (xhr, status, error) {
                console.error('Error fetching orders:', error);
            }
        });
        $('.btnSubmitReview').on('click', function (event) {
            var transID = $('#transID').val();
            if (transID) {
                $.ajax({
                    url: './updateReviewed.php',
                    type: 'POST', 
                    data: {
                        transaction_id: transID
                    },
                    success: function (response) {
                        console.log('Success:', response);
                        location.reload();
                    },
                    error: function (xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            } else {
                alert('Transaction ID is required.');
            }
        });
    });

    // Stars

    $(function () {
        $(".rateyo").rateYo({
            starWidth: "25px",
            rating: 0,
            numStars: 5,
            precision: 0,
            halfStar: false
        }).on("rateyo.change", function (e, data) {
            var rating = data.rating;
            $(this).parent().find('.result').text('Rating: ' + rating);
            $(this).parent().find('#rating-value').val(rating);
        }).on("rateyo.set", function (e, data) {
            var rating = data.rating;
            $(this).parent().find('.result').text('Rating: ' + rating);
            $(this).parent().find('#rating-value').val(rating);
        });
    });


    // Images
    document.getElementById('photoInput').addEventListener('change', function (event) {
        const photoPreview = document.getElementById('photoPreview');
        const existingImages = photoPreview.getElementsByTagName('img'); // Get existing images
        const existingCount = existingImages.length; // Count of existing images

        const files = Array.from(event.target.files);

        // Check how many more images can be added
        const availableSlots = 3 - existingCount;

        // Limit the selection to 3 images in total
        if (files.length > availableSlots) {
            alert('You can upload a maximum of 3 images in total.');
            event.target.value = ''; // Clear the file input if limit exceeded
            return;
        }

        // Loop through each selected file and create an image preview
        let imageCount = existingCount; // Start counting from the existing images
        files.forEach(file => {
            if (file.type.startsWith('image/') && imageCount < 3) {
                const reader = new FileReader();
                reader.onload = function (e) {
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
                    closeButton.addEventListener('click', function () {
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
</body>

</html>
<style>
    .comments {
        margin-bottom: 10px;
        width: 400px;
    }

    body {
        background-color: #f0f0f5;
    }

    .container p {
        color: black;
    }

    .container p:hover {
        cursor: default;
    }

    textarea {
        padding-left: 10px;
    }

    .order-btn {
        display: flex;
        flex-direction: row;
        width: 200px;
        margin-left: 10px;
        align-items: center;
    }

    .order-btn button {
        margin: 10px;
    }


    /* Modal Overlay */
    .modal-review {
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

    /* Modal Styling */
    .modals {
        background-color: white;
        width: 90%;
        max-width: 500px;
        /* Limit the modal width */
        height: auto;
        display: flex;
        justify-content: space-around;
        align-items: flex-start;
        flex-direction: column;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        overflow: hidden;
    }

    /* Buttons Styling */
    .modals .btnSubmitReview,
    .modals .btnCancel {
        padding: 10px 20px;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-bottom: 10px;
        width: 200px;
        /* Set default button width */
        font-size: 16px;
        /* Default font size */
    }

    .modals .btnSubmitReview {
        background-color: green;
    }

    .modals .btnCancel {
        background-color: #f44336;
    }

    .container {
        max-width: 1500px;
        margin: 20px auto;
        background-color: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }


    .menu {
        list-style: none;
        display: flex;
        justify-content: center;
    }

    .menu li {
        margin: 0 20px;
    }

    .menu a {
        color: white;
        text-decoration: none;
        font-size: 16px;
        font-weight: bold;
    }

    .menu a:hover {
        text-decoration: underline;
    }

    /* Tabs for Orders */


    .tabs {
        display: flex;
        justify-content: space-around;
        /* Align items to the left for scrolling */
        gap: 10px;
        /* Space between buttons */
        overflow-x: auto;
        /* Enable horizontal scrolling */
        padding: 10px;
        white-space: nowrap;
        /* Prevent buttons from wrapping */
        border-bottom: 1px solid #ddd;
        /* Optional: underline for aesthetics */
    }

    .tabs::-webkit-scrollbar {
        height: 8px;
        /* Height of the scrollbar */
    }

    .tabs::-webkit-scrollbar-thumb {
        background: #ccc;
        /* Scrollbar color */
        border-radius: 4px;
    }

    .tabs::-webkit-scrollbar-thumb:hover {
        background: #bbb;
        /* Scrollbar hover color */
    }


    .tab-button {
        background-color: #f0f0f5;
        border: none;
        padding: 10px 20px;
        font-size: 16px;
        cursor: pointer;
    }

    .tab-button.active {
        background-color: #4CAF50;
        color: white;
    }

    .order-section {
        max-width: auto;
        margin: 0 auto;
        padding: 20px;
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        overflow-x: auto;
        /* Enable horizontal scrolling if necessary */
    }

    .order-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #ddd;
        padding: 15px 0;
        flex-wrap: wrap;
        /* Allow wrapping on smaller screens */
    }

    .item-details {
        display: flex;
        align-items: center;
        flex: 1 1 60%;
        /* Ensure flexibility for smaller screens */
        min-width: 200px;
        /* Set a minimum width to avoid collapsing */
        margin-bottom: 10px;
        /* Add spacing between stacked rows */
    }

    .item-details img {
        width: 80px;
        height: 80px;
        margin-right: 15px;
    }

    .item-details p {
        font-size: small;
        color: black;
    }

    .item-status {
        width: 100px;
        text-align: center;
        flex: 1 1 auto;
        /* Adjust width dynamically */
    }

    .item-price {
        width: 100px;
        text-align: center;
        flex: 1 1 auto;
        /* Adjust width dynamically */
    }

    .item-actions {
        width: 150px;
        text-align: center;
        flex: 1 1 auto;
        /* Adjust width dynamically */
        margin-top: 10px;
        /* Add spacing for smaller screens */
    }

    .status.complete {
        color: #0066cc;
        font-weight: bold;
    }

    .confirm-receive-btn {
        background-color: #0066cc;
        color: white;
        padding: 8px 16px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        width: 100%;
        /* Ensure the button spans full width on smaller screens */
    }

    /* Button styles for "Confirm Receipt" */
    .item-details p {
        font-size: small;
    }

    .confirm-receive-btn:hover {
        background-color: #004c99;
    }

    .checked {
        color: orange;
    }

    /* Styling for the Add Photo button */
    .btn-upload-photo {
        display: inline-flex;
        align-items: center;
        padding: 10px 20px;
        background-color: #ff5722;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .modal-review {
        z-index: 1000;
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

    .modals {
        background-color: white;
        width: auto;
        height: 70%;
        display: flex;
        justify-content: space-around;
        align-items: left;
        flex-direction: column;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        overflow-y: auto;
    }

    .container {
        max-width: 1500px;
        margin: 20px auto;
        background-color: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }


    .menu {
        list-style: none;
        display: flex;
        justify-content: center;
    }

    .menu li {
        margin: 0 20px;
    }

    .menu a {
        color: white;
        text-decoration: none;
        font-size: 16px;
        font-weight: bold;
        font-size: 16px;
        transition: background-color 0.3s ease;
    }

    .btn-upload-photo .upload-icon {
        font-size: 20px;
        margin-right: 8px;
    }

    .btn-upload-photo input[type="file"] {
        display: none;
        /* Hide the actual file input */
    }

    .photo-thumbnail {
        border: 1px solid #ccc;
        border-radius: 4px;
        object-fit: cover;
        width: 100px;
        /* Set thumbnail width */
        height: 100px;
        /* Set thumbnail height */
        margin: 5px;
        /* Add some spacing */
    }

    /* New styles for the image container and close button */
    .image-container {
        position: relative;
        display: inline-block;
        margin: 5px;
    }

    .close-button {
        position: absolute;
        top: 0;
        right: 0;
        background-color: red;
        color: white;
        border: none;
        border-radius: 50%;
        cursor: pointer;
        width: 20px;
        height: 20px;
        text-align: center;
        line-height: 20px;
        font-size: 14px;
        padding: 0;
        outline: none;
    }

    .close-button:hover {
        background-color: darkred;
        /* Change color on hover */
    }

    /* Responsive Breakpoints */
    @media screen and (max-width: 768px) {
        .order-item {
            flex-direction: column;
            align-items: flex-start;
            /* Align items to the left on smaller screens */
        }

        .item-details {
            margin-bottom: 10px;
            /* Add spacing between rows */
        }

        .item-details p {
            margin: 10px;
            /* Add spacing between rows */
        }

        .item-status,
        .item-price {
            width: auto;
            /* Allow flexible width */
            text-align: left;
        }

        .item-action {
            flex-direction: row;
            align-items: flex-start;
        }
    }

    @media (max-width: 768px) {
        .tabs {
            padding: 5px;
        }

        .tab-button {
            font-size: 14px;
            /* Smaller font size for smaller screens */
            padding: 8px 15px;
        }
    }

    @media (max-width: 425px) {
        .tab-button {
            font-size: 12px;
            padding: 5px 10px;
        }
    }



    /* Responsive Adjustments */
    @media screen and (max-width: 768px) {
        .modals {
            width: 90%;
            /* Take up more width on smaller screens */
            max-width: 400px;
            height: 70%;
        }

        .modals .btnSubmitReview,
        .modals .btnCancel {
            width: 100%;
            /* Buttons will span full width on smaller screens */
            padding: 12px 0;
            font-size: 14px;
            /* Smaller font size for mobile */
        }

        .comments {
            width: 350px;
        }
    }

    @media screen and (max-width: 480px) {
        .comments {
            width: 250px;
        }

        .modals {
            padding: 15px;
            /* Reduce padding on very small screens */
        }

        .modals .btnSubmitReview,
        .modals .btnCancel {
            padding: 10px 0;
            font-size: 12px;
            /* Further reduce font size */
        }
    }
</style>


<?php
include '../test/newFooter.php';
?>