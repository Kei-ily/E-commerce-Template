<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Shop</title>
    <link href="custom.css" rel="stylesheet">
     <link rel="icon" href="HompageImg/logoImg.png">
    <style>
              /* Hero Section */
        .hero {
            padding: 5rem 1rem;
            height: 70vh;
            text-align: left;
            background: #fdf6ec;
            position: relative;
            align-items: center;
            align-content: center;
            margin: 0 auto;
            overflow: hidden;
        }

        .hero::before{
            content: "";
            position: absolute;
            top: 0; left: 0; 
            width: 100%;
            height: 100%;
            background-image: url(HompageImg/finalbg.jpg);
            background-repeat: no-repeat;
            background-size: cover;
            z-index: 0;
            background-position: center;
          
        }
        .hero::after{
            content: "";
            position: absolute;
            top: 0; left: 0;
            width: 100%;
            height: 100%;
          background: linear-gradient(to bottom,#00000060,#2c1a13a4 );
            z-index: 1;
        }

        .hero-container {
            max-width: 1200px;
            margin: 0 auto;
        }

    .hero-container{
        margin: 0 auto;
        box-sizing: border-box;
        display: flex;
        justify-content: center;
    }
    .header-hero{
        z-index: 3;
    }
     
    .header-hero h1{
        font-size: 3rem;
        font-weight: bold;
        color: white;
        z-index: 3;
        text-align: center;
    }
    .header-hero p{
        font-size: 1.25rem;
            color: white;
            margin-bottom: 2rem;
            max-width: 48rem;
            margin-left: auto;
            margin-right: auto;
            z-index: 3;
            text-align: center;
    }
    </style>
</head>
<body>

<?php include 'includes/header.php'?>

<section  class="hero">
        <div class="hero-container">
            <div class= "header-hero">
            <h1>Products</h1><br>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. <br>
             earum veniam repellat eaque accusantiu</p>
            </div>
        </div>
    </section>
  
  
    <section class="section-bg products-sec">

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
          onclick="openProductModal(this)"
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
              <button class="btn-primary" onclick="openProductModal(this.closest('.product-card'));" >
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


  
  <div class="modal-backdrop" id="modalBackdrop" onclick="closeProductModal()"></div>

  <div class="modal-product" id="productModal">
    <div class="modal-content">
      <button class="modal-close-btn" onclick="closeProductModal()" aria-label="Close modal" title="Close">
        ✕
      </button>

      <div class="modal-body">
        <div class="modal-img-section">
          <img id="modalProductImage" alt="Product Image" src="/placeholder.svg">
        </div>

        <div class="modal-info-section">
          <h2 id="modalProductName"></h2>
          
          <div class="modal-price-stocks">
            <p><strong>Price:</strong><span id="modalProductPrice"></span></p>
            <p><strong>Available Stock:</strong><span id="modalProductStocks"></span></p>
          </div>

          <form action='product.php' method='post'>
            <!-- Hidden fields -->
            <input type="number" name="product_id" id="modalProductId" readonly hidden>
            <input type="text" name="product_name" id="modalPName" readonly hidden>
            <input type="number" name="price" id="modalPrice" readonly hidden>

            <div class="modal-form-group inline">
              <label>Quantity & Total</label>
              <input type="number" id="quantityInput" value="1" min="1" max="50" name="total_order" required placeholder="Qty">
              <input type="number" id="productTotalPrice" name="total_price" readonly placeholder="₱0.00">
            </div>

            <div class="modal-form-group">
              <label for="customer_Name">Full Name</label>
              <input type="text" id="customer_Name" name="customer_name" placeholder="Your full name" required>
            </div>

            <div class="modal-form-group">
              <label for="Email">Email Address</label>
              <input type="email" id="Email" name="email" placeholder="your@email.com" required>
            </div>

            <div class="modal-form-group">
              <label for="address">Address</label>
              <input type="text" id="address" name="address" placeholder="Delivery address">
            </div>

            <div class="modal-form-group">
              <label for="contact">Contact Number</label>
              <input type="tel" id="contact" name="contact" placeholder="09XX-XXX-XXXX">
            </div>

            <div class="modal-action-buttons">
              <input type="submit" class="btn-buy" value="Complete Purchase" onclick="purchase()">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>


   <?php include 'includes/footer.php' ?>

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
      document.getElementById('modalPrice').value = currentProduct.price;
      document.getElementById('modalPName').value = currentProduct.name;

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
