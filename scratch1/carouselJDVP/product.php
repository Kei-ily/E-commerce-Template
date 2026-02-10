<?php 
include "db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $total_order = $_POST['total_order'];
    $total_price = $_POST['total_price'];
    
    $customer_name = $_POST['customer_name'];
     $email = $_POST['email'];
      $address = $_POST['address'];
       $contact = $_POST['contact'];

    //check current stock
    $sql_stock = "SELECT stocks FROM products WHERE product_id='$product_id'"; //sql command to get stock
    $result_stock = mysqli_query($conn, $sql_stock); //execute sql command
    $row_stock = mysqli_fetch_assoc($result_stock); //fetch the stock value
    $current_stock = $row_stock['stocks']; //declare curren stock variable

    if ($total_order > $current_stock) {
        $message = "Order exceeds available stock! only {$current_stock} left.";
    } else {
        // insert order
        $sql_insert = "INSERT INTO orders (product_id, product_name, price, quantity, total, customer_name, email, customer_address, contact)
        VALUES ('$product_id', '$product_name', '$price', '$total_order', '$total_price',  '$customer_name', '$email', '$address', '$contact')";
        if (mysqli_query(mysql: $conn, query: $sql_insert)) {
            //deduct stockss

            $new_stock = $current_stock - $total_order;
            $sql_update = "UPDATE products SET stocks='$new_stock' WHERE product_id='$product_id'";
            mysqli_query($conn,$sql_update);

            echo "<script> alert('Place Order Successfully'); window.location.href='carousel.php';</script>";

            
        } else { 
                $message = "Error: " . mysqli_error(mysql: $conn);
        }
    }

}

?>