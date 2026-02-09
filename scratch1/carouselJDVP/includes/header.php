<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
      body{
        font-family:Arial;
        margin: 0;
      }
      
      header{
        position: sticky;
        top: 0;
        z-index: 999;
      }

      .navbar{
        background: #f3e8dc;
        color: black;
        height: 60px;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        align-content: center;
        padding: 5px 15px 5px 20px;
      }

      .logo-brand{
        display: flex;
        align-items: center;
        gap: 8px;
        flex-shrink: 0;
      }

      .logo{
        width: 45px;
        height: 45px;
        flex-shrink: 0;
      }

      .logo img{
        width: 100%;
        height: 100%;
        object-fit: contain;
      }

      .navbar-brand {
        font-size: 24px;
        font-weight: bold;
        font-family: Helvetica;
        white-space: nowrap;
      }

      .navbar-brand span{
        color: #030303;
        font-weight: bold;
      }

      .navbar-brand:hover{
        color: black;
      }

      .navbar-item-container{
        display: flex;
        gap: 25px;
        align-items: center;
        align-content: center;
      }

      .circle{
        background:linear-gradient(to left, #6ea8fe, #0a84ca);
        padding: 8px;
        border-radius: 100%;
      }

      .navbar-nav{
        display: flex;
        gap: 26px;
        list-style: none;
      }

      .nav-link , .navbar-brand{
        text-decoration: none;
        color: black;
      }

      /* HOVER ANIMATION NAV */ 
      .nav-link {
        font-size: 18px;
        color: black;
        cursor: pointer;
        position: relative;
        border: none;
        background: none;
        text-transform: uppercase;
        transition-timing-function: cubic-bezier(0.25, 0.8, 0.25, 1);
        transition-duration: 400ms;
        transition-property: color;
      }

      .nav-link:focus,
      .nav-link:hover {
        color: black;
      }

      .nav-link:focus:after,
      .nav-link:hover:after {
        width: 100%;
        left: 0%;
      }

      .nav-link:after {
        content: "";
        pointer-events: none;
        bottom: -2px;
        left: 50%;
        position: absolute;
        width: 0%;
        height: 2px;
        background-color: black;
        transition-timing-function: cubic-bezier(0.25, 0.8, 0.25, 1);
        transition-duration: 400ms;
        transition-property: width, left;
      }

      .form-search{
        margin-right: 10px;
      }

      input[type="search"]{
        width: 15em;
        height: 40px;
        padding: 5px;
        background-color: #222222;
        border-radius: 5px;
        border: 1px solid black;
        outline: none;
      }   

      input[type="search"]:focus{
        border: 1px solid #6ea8fe;
      }

      .form-search{
        display: flex;
        align-items: center;
        gap: 10px;
      }

      .btn{
        background-color: #0d6efd;
        color: white;
        padding: 6px 20px;
        border-radius: 5px;
        border: 1px solid black;
      }

      .btn:hover{
        background-color: #0a58ca;
      }

      .account-ctrl{
        width: 80px;
        height: 30px;
        gap: 10px;
        display: flex;
      }

      .account-circle svg {
        height: 100%;
        width: 100%;
        object-fit: cover;
        color:black;
      }

      .add-to-cart svg {
        height: 100%;
        width: 100%;
        object-fit: cover;
        color: black;
      }

      /* HAMBURGER MENU */
      .burger-menu {
        display: none;
        flex-direction: column;
        cursor: pointer;
        gap: 5px;
      }

      .burger-menu span {
        width: 25px;
        height: 3px;
        background-color: black;
        border-radius: 3px;
        transition: 0.3s ease;
      }

      .burger-menu.active span:nth-child(1) {
        transform: rotate(45deg) translate(8px, 8px);
      }

      .burger-menu.active span:nth-child(2) {
        opacity: 0;
      }

      .burger-menu.active span:nth-child(3) {
        transform: rotate(-45deg) translate(7px, -7px);
      }

      /* RESPONSIVE DESIGN */
      @media (max-width: 768px) {
        .navbar{
          padding: 8px 15px;
          height: 55px;
        }

        .logo {
          width: 40px;
          height: 40px;
        }

        .navbar-brand {
          font-size: 18px;
        }

        .navbar-item-container {
          position: absolute;
          top: 55px;
          left: 0;
          right: 0;
          background: #f3e8dc;
          flex-direction: column;
          gap: 0;
          padding: 0;
          max-height: 0;
          overflow: hidden;
          transition: max-height 0.3s ease;
          border-bottom: 1px solid #ddd;
        }

        .navbar-item-container.active {
          max-height: 400px;
        }

        .navbar-item-container a {
          padding: 12px 20px;
          display: block;
          text-align: left;
          border-bottom: 1px solid #e5d9ca;
          font-size: 16px;
        }

        .navbar-item-container a:hover {
          background-color: #e8dcc8;
        }

        .nav-link:after {
          display: none;
        }

        .account-ctrl {
          width: auto;
          gap: 15px;
          padding: 12px 20px;
          border-top: 1px solid #ddd;
          flex-direction: row;
        }

        .account-ctrl a {
          border: none;
        }

        .burger-menu {
          display: flex;
        }
      }

      @media (max-width: 480px) {
        .navbar{
          padding: 8px 12px;
        }

        .logo {
          width: 35px;
          height: 35px;
        }

        .navbar-brand {
          font-size: 16px;
        }

        .navbar-item-container a {
          padding: 10px 16px;
          font-size: 14px;
        }

        .account-ctrl {
          padding: 10px 16px;
        }

        .burger-menu span {
          width: 22px;
          height: 2.5px;
        }
      }
    </style>
</head>
<body>
   <header>
      <nav class="navbar ">

        <div class="logo-brand">
          <span class="logo"><img src="HompageImg/logo.png" alt="Brewbie Logo"></span>
            <a class="navbar-brand" href="#"><span>Brewbie</span></a>
        </div>
        
        <div class=" navbar-item-container" id="navbarItems">
          <a class="nav-link active"  href="carousel.php">Home</a>
          <a class="nav-link active"  href="productSection.php">Products</a>
          <a class="nav-link" href="about.php">About</a>
          <a class="nav-link"  href="contact.php">Contact</a>
          
          <div class="account-ctrl">
            <a class="add-to-cart" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-basket" viewBox="0 0 16 16">
              <path d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1v4.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 13.5V9a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h1.217L5.07 1.243a.5.5 0 0 1 .686-.172zM2 9v4.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V9zM1 7v1h14V7zm3 3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 4 10m2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 6 10m2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 8 10m2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5m2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5"/>
            </svg></a>
            <a class="account-circle" href="adminpannel.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
              <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
              <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
            </svg></a>
          </div>
        </div>

        <div class="burger-menu" id="burgerMenu">
          <span></span>
          <span></span>
          <span></span>
        </div>

      </nav>
   </header>

   <script>
      const burgerMenu = document.getElementById('burgerMenu');
      const navbarItems = document.getElementById('navbarItems');

      burgerMenu.addEventListener('click', function() {
        burgerMenu.classList.toggle('active');
        navbarItems.classList.toggle('active');
      });

      // Close menu when a link is clicked
      const navLinks = navbarItems.querySelectorAll('a');
      navLinks.forEach(link => {
        link.addEventListener('click', function() {
          burgerMenu.classList.remove('active');
          navbarItems.classList.remove('active');
        });
      });
   </script>
    
</body>
</html>
