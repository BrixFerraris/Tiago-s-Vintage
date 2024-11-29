<?php
include './header.php';
$role = isset($_SESSION['role']) ? $_SESSION['role'] : '';

?>
<!-- Main Content -->
<div class="container">
    <!-- Order Tabs -->
    <div class="tabs">
        <button class="tab-button" onclick="window.location.href='toPay.php'">To Pay</button>
        <button class="tab-button" onclick="window.location.href='toReceived.php'">To Receive</button>
        <button class="tab-button" onclick="window.location.href='completed.php'">Completed</button>
        <button class="tab-button active" onclick="window.location.href='cancelled.php'">Cancelled</button>
    </div>

    <!-- Cancelled Orders Section -->
    <div class="order-section" id="cancelled">
        <h4>My Orders - Cancelled</h4>

        <!-- Add more cancelled order items here as needed -->

        <div id="order-list">
            <!-- Order items will be dynamically inserted here -->
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        var userRole = "<?php echo $role; ?>";
        if (userRole !== 'Customer' && userRole !== '') {
            window.location.href = "../server/adminDashboard.php";
        }
        $.ajax({
            url: './includes/getOrders.php',
            type: 'GET',
            success: function (orders) {
                console.log(orders);
                $('#order-list').empty();
                if (orders.length === 0) {
                    $('#order-list').append('<h1>No Orders Yet</h1>');
                    return;
                }
                var cancelledOrders = orders.filter(order => order.status === 'Cancelled');

                if (cancelledOrders.length === 0) {
                    $('#order-list').append('<h1>No Cancelled Orders</h1>');
                    return;
                }

                $.each(cancelledOrders, function (index, order) {
                    var itemTitles = order.items.map(item => item.title).join(', ');
                    var itemSizes = order.items.map(item => item.size).join('<br>');
                    var totalQuantity = order.total_quantity;
                    var totalPrice = order.total_price;

                    var orderItem = `
            <div class="order-item">
                <div class="item-details">
                    <img src="../server/includes/uploads/${order.first_img}" alt="Product Image" style="width: 100px; height: auto;">
                    <div>
                        <h5>${itemTitles}</h5>
                        <p>Size: <br> ${itemSizes}</p>
                        <p>Quantity: ${totalQuantity}</p>
                        <p>Total Items: ${totalQuantity}</p>
                    </div>
                </div>
                <div class="item-status">
                    <p class="status ${order.status.toLowerCase()}">${order.status}</p>
                </div>
                <div class="item-price">
                    <p>₱${totalPrice.toFixed(2)}</p>
                </div>
            </div>`;
                    $('#order-list').append(orderItem);
                });
            },
            error: function (xhr, status, error) {
                console.error('Error fetching orders:', error);
                alert('Failed to load orders. Please try again later.');
            }
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
        background-color: #f44336;
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
        /* Enable horizontal scrolling */
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
        /* Flex item that adjusts on smaller screens */
        min-width: 200px;
        /* Ensure minimum space for smaller screens */
    }

    .item-details img {
        width: 80px;
        height: 80px;
        margin-right: 15px;
    }


    .item-status {
        width: 100px;
        text-align: center;
    }

    .item-price {
        width: 100px;
        text-align: center;
    }

    /* Cancelled status */
    .status.cancelled {
        color: red;
        font-weight: bold;
    }


    .item-details p {
        font-size: small;
    }

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