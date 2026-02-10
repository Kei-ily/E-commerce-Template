<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <link rel="icon" href="HompageImg/logoImg.png">
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="carousel.css" rel="stylesheet" />
    <link href="custom.css" rel="stylesheet">
</head>
<body>

<?php include 'includes/header.php' ?>
    
    <section>
<div id="myCarousel" class="carousel slide mb-6" data-bs-ride="carousel">
        <div class="carousel-indicators">
          <button
            type="button"
            data-bs-target="#myCarousel"
            data-bs-slide-to="0"
            class="active"
            aria-current="true"
            aria-label="Slide 1"
          ></button>
          <button
            type="button"
            data-bs-target="#myCarousel"
            data-bs-slide-to="1"
            aria-label="Slide 2"
          ></button>
          <button
            type="button"
            data-bs-target="#myCarousel"
            data-bs-slide-to="2"
            aria-label="Slide 3"
          ></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
             
            <img src="HompageImg/IMG_20250626_224704.jpg" alt="slide 1"  height="100%"   width="100%">
              <rect
                width="100%"
                height="100%"
                fill="var(--bs-secondary-color)"
              ></rect>
         
            

            <div class="container">
              <div class="carousel-caption text-start">
                <!--
                <h1>Example headline.</h1>
                <p class="opacity-75">
                  Some representative placeholder content for the first slide of
                  the carousel.
                </p>
                <p>
                  <a class="btn btn-lg btn-primary" href="#">Sign up today</a>
                </p>
-->
              </div>
            </div>
          </div>
          <div class="carousel-item">

             <img src="HompageImg/finalbg.jpg" alt="slide 2"  
             height="100%"   width="100%">
              <rect
                width="100%"
                height="100%"
                fill="var(--bs-secondary-color)"
              ></rect>
          
            

            <div class="container">
              <div class="carousel-caption">
                 <!--
                <h1>Another example headline.</h1>
                <p>
                  Some representative placeholder content for the second slide
                  of the carousel.
                </p>
                <p><a class="btn btn-lg btn-primary" href="#">Learn more</a></p>
                -->
              </div>
            </div>
          </div>
          <div class="carousel-item">

             <img src="HompageImg/IMG_20250626_224740.jpg" alt="slide 3" 
              height="100%"
              width="100%"
            >
              <rect
                width="100%"
                height="100%"
                fill="var(--bs-secondary-color)"
              ></rect>
       

            <div class="container">
              <div class="carousel-caption text-end">
                 <!--
                <h1>One more for good measure.</h1>
                <p>
                  Some representative placeholder content for the third slide of
                  this carousel.
                </p>
                <p>
                  <a class="btn btn-lg btn-primary" href="#">Browse gallery</a>
                </p>
                 -->
              </div>
            </div>
          </div>
        </div>
        <button
          class="carousel-control-prev"
          type="button"
          data-bs-target="#myCarousel"
          data-bs-slide="prev"
        >
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button
          class="carousel-control-next"
          type="button"
          data-bs-target="#myCarousel"
          data-bs-slide="next"
        >
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
      </section>
      
       <section class="section-bg products-sec">
      <div class="section-header">
        <h2>Product Section</h2>
        <p>See all Products</p>
      </div>

      <?php 
        include 'db.php';
        $sql = "SELECT * FROM products";
        $result = $conn->query(query: $sql);
      ?>

      <div class="product-grid">
        <?php if($result->num_rows > 0){
          while($product =$result->fetch_assoc()){
        ?>

        <div class="product-card" 
          data-id="<?php echo $product['product_id'];?>"
          data-name="<?php echo $product['product_name'];?>"
          data-price="<?php echo number_format(num: $product['price'], decimals: 2 );?>"
          data-stocks="<?php echo $product['stocks'];?>"
          onclick="window.location.href='productSection.php'"
          style="cursor: pointer;">
          
          <div class="product-img-holder">
            <img src="showimage.php?id=<?php echo $product['product_id'];?>" alt="Product Image">
          </div>
          
          <div class="product-info-container">
            <div class="product-name-wrapper">
              <h3 class="product-name">
                <?php echo $product['product_name'];?>
              </h3>
            </div>
            
            <div class="product-price-section">
              <span class="price-label">Price</span>
              <span class="price-value">₱<?php echo number_format(num: $product['price'], decimals: 2 );?></span>
            </div>

            <div class="product-stock-section">
              <span class="stock-label">Available Stock</span>
              <span class="stock-value stock-<?php echo ($product['stocks'] > 5) ? 'high' : (($product['stocks'] > 0) ? 'low' : 'none'); ?>">
                <?php echo ($product['stocks'] > 0) ? $product['stocks'] . ' stocks' : 'Out of Stock'; ?>
              </span>
            </div>

            <div class="button-group">
               <button class="btn-primary" onclick="window.location.href='productSection.php'">
              Buy Now
            </button>
              <button class="btn-secondary" onclick="addToCart(<?php echo $product['product_id'];?>);">
                Add to Cart
              </button>
            </div>
          </div>
        </div>

        <?php
          }
        }else{
          echo "<p>NO products available.</p>";
        }
        $conn->close();
        ?>
      </div>
    </section>


    <!-- <div class="modal-backdrop" id="modalBackdrop"></div>


    <div class="button-group">
          <button class="buy-now" onclick="window.location.href='productSection.php'">
              Buy Now
            </button>
       
            <button class="buy-now" onclick="openProductModal(this.closest('.product-card'));">
              Buy Now
            </button> 

            <button class="add-cart" onclick="addToCart(<?php echo $product['product_id'];?>); ">
              Add to Cart
            </button>
          </div>
 
  <div class="modal-product" id="productModal">
    <div class="modal-content">
      <button class="modal-close-btn" onclick="closeProductModal()">
        ✕
      </button>

      <div class="modal-body">
        <div class="modal-img-section">
          <img id="modalProductImage" alt="Product Image" src="/placeholder.svg">
        </div>

        <div class="modal-info-section">
          <h2 id="modalProductName"></h2>
          
          <div class="modal-price-stocks">
            <p><strong>Price: </strong><span id="modalProductPrice"></span></p>
            <p><strong>Available Stock: </strong><span id="modalProductStocks"></span></p>
          </div>

 <form action='product.php' method='post'>
        <div class="modal-form-group">
            <label for="quantityInput"><strong>Quantity:</strong></label>
            <input type="number" name="product_id" id="modalProductId" readonly hidden>
              <input type="number" id="quantityInput" value="1" min="1" max="50" name="total_order">
              <label for="quantityInput"><strong>Total Price:</strong></label>
              <input type="number" id="productTotalPrice"  name="total_price" readonly>
          </div>

          <div class="modal-action-buttons">
            <input type="submit" class="btn-buy" value="Purchase" href="productSection.php">
          </div>
        </div>
</form>
      </div>
    </div>
  </div> -->

  
 <?php include 'includes/footer.php' ?>
  

     <script
      src="../assets/dist/js/bootstrap.bundle.min.js"
      class="astro-vvvwv3sm"
    ></script>

    <script>
    
    // Store product data
    let currentProduct = {
      id: null,
      name: null,
      price: null,
      stocks: null
    };

   
    function openProductModal(cardElement) {
      currentProduct = {
        id: cardElement.dataset.id,
        name: cardElement.dataset.name,
        price: cardElement.dataset.price,
        stocks: cardElement.dataset.stocks
      };

      //  modal print lang product data
     document.getElementById('modalProductId').value = currentProduct.id;
      document.getElementById('modalProductImage').src = 'showimage.php?id=' + currentProduct.id;
      document.getElementById('modalProductName').textContent = currentProduct.name;
      document.getElementById('modalProductPrice').textContent = '₱' + currentProduct.price;
      document.getElementById('modalProductStocks').textContent = currentProduct.stocks;


      // Reset Basta
      document.getElementById('quantityInput').value = 1;
      document.getElementById('quantityInput').max = currentProduct.stocks;
      document.getElementById('productTotalPrice').value =  currentProduct.price;
      //total
     

      document.getElementById('quantityInput').oninput = function(){
        let quantity = document.getElementById('quantityInput').value;
        let total = currentProduct.price * quantity;
        document.getElementById("productTotalPrice").value = total.toFixed(2);
      }

      
      document.getElementById('productModal').classList.add('open');
      document.getElementById('modalBackdrop').classList.add('open');
    
    }

    // TOTAL Purchase
    //function updateTotal(){
      // let quantity = document.getElementById('quantityInput').value;
      //let total = currentProduct.price * quantity;
      //document.getElementById("productTotalPrice").value = total.toFixed(2);

    //}

    
    // function purchase(){
    //   alert('Place Order Successfully');
    // }
     


    
    function closeProductModal() {
      document.getElementById('productModal').classList.remove('open');
      document.getElementById('modalBackdrop').classList.remove('open');
      
       
    }

  </script>

     

</body>

</html>
