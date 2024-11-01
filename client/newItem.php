<?php
include 'header.php';
?>
<div class="img-item">
        <div class="img-container">
            <div class="main-img">
                <img id="img1" src="../assets/samplepic1.png" alt="" width="582" height="450">
                </div>
                <div class="sub-img">
                        <img id="img2" src="../assets/samplepic1.png" alt="" width="150" height="200">
                        <img id="img3" src="../assets/samplepic1.png" alt="" width="150" height="200">
                        <img id="img4" src="" alt="" width="150" height="200">
                </div>
         </div>
                <div class="details">
                            <h1 id="title" >
                            </h1>
                            <p id="price" >
                            </p>

                            <div class="sizes">

                                <p>Size</p>

                                <div id="buttons" class="buttons">
                                    <button>35 X 40 (Large)</button>
                                    <button>35 X 40 (Large)</button>
                                    <button>35 X 40 (Large)</button>
                                    <button>35 X 40 (Large)</button>
                                    <button>35 X 40 (Large)</button>
                                    <button>35 X 40 (Large)</button>
                                </div>
                            </div>
                                    <div class="incdec">
                                      <form id="addToCart" action="./includes/addToCart.php" method="post">
                                      <input type="hidden" name="id" id="product_id" required>
                                      <input type="hidden" name="variationID" id="variationID" required>
                                      <p>Quantity</p>
                                        <input type="number" id="quantity" min="1" name="quantity" step="1" required> 
                                        <div class="ewan">
                                          <h3 id="quantity-message"></h3>
                                        </div>
                          </div>
                                <div class="description">
                                    <p>Condition:</p>
                                    <p id="description" ></p>
                                </div>
                                <div class="btncart">
                                    <button type="submit" id="btn-addCart" name="add">Add To Cart</button>
                                </div>
                                      </form>
                        </div>
                    </div>

                    <div id="myModal" class="modal">
                    <span class="close">&times;</span>
                    <img class="modal-content" id="img01">
                    <div id="caption"></div>
                  </div>
               

      
<script>
$(document).ready(function() {
    // WebSocket connection
    const conn = new WebSocket('ws://localhost:8080/ws/');
    const url = new URL(window.location.href);
    var productID = url.searchParams.get('productID');
    
    // Set product ID in hidden input
    $('#product_id').val(productID);

    // Load product details via WebSocket
    conn.onopen = function() {
        conn.send(JSON.stringify({ type: 'loadSingleProduct', id: productID }));
    };

    conn.onmessage = function(e) {
        const product = JSON.parse(e.data);
        if (product.type === 'edit-product') {
            $('#title').text(product.title);
            $('#price').text('₱' + product.price);
            $('#description').text(product.description);
            $('#img1').attr('src', '../server/includes/uploads/' + product.img1);
            $('#img2').attr('src', '../server/includes/uploads/' + product.img2);
            $('#img3').attr('src', '../server/includes/uploads/' + product.img3);
            $('#img4').attr('src', '../server/includes/uploads/' + product.img4);
        }
    };
    function loadVariations() {
        $.ajax({
            url: '../server/includes/getVariations.php',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ idProduct: productID }),
            success: function(product) {
              if (typeof product === "string") {
                  product = JSON.parse(product); 
              }
              console.log(product);
              
                if (product.type === 'variations') {
                    const buttonDiv = $('#buttons');
                    buttonDiv.empty();

                    $.each(product.variations, function(index, variation) {
                        const newDiv = $('<div>').addClass('edit-product-variation');
                        newDiv.html(`
                            <button class="variation" data-id="${variation.id}" data-quantity="${variation.quantity}">
                                ${variation.width} X ${variation.length} (${variation.variationName})
                            </button>
                        `);
                        buttonDiv.append(newDiv);
                    });

                    buttonDiv.on('click', '.variation', function() {
                        const variationID = $(this).data('id');
                        const variationQuantity = $(this).data('quantity');
                        $('#variationID').val(variationID);
                        $('#quantity').attr('max', variationQuantity);
                        $('#quantity-message').text(`Stocks Left: ${variationQuantity}`);
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error('Error loading variations:', error);
            }
        });
    }
    loadVariations();



    // Form validation
    function validateForm() {
        const productId = $('#product_id').val();
        const variationId = $('#variationID').val();
        const quantity = $('#quantity').val();
        const errors = [];

        if (!productId) {
            errors.push('Please select a product!');
        }

        if (!variationId) {
            errors.push('Please select a variation!');
        }

        if (!quantity || quantity < 1) {
            errors.push('Please enter a valid quantity!');
        }

        if (errors.length > 0) {
            alert(errors.join('\n'));
            return false;
        }

        return true;
    }

    $('#addToCart').on('submit', function(e) {
        if (!validateForm()) {
            e.preventDefault();
        }
    });

    const modal = $('#myModal');
    const img = $('#img1');
    const modalImg = $('#img01');
    const span = $('.close');

    img.on('click', function() {
        modal.show();
        modalImg.attr('src', this.src);
    });

    span.on('click', function() {
        modal.hide();
    });

    $(window).on('click', function(event) {
        if (event.target === modal[0]) {
            modal.hide();
        }
    });
});
</script>

    <style>
*{
  padding: 0;
  margin: 0;
  text-decoration: none;
  list-style: none;
  box-sizing: border-box;
}
body {
background-color: white;
margin-top: 0;
margin: 0;
overflow-x: hidden; /* added */
}

.img-container {
  flex: 1;
}

.img-item {
  margin-bottom: 100px;
  display: flex;
  gap: 20px;
  margin-top: 30px;
  margin-left: 150px;
}


.main-img img {

  width: 350px;
  margin-left: 40px;
  display: flex;
}

.sub-img {

  flex-direction: column;
  gap: 20px;
}

.sub-img img {
  object-fit: cover;
  position: flex;
}

/* Product details styles */
.details {
  background-color: rgba(240, 240, 240);
  border-radius: 20px;
  box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.5);
  border: solid rgba(240, 240, 240);
  padding: 30px;
  flex: 1;
  max-width: 700px;
  margin-right: 50px;
  margin-top: 10px;
}

.details h1 {
  font-family: "Inter", sans-serif;
  font-size: 22px;
  color: black;
  font-weight: bold;
}

.details p {
  cursor: default;
  font-family: "Inter", sans-serif;
  font-size: 20px;
  color: black;
  font-weight: normal;
  margin-left: -0.5px;
}

.sizes{
    max-width: 400px;
}
.sizes.buttons {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 20px;
  margin-top: 5%;
}
.sizes p{
  cursor: default;
  margin-top: 20px;
  font-size: medium;
  color: grey;
}
.buttons button:focus{
  background-color: darkgreen;
  color: white;
}

.buttons button {
  margin-top: 5px;
  font-family: "Karla", sans-serif;
  padding: 5px;
  background-color: '#ffffff';
  color: rgb(46, 102, 0);
  border: solid;
  cursor: pointer;
  font-weight: bold;
  border-width: thin;
  height: 50px;
  width: 180px;
}

.incdec {
  margin-top: 20px;
}

.incdec p {
  cursor: default;
  margin-bottom: 10px;
  font-family: "Inter", sans-serif;
  font-size: medium;
  color: grey;
}

.incdec input {
  width: 60px;
  padding: 5px;
}

.description {
  margin-top: 10px;
}

.description p{
  font-family: "Inter", sans-serif;
  font-size: medium;
  color: grey;
  cursor: default;
}

.btncart{
  margin-top: 150px;

}
.btncart button {
  font-family: "kart", sans-serif;
  margin-top: 20px;
  padding: 15px 260px;
  background-color: rgb(46, 102, 0);;
  color: white;
  border: none;
  cursor: pointer;
  font-size: 16px;
  font-weight: bold;
}

.recomendation p {
  margin-top: 100px;
  font-family: "Karla", sans-serif; 
  font-size: 50px; 
  font-weight: bold; 
  color: rgb(46, 102, 0); 
  margin-left: 130px; 
} 
.recomendation img { 
  width: 400px;
  margin-left: 300px;
} 
.recomendation .img-rec {
  align-items: center;
  display: grid; 
  grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); 
  justify-items: center; 
  gap: 145px; 
}


#img1{
  cursor: pointer;
}
/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (image) */
.modal-content {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 500px;
}

/* Caption of Modal Image */


/* Add Animation */
.modal-content, #caption {  
  -webkit-animation-name: zoom;
  -webkit-animation-duration: 0.6s;
  animation-name: zoom;
  animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
  from {-webkit-transform:scale(0)} 
  to {-webkit-transform:scale(1)}
}

@keyframes zoom {
  from {transform:scale(0)} 
  to {transform:scale(1)}
}

/* The Close Button */
.close {
  position: absolute;
  top: 15px;
  right: 35px;
  color: #f1f1f1;
  font-size: 40px;
  font-weight: bold;
  transition: 0.3s;
}

.close:hover,
.close:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
  .modal-content {
    width: 100%;
  }
}


    </style>
<?php
include 'footer.php';
?>