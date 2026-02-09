<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BrewBie</title>
    <link rel="stylesheet" href="pageStyles.css">
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
            background-image: url(HompageImg/IMG_20250626_224722.jpg);
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
    <!-- Navigation Menu -->
    <?php include 'includes/header.php'; ?>

    <!-- Hero Section -->
    <section  class="hero">
        <div class="hero-container">
            <div class= "header-hero">
            <h1> Contact Us</h1><br>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. <br>
             earum veniam repellat eaque accusantiu</p>
            </div>
        </div>
    </section>

    <section class="section-bg">
        <div class="contact-cards">
            <div class="contact-grid">
              
        <!-- Contact Info -->
        <div class="contact-info">
          <div class="info-card">
            <div class="info-icon">
              <i class="fas fa-map-marker-alt"></i>
            </div>
            <div class="info-content">
              <h3>Address</h3>
              <p>
                Lagro High School<br>
                District V Quezon City
              </p>
            </div>
          </div>

          <div class="info-card">
            <div class="info-icon">
              <i class="fas fa-phone"></i>
            </div>
            <div class="info-content">
              <h3>Phone</h3>
              <p>
                <a href="tel:+09292753869">+63 (9) 292753-869</a>
              </p>
            </div>
          </div>

          <div class="info-card">
            <div class="info-icon">
              <i class="fas fa-envelope"></i>
            </div>
            <div class="info-content">
              <h3>Email</h3>
              <p>
                <a href="mailto:tuasonadrian19@gmail.com">tuasonadrian19@gmail.com</a>
              
              </p>
            </div>
          </div>

        </div>
      </div>
        </div>
    </section>

    <?php include 'includes/footer.php' ?>


</body>
</html>