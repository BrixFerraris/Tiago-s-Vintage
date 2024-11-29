<?php
session_start();
$role = isset($_SESSION['role']) ? $_SESSION['role'] : '';

?>

<head>
    <link rel="stylesheet" href="../CSS/checkout.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>


    <div class="checkout-wrapper">
        <div class="checkout-container">
            <input type="hidden" name="user_id" id="user_id" value="<?php echo $_SESSION['uID']; ?>">
            <!-- Order Summary -->
            <div class="order-summary">
                <h2>Order Summary</h2>
                <ul>
                    <li></li>
                </ul>
                <h4 id="points_available">Points Available: 10000</h4>
                <div id="discount-method" class="radio-group">

                </div>
                <p><strong>Total: ₱</strong></p>
            </div>

            <!-- Shipping Info -->
            <div class="shipping-info">
                <h2>Shipping Information</h2>
                <label for="name">Full Name</label>
                <p id="name"></p>

                <label for="address">Shipping Address</label>
                <input type="text" id="address" name="address" placeholder="Enter your shipping address" required>

                <label for="contact">Contact Number</label>
                <p id="contact"></p>

                <!-- Radio buttons for Pick Up or Delivery -->
                <label for="shipping-method">Shipping Method</label>
                <div id="shipping-method" class="radio-group">
                    <input type="radio" id="pickup" name="shipping-method" value="pickup" required>
                    <label for="pickup" class="radio-label">Pick Up</label>

                    <input type="radio" id="delivery" name="shipping-method" value="delivery" required>
                    <label for="delivery" class="radio-label">Delivery</label>
                </div>


                <!-- Action Buttons -->
                <div class="action-buttons">
                    <button type="submit" id="place-order" class="place-order">Place Order</button>
                    <button type="button" class="cancel-order"
                        onclick="window.location.href='shopcart.php';">Cancel</button>
                </div>

            </div>
        </div>
    </div>
</body>
<script>
    $(document).ready(function () {
        var userRole = "<?php echo $role; ?>";
        if (userRole !== 'Customer' && userRole !== '') {
            window.location.href = "../server/adminDashboard.php";
        }
        let varID = [];
        let qty = [];
        let currentTotal = 0;

        const userID = new URL(window.location.href).searchParams.get('userID');
        const uID = $('#user_id').val();
        if (userID !== uID) {
            window.location.href = `./checkout.php?uID=${uID}`;
        }

        $.ajax({
            url: '../serverFunctions.php',
            type: 'POST',
            data: { type: 'loadCart', user_id: userID },
            success: function (response) {
                try {
                    const orderSummary = JSON.parse(response);
                    let itemList = '';
                    let total = 0;

                    orderSummary.forEach(function (item) {
                        itemList += `
                        <li>
                            <img width="80px" height="80px" src="../server/includes/uploads/${item.img1}" alt="">
                            ${item.title} - ₱${item.price} <br> x${item.quantity}                
                        </li>`;
                        total += item.total;
                        $('#name').text(`${item.firstName} ${item.lastName}`);
                        $('#contact').text(item.contact);
                        $('#points_available').text("Orders Completed: " + item.completedTransactions);
                        var points = item.completedTransactions;
                        if (points >= 10) {
                            $("#discount-method").empty();
                            var html = `
                                        <input type="radio" id="freebie" name="discount-method" value="freebie" required>
                                        <label for="freebie" class="radio-label">Random Freebie</label>

                                        <input type="radio" id="discount" name="discount-method" value="discount">
                                        <label for="discount" class="radio-label">10% Discount</labe>
                                    `;
                            $("#discount-method").append(html);
                        } else {
                            $("#discount-method").empty();
                            var html = `
                                    <h5>Points should be 10 or higher, shop more with us to earn more points </h5>
                                        <input type="radio" id="freebie" name="discount-method" value="freebie" disabled required>
                                        <label for="freebie" disabled class="radio-label">Random Freebie</label>

                                        <input type="radio" id="discount" name="discount-method" disabled value="discount">
                                        <label for="discount" disabled class="radio-label">10% Discount</labe>
                                    `;
                            $("#discount-method").append(html);
                        }
                        varID.push(item.variationId);
                        qty.push(item.quantity);
                    });

                    $('.order-summary ul').html(itemList);
                    $('.order-summary strong').text(`Total: ₱${total}`);

                    $('input[name="discount-method"]').on('change', function () {
                        currentTotal = total;
                        if ($('#discount').is(':checked')) {
                            currentTotal -= total * 0.1;
                            console.log("haha");
                            $('.order-summary strong').text(`Total: ₱${currentTotal}`);
                        }
                        $('.order-summary strong').text(`Total: ₱${currentTotal}`);
                    });
                    currentTotal = total;
                } catch (error) {
                    console.error('Error parsing JSON:', error);
                }
            },
            error: function (xhr, status, error) {
                console.error('Error loading cart:', error);
            }
        });

        $(document).on('click', '.place-order', function () {
            const address = $('#address').val();
            const shippingMethod = $("input[name='shipping-method']:checked").val();

            if (!shippingMethod) {
                alert('Please select a shipping method.');
                return; 
            }

            if (shippingMethod === 'delivery' && !address.trim()) {
                alert('Please enter a shipping address for pick up.');
                return; 
            }

            const varIDArray = Array.isArray(varID) ? varID : [varID];
            const discountMethod = $("input[name='discount-method']:checked").val();

            $.ajax({
                url: '../serverFunctions.php',
                type: 'POST',
                data: {
                    type: 'order',
                    user_id: userID,
                    address: address,
                    variationID: varIDArray,
                    qty: qty,
                    shipMethod: shippingMethod,
                    discount_method: discountMethod,
                    grandTotal: currentTotal,
                    status: 'Pending'
                },
                success: function (response) {
                    const data = JSON.parse(response);
                    if (data.type === 'orderPlaced') {
                        alert('Order placed successfully!');
                        window.location.href = './toPay.php';
                    } else {
                        alert('Error placing the order.');
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error placing order:', error);
                }
            });
        });
    });
</script>