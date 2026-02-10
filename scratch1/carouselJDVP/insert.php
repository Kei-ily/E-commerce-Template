<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST["product_id"];
    $product_name   = $_POST["product_name"];
    $product_image   = $_POST["product_image"];
    $price   = $_POST["price"];
    $stocks = $_POST["stocks"];
   

    if (isset($_POST['add'])) {

        $sql = "INSERT INTO `products` (`product_id`, `product_name`, `product_image`, `price`, `stocks`)
                VALUES ('$product_id', '$product_name', '$product_image', '$price', '$stocks')";

                


        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Product Added successfully'); window.location.href='adminpannel.php';</script>";
            exit();
        }
    }

    if (isset($_POST['update'])) {
        $sql = "UPDATE products
                SET `product_id`='$product_id', `product_name`='$product_name', `product_image`='$product_image', `price`='$price', `stocks`='$stocks'
                WHERE `product_id`='$product_id'";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Product Update successfully'); window.location.href='adminpannel.php';</script>";
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
$conn->close();
