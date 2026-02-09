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
            background-image: url(HompageImg/IMG_20250626_224652.jpg);
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
            <h1> About Us</h1><br>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. <br>
             earum veniam repellat eaque accusantiu</p>
            </div>
        </div>
    </section>

    <section class="section-bg">
        <div class="about-cards">
            
            <div class="about-image Acards">
                <img src="HompageImg/logoImg.png" class="about-logo" >
            </div>

            <div class="about-text-content Acards">
               <div class="header-about"><h3>ABOUT</h3></div> 
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque perspiciatis ducimus sint, asperiores esse 
            at! Modi quos sequi nemo repudiandae iste, accusamus laboriosam molestias mollitia quis cupiditate, animi cum ducimus.</p>
            </div>
        </div>

    </section>

    <?php include 'includes/footer.php' ?>


</body>
</html>