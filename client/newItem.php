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

                                <div class="buttons">
                                    <button>35 X 40 (Large)</button>
                                    <button>35 X 40 (Large)</button>
                                    <button>35 X 40 (Large)</button>
                                    <button>35 X 40 (Large)</button>
                                    <button>35 X 40 (Large)</button>
                                    <button>35 X 40 (Large)</button>
                                </div>
                            </div>
                                    <div class="incdec">
                                      <form action="./includes/addToCart.php" method="post">
                                      <input type="hidden" name="id" id="product_id">
                                        <p>Quantity</p>
                                        <input type="number" id="quantity" min="1" name="quantity" step="1"> 
                                    </div>
                                <div class="description">
                                    <p>Condition:</p>
                                    <p id="description" ></p>
                                </div>
                                <div class="btncart">
                                    <button id="btn-addCart" name="add">Add To Cart</button>
                                </div>
                                      </form>
                        </div>
                    </div>


                <div class="recomendation">
                    <p>
                        POPULAR
                    </p>
                    <div class="img-rec">
                        <img src="../assets/sampletpic2.png" alt="">
                        <img src="../assets/samplepic3.png" alt="">
                        <img src="../assets/samplepic4.png" alt="">
                        <img src="../assets/samplepic5.png" alt="">
                    </div>

                </div>
<script>
    document.addEventListener('DOMContentLoaded', function(){
      // WebSocket connection
      var conn = new WebSocket('ws://localhost:8080');
      const url = new URL(window.location.href);
      const productID = url.searchParams.get('productID');
      var prodID =productID;
      var hidden = document.getElementById('product_id');
      hidden.value = productID;
      console.log(productID);
      conn.onopen = function() {
          conn.send(JSON.stringify({ type: 'loadSingleProduct', id: productID}));
      };
      
      conn.onmessage = function(e) {
        var product = JSON.parse(e.data);
        console.log(product);
        var title =document.getElementById('title');
        var price = document.getElementById('price');
        var description = document.getElementById('description');
        var img1 = document.getElementById('img1');
        var img2 = document.getElementById('img2');
        var img3 = document.getElementById('img3');
        var img4 = document.getElementById('img4');
        if (product.type === 'edit-product') {
          title.innerText = product.title;
          price.innerText = '₱' + product.price;
          description.innerText = product.description;
          img1.src = '../server/includes/uploads/' + product.img1;
          img2.src = '../server/includes/uploads/' + product.img2;
          img3.src = '../server/includes/uploads/' + product.img3;
          img4.src = '../server/includes/uploads/' + product.img4;
        }
      };
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
  flex: 1;
  max-width: 700px;
  margin-right: 50px;
  margin-top: 40px;
}

.details h1 {
  font-family: "Inter", sans-serif;
  font-size: 22px;
  color: black;
  font-weight: bold;
}

.details p {
  font-family: "Inter", sans-serif;
  font-size: 20px;
  color: black;
  font-weight: normal;
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
  margin-top: 20px;
  font-size: medium;
  color: grey;
}

.buttons button {
  font-family: "Karla", sans-serif;
  padding: 10px;
  background-color: '#ffffff';
  color: rgb(46, 102, 0);
  border: solid;
  cursor: pointer;
  font-weight: bold;
  border-width: thin;
}

.incdec {
  margin-top: 20px;
}

.incdec p {
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


    </style>
<?php
include 'footer.php';
?>