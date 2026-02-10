<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST["product_id"];
    $product_name   = $_POST["product_name"];
    $price   = $_POST["price"];
    $stocks = $_POST["stocks"];

    if(!isset($_FILES['product_image']) || $_FILES['product_image']['error'] !== 0){
        die ("Image Upload Failed");
    }

       $imagedata = file_get_contents($_FILES['product_image']['tmp_name']);
       $sql = "INSERT INTO products
       (product_id, product_name, product_image, price, stocks) VALUES (?,?,?,?,?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
           "issdi", $product_id, $product_name, $imagedata, $price,$stocks
        );

        if($stmt->execute()){
           echo "<script>alert('product save Successfully'); window.location.href='adminpannel.php';</script>";
        }
        else{
            echo"error". $stmt->error;
        }
        $stmt->close();
        $conn->close();
        

}
?>