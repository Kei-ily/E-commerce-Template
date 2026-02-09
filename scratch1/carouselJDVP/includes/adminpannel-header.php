<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
      body{
        font-family:Arial;
      }
      
      header{
position: sticky;
top: 0;
z-index: 999;
}
.navbar{
     background: #ffffff;
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
    width: 80px;
    height: 30px;
    justify-content: space-between;
    align-items: center;
    align-content: center;
    display: flex;
    
}

.logo{
    width:100px;
    height: 60px;
}
.logo img{
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.navbar-brand {
    width: 10px;
    /* height: 50px; */
      font-size: 30px;
      font-style: bold;
      font-family:Helvetica;   
}

.navbar-brand span{
    color: #030303;
    font-style: bold;
    text-align: center;
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
    </style>
</head>
<body>
   <header>
      <nav class="navbar ">
          <div class=" navbar-item-container" id="navbarItems">
                <a class="nav-link active"  href="carousel.php"><</a>
                 <a class="nav-link active"  href="adminpannel_orders.php">Orders</a>
                <a class="nav-link" href="adminpannel.php">Add Products</a>
          </div>
      </nav>
      </header>
    
</body>
</html>