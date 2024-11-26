<?php
include 'header.php';
$isLoggedIn = false;
if (isset($_SESSION["uID"])) {
    $isLoggedIn = true;
}
?>


<div class="cart-container">
    <div class="cart-text">
        <h2>Your Shopping Cart</h2>
        <input type="hidden" name="user_id" id="user_id" value="<?php echo $_SESSION["uID"]; ?>">
    </div>

    <!-- Cart Items -->
    <div class="cart-items">
        <!-- First Item -->
        <div class="cart-purchase">
            <div class="cart-image">
                <img src="../assets/tshirt4.png" alt="T-shirt image">
            </div>
            <div class="item-info">
                <h2 id="infoo">Davey Allison 28 Big Print</h2>
                <p id="infoo" id="infoo">25W X 35L (Large)</p>
                <p id="infoo">₱1500</p>

            </div>
        </div>

    </div>
    <div class="item-total">
        <p id="infoo">Subtotal:</p>
        <!-- <button class="btnCancel">CONTINUE SHOPPING</button> -->
    </div>

</div>
<?php
include '../test/newFooter.php';
?>
<script>
    $(document).ready(function () {
        const userId = $('#user_id').val();
        function fetchCart() {
            $.ajax({
                url: '../serverFunctions.php',
                type: 'POST',
                data: { type: 'loadCart', user_id: userId },
                success: function (response) {
                    const cart = JSON.parse(response);
                    const cartItemsContainer = $('.cart-items');
                    cartItemsContainer.html('');
                    let subtotal = 0;
                    cart.forEach(item => {
                        const cartItemHtml = `
                        <div class="cart-purchase">
                            <div class="cart-image">
                                <img src="../server/includes/uploads/${item.img1}" alt="${item.title} image">
                            </div>
                            <div class="item-info">
                                <h2 id="infoo">${item.title}</h2>
                                <p id="infoo">${item.variationName}</p>
                                <p id="infoo">₱${item.price}</p>
                            </div>
                            <div class="item-quantity">
                                <div class="incdec">
                                    <button class="btnMinus" data-id="${item.transactionId}" data-max="${item.variantQuantity}">-</button>
                                    <input type="text" class="qnty" id="quantity_${item.transactionId}" value="${item.quantity}" readonly>
                                    <button class="btnPlus" data-id="${item.transactionId}" data-max="${item.variantQuantity}">+</button>
                                    <div class="btnremove">
                                        <button class="btnRemove" data-id="${item.transactionId}">Remove</button>
                                    </div>
                                </div>
                            </div>
                        </div>`;
                        cartItemsContainer.append(cartItemHtml);
                        subtotal += item.price * item.quantity;
                    });

                    const subtotalHtml = `
                    <p id="subtotal">Subtotal: ₱${subtotal}</p>
                    <button class="btnCheckout">CHECKOUT</button>`;
                    $('.item-total').html(subtotalHtml);
                },
                error: function (xhr, status, error) {
                    console.error('Error loading cart:', error);
                }
            });
        }

        // Remove Item
        $(document).on('click', '.btnRemove', function () {
            const transactionID = $(this).data('id');
            $.ajax({
                url: '../serverFunctions.php',
                type: 'POST',
                data: { type: 'removeCart', transactionID },
                success: function (response) {
                    const data = JSON.parse(response);
                    if (data.type === 'itemRemoved') {
                        alert('Item removed successfully.');
                        fetchCart();
                    } else {
                        alert('Error removing item.');
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error removing item:', error);
                }
            });
        });

        // Update Quantity
        $(document).on('click', '.btnPlus, .btnMinus', function () {
            const transactionID = $(this).data('id');
            const maxQty = $(this).data('max');
            const quantityInput = $(`#quantity_${transactionID}`);
            let currentValue = parseInt(quantityInput.val(), 10);

            if ($(this).hasClass('btnPlus') && currentValue < maxQty) {
                currentValue++;
            } else if ($(this).hasClass('btnMinus') && currentValue > 1) {
                currentValue--;
            } else {
                return;
            }

            quantityInput.val(currentValue);

            $.ajax({
                url: '../serverFunctions.php',
                type: 'POST',
                data: { type: 'updateQuantity', transactionID, quantity: currentValue },
                success: function (response) {
                    const data = JSON.parse(response);
                    if (data.type === 'quantityUpdated') {
                        fetchCart();
                    } else {
                        alert('Error updating quantity.');
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error updating quantity:', error);
                }
            });
        });
        $(document).on('click', '.btnCheckout', function () {
            window.location.href = `checkout.php?userID=${userId}`;
        });
        fetchCart();
    });

</script>
<style>

.cart-text {
        margin-top: 50px;
        text-align: center;
    }

    .cart-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
    }

    .cart-items {
        margin: 20px 0;
    }

    .cart-purchase {
        display: flex;
        align-items: center;
        padding: 20px 0;
        border-bottom: 1px solid #e0e0e0;
    }

    .cart-image img {
        width: 80px;
    }

    .item-info {
        flex: 2;
        padding-left: 20px;
    }

    .item-info #infoo {
        color: black;
        font-size: 18px;
        margin-bottom: 5px;
    }

    .item-quantity {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
    }

    .incdec {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }

    .incdec input {
        width: 40px;
        text-align: center;
        margin: 0 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .incdec button {
        background-color: #eaeaea;
        border: 1px solid #ccc;
        padding: 5px 10px;
        font-size: 16px;
        cursor: pointer;
    }

    .item-total {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .item-total p {
        color: black;
        font-size: 18px;
        font-weight: bold;
    }

    .btnCheckout,
    .btnCancel {
        padding: 10px 20px;
        background-color: green;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .btnCancel {
        background-color: #ccc;
    }

    .btnremove {
        margin-left: 20px;
    }

    /* Responsive Design */

   
    @media (max-width: 425px) {
        .cart-purchase {
            flex-direction: column;
            align-items: center;
        }

        .cart-image img {
            width: 200px;
        }

        .item-info #infoo {
            font-size: 20px;
        }

        .cart-text h2{
            font-size: 20px;
        }
        .incdec input {
            width: 30px;
            font-size: 12px;
        }

        .incdec button {
            font-size: 12px;
            padding: 4px 8px;
        }

        .btnCheckout,
        .btnCancel {
            font-size: 12px;
            padding: 6px 10px;
        }

        .item-total p {
            font-size: 14px;
        }
    }

</style>