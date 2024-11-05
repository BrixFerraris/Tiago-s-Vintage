<?php
include 'header.php';
?>

<div class="containers">
    <div class="collections">
        <h2>Collection</h2>
    </div>
    <div class="wrapper-categories" id="categories-wrapper">
    <!-- Categories will be populated here -->

    <div class="wrapper-categories">
        
        <div class="parent-category">
            <a href="../client/productList.php">
            <div class="details">
            <h2>All Items</h2>
            <p>View Product</p>
            </div>
            <div class="child bg-category">
            </div>
            </a>
        </div>

        <div class="parent-category">
        <a href="../client/productList.php">
        <div class="details">
            <h2>T-shirts</h2>
            <p>View Product</p>
            </div>
            <div class="child bg2-category">

            </div>
            </a>
        </div>

        <div class="parent-category">
        <div class="details">
            <h2>Pants</h2>
            <p>View Product</p>
            </div>
            <div class="child bg3-category">
            </div>
        </div>


    
</div>
</div>

</body>
<style>

    .parent-category:hover .child{
        transform: scale(1.2);
    }
    .parent-category{
        margin-bottom: 20px;
        margin-left: 25px;
        height: 300px;
        width: 500px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.5);
        cursor: pointer;
        border-radius: 5px;
        overflow: hidden;
        position: relative;
    }
    .child{
        height: 100%;
        width: 100%;
        background-size: cover;
        background-position: center;
        transition: all 4s;
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 1;
    }

    .bg-category{

    }
    .bg2-category{
        background-image: url('../images/t-shirtbg.jpg');
    }
    .bg3-category{
        background-image: url('../images/bg2.png');
    }

    .wrapper-categories{
        margin-top: 30px;
        min-height: 700px;
        display: flex;
        justify-content: center;
        flex-wrap: wrap;

    }

    /* Center the text inside the parent */
    .details{
        position: absolute;
        top: 40%;    /* Align vertically to the center */
        left: 40%;
        z-index: 2; /* Ensure text stays above the background image */
        color:white;
        font-family: 'Koulen', sans-serif;
        font-size: 25px;
        text-align: center;
        pointer-events: none;
    }

    .parent-category h2 {
        margin: 0;
        font-size: 24px;
    }

    .parent-category p {
        margin: 5px 0 0 0;
        font-size: 18px;
    }
    .collections {
    font-family: 'Koulen', sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 50px;
    }
</style>
<script>
    $(document).ready(function() {
    function fetchCategories() {
        $.ajax({
            url: '../server/includes/getCategories.php',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                $('#categories-wrapper').empty(); 
                if (Array.isArray(data) && data.length > 0) {
                    $.each(data, function(index, category) {
                        $('#categories-wrapper').append(`
                            <div class="parent-category">
                                <a href="../client/productList.php?category=${category.category}">
                                    <div class="details">
                                        <h2>${category.category}</h2>
                                        <p>View Product</p>
                                    </div>
                                    <div class="child bg-category">
                                        <img src="../server/includes/uploads/${category.image}" alt="${category.category}" width="510px" height="480px">
                                    </div>
                                </a>
                            </div>
                        `);
                    });
                } else {
                    $('#categories-wrapper').append('<p>No categories found.</p>');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("Error fetching categories: ", textStatus, errorThrown);
                $('#categories-wrapper').append('<p>Error loading categories.</p>');
            }
        });
    }

    fetchCategories(); 
});

</script>
<?php
include 'footer.php';
?>