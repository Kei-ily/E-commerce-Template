<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST["product_id"];
    $product_name   = $_POST["product_name"];
    $price   = $_POST["price"];
    $stocks = $_POST["stocks"];


// ADD PRODUCT
    if(isset($_POST['add'])){
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

// UPDATE PRODUCT 
     if(isset($_POST['update'])){
     if(isset($_FILES['product_image']) && $_FILES['product_image']['error'] === 0){
            $imagedata = file_get_contents($_FILES['product_image']['tmp_name']);
            $sql = "UPDATE products SET product_name=?, product_image=?, price=?, stocks=? WHERE product_id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssdii", $product_name, $imagedata, $price, $stocks, $product_id);
        } else {
            
            $sql = "UPDATE products SET product_name=?, price=?, stocks=? WHERE product_id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sdii", $product_name, $price, $stocks, $product_id);
        }

        if($stmt->execute()){
           echo "<script>alert('product updated Successfully'); window.location.href='adminpannel.php';</script>";
        }
        else{
            echo"error". $stmt->error;
        }
        $stmt->close();
        $conn->close();
    }
    
    if(isset($_POST['delete'])){
        $sql = "DELETE FROM products WHERE product_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $product_id);

        if($stmt->execute()){
           echo "<script>alert('product deleted Successfully'); window.location.href='adminpannel.php';</script>";
        }
        else{
            echo"error". $stmt->error;
        }
        $stmt->close();
        $conn->close();
    }

}
?>
