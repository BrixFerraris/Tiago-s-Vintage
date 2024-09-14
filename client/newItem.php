<?php
include 'header.php';
?>
<div class="img-item">
        <div class="img-container">
            <div class="main-img">
                <img src="../assets/samplepic1.png" alt="" width="582" height="450">
                </div>
                <div class="sub-img">
                        <img src="../assets/samplepic1.png" alt="" width="150" height="200">
                        <img src="../assets/samplepic1.png" alt="" width="150" height="200">
                        <img src="../assets/samplepic1.png" alt="" width="150" height="200">
                </div>
         </div>
                <div class="details">
                            <h1>Vintage Carhartt Double Knee Suspender Buttons(B01 BLK)
                            </h1>
                            <p>
                                ₱1500
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
                                        <p>Quantity</p>
                                        <input type="number" name="points" step="1"> 
                                    </div>
                                <div class="description">
                                    <p>Condition:</p>
                                    <p>This is the best condition you'll see of the product</p>
                                </div>
                                <div class="btncart">
                                    <button>Add To Cart</button>
                                </div>
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