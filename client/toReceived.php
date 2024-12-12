<?php
include './header.php';
$role = isset($_SESSION['role']) ? $_SESSION['role'] : '';

?>

<!-- Main Content -->
<div class="container">
    <!-- Order Tabs -->
    <div class="tabs">
        <button class="tab-button" onclick="window.location.href='toPay.php'">To Pay</button>
        <button class="tab-button active" onclick="window.location.href='toReceived.php'">To Receive</button>
        <button class="tab-button" onclick="window.location.href='completed.php'">Completed</button>
        <button class="tab-button" onclick="window.location.href='cancelled.php'">Cancelled</button>
    </div>

    <div class="order-section" id="to-pay">
        <!-- To Receive Section -->
        <h4>My Orders - To Receive</h4>
        <div class="orders-container">
            <!-- Order items will be dynamically inserted here -->
        </div>
    </div>

    <div class="modal fade" id="issueModal" tabindex="-1" aria-labelledby="issueModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="issueModalLabel">Report an Issue</h5>
                    <input type="hidden" class="form-control" id="input-transID" required>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="clientIssue" class="form-label">Issue</label>
                        <input type="text" class="form-control" id="clientIssue" placeholder="Enter the issue" required>
                    </div>
                    <div class="mb-3">
                        <label for="problemDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="problemDescription" rows="3"
                            placeholder="Describe the problem" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="uploadImages" class="form-label">Upload Images (Max: 2)</label>
                        <input type="file" class="form-control" id="uploadImages" accept="image/*" multiple>
                        <small class="text-muted">You can upload up to 2 images.</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="submitIssue">Submit</button>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    document.getElementById('uploadImages').addEventListener('change', function () {
        if (this.files.length > 2) {
            alert('You can only upload a maximum of 2 images.');
            this.value = ''; // Clear the input
        }
    });

    document.getElementById('submitIssue').addEventListener('click', function () {
        const issueForm = document.getElementById('issueForm');
        if (issueForm.checkValidity()) {
            alert('Issue submitted successfully!');
            issueForm.reset();
            const modal = bootstrap.Modal.getInstance(document.getElementById('issueModal'));
            modal.hide();
        } else {
            issueForm.reportValidity();
        }
    });
</script>

<script>
    $(document).ready(function () {
        var userRole = "<?php echo $role; ?>";
        if (userRole !== 'Customer' && userRole !== '') {
            window.location.href = "../server/adminDashboard.php";
        }
        $.ajax({
            url: './includes/getOrders.php',
            type: 'GET',
            dataType: 'json',
            success: function (orders) {
                $('.item-action').empty();
                $.each(orders, function (index, order) {
                    var itemTitles = order.items.map(item => item.title).join(', ');
                    var itemSizes = order.items.map(item => item.size).join('<br>');
                    var totalQuantity = order.total_quantity;
                    var totalPrice = order.grandtotal;
                    if (order.status === 'Ready For Pickup' || order.status === 'Check Payment' || order.status === 'Out For Delivery') {
                        var orderItem = `
                            <div class="order-item">
                                <div class="item-details">
                                    <img src="../server/includes/uploads/${order.first_img}" alt="Product Image" style="width: 100px; height: auto;">
                                    <p>Transaction ID: ${order.transaction_id}</p>
                                    <p>Items: <br> ${itemTitles}</p>
                                    <p>Sizes: <br> ${itemSizes}</p>
                                    <p>Total Quantity: ${totalQuantity}</p>
                                </div>
                                <div class="item-status">
                                    <p class="status to-receive">${order.status}</p>
                                </div>
                                <div class="item-price">
                                    <p>Total Price: ₱${totalPrice}</p>
                                </div>
                                <div class="item-action">
                                </div>
                            </div>`;
                        $('#to-pay').append(orderItem);
                        var lastItemAction = $('#to-pay .order-item:last .item-action');
                        if (order.status === 'Ready For Pickup' || order.status === 'Out For Delivery' || order.status === 'For Replacement') {
                            lastItemAction.append(`<button class="btn-replace Replace" data-id="${order.transaction_id}" data-bs-toggle="modal" data-bs-target="#issueModal">Replace</button>`);
                            lastItemAction.append(`<button data-id="${order.transaction_id}" data-points=${order.points} class="confirm-receive-btn">Order Received</button>`);
                        } else if (order.status === 'Check Payment') {
                            lastItemAction.append('<p>Waiting for admin to confirm payment</p>');
                        }
                    }
                    $('.confirm-receive-btn').on('click', function () {
                        var transactionId = $(this).data('id');
                        var points = $(this).data('points');
                        $.ajax({
                            url: './includes/updateStatus.php',
                            type: 'POST',
                            data: {
                                transaction_id: transactionId,
                                type: 'complete',
                                points: parseInt(points)
                            },
                            success: function (response) {
                                var result = JSON.parse(response);
                                alert("Completed transaction. Thank you!");
                            },
                            error: function (xhr, status, error) {
                                console.error('Error updating status:', error);
                                alert('An error occurred while updating the status.');
                            }
                        });
                    });
                });
            },
            error: function (xhr, status, error) {
                console.error('Error fetching orders:', error);
            }
        });
        $(document).on('click', '.btn-replace', function () {
            var transactionId = $(this).data('id');
            $('#input-transID').val(transactionId);
        });
        $(document).on('click', '#submitIssue', function (e) {
            e.preventDefault(); 
            const formData = new FormData();
            formData.append('transaction_id', $('#input-transID').val());
            formData.append('issue', $('#clientIssue').val());
            formData.append('description', $('#problemDescription').val());
            formData.append('type', 'replace');
            const files = $('#uploadImages')[0].files;
            for (let i = 0; i < files.length; i++) {
                formData.append('uploadImages[]', files[i]);
            }
            $.ajax({
                url: './includes/updateStatus.php',
                type: 'POST',
                data: formData,
                processData: false, 
                contentType: false, 
                success: function (response) {
                    const result = JSON.parse(response);
                    if (result.status === 'success') {
                        alert(result.message);
                        location.reload();
                    } else {
                        alert('Error: ' + result.message);
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error:', error);
                    alert('An error occurred.');
                }
            });
        });

    });
</script>
</body>

</html>
<style>
    body {
        background-color: #f0f0f5;
    }

    .container p {
        color: black;
    }

    .container p:hover {
        cursor: default;
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

    /* Order Section */


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
        display: flex;
        flex-direction: row;
        width: 100px;
        text-align: center;
        margin-top: 10px;
        /* Add spacing for smaller screens */
    }

    .status.to-receive {
        color: #0066cc;
        font-weight: bold;
    }

    .confirm-receive-btn,
    .Replace {
        margin-bottom: 10px;
        background-color: #0066cc;
        color: white;
        padding: 8px 16px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        width: 100%;
        /* Ensure the button spans full width on smaller screens */
    }

    .confirm-receive-btn:hover {
        background-color: #004c99;
    }

    .Replace:hover {
        background-color: #004c99;
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
</style>
<?php
include '../test/newFooter.php';
?>