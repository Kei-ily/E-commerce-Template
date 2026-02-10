<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Admin</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            color: #333;
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 280px;
            background-color: #fff;
            padding: 30px 20px;
            border-right: 1px solid #e0e0e0;
            box-shadow: 2px 0 5px rgba(0,0,0,0.05);
         
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 6px;
            font-size: 14px;
            color: #555;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

        .form-group input:focus {
            outline: none;
            border-color: #4CAF50;
        }

        .button-group {
            margin-top: 30px;
        }

        .btn {
            width: 100%;
            padding: 12px;
            margin-bottom: 12px;
            border: none;
            border-radius: 4px;
            font-size: 15px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .btn-add {
            background-color: #4CAF50;
            color: white;
        }

        .btn-add:hover {
            background-color: #45a049;
        }

        .btn-update {
            background-color: #4CAF50;
            color: white;
        }

        .btn-update:hover {
            background-color: #45a049;
        }

        .btn-export {
            background-color: #fff;
            color: #333;
            border: 1px solid #ccc;
        }

        .btn-export:hover {
            background-color: #f5f5f5;
        }

        /* Main Content Styles */
        .main-content {
            flex: 1;
            padding: 40px;
            background-color: #fafafa;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 28px;
            color: #333;
            font-weight: 500;
        }

        /* Search Section */
        .search-section {
            background-color: #fff;
            padding: 20px;
            border-radius: 6px;
            margin-bottom: 25px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .search-controls {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .search-controls label {
            font-size: 14px;
            color: #555;
            white-space: nowrap;
        }

        .search-controls select {
            padding: 8px 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            background-color: #fff;
        }

        .search-controls input[type="text"] {
            flex: 1;
            padding: 8px 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

        .search-controls button {
            padding: 8px 24px;
            background-color: #f0f0f0;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .search-controls button:hover {
            background-color: #e0e0e0;
        }

        /* Table Styles */
        .table-container {
            background-color: #fff;
            border-radius: 6px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background-color: #f8f8f8;
        }

        th {
            padding: 14px 16px;
            text-align: center;
            font-size: 14px;
            font-weight: 600;
            color: #555;
            border-bottom: 2px solid #e0e0e0;
        }

        td {
            padding: 14px 16px;
            font-size: 14px;
            color: #666;
            border-bottom: 1px solid #f0f0f0;
            text-align:center;
        }

        tbody tr:hover {
            background-color: #fafafa;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        
       
    </style>
</head>
<body>

  <?php include 'db.php' ?>

  <?php include 'includes/adminpannel-header.php' ?>

    <!-- <div class="container">
        <aside class="sidebar">
            <form action='#' method='post' id="productForm" enctype="multipart/form-data">
                 <div class="form-group">
                    <label for="PRODUCT_ID">Customer ID:</label>
                    <input type="number" name="customer_id" value="<?php echo $nextCID; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="PRODUCT_ID">Prdoduct ID:</label>
                    <input type="number" name="product_id" value="<?php echo $nextPID; ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="PRODUCT_NAME">PRODUCT NAME:</label>
                    <input type="text" name="product_name" required readonly>
                </div>

                <div class="form-group">
                    <label for="PRICE">PRICE</label>
                    <input  type="number" name="price" required readonly>
                </div>

                <div class="form-group">
                    <label for="STOCKS">Quantity:</label>
                    <input type="number" name="quantity" required readonly> 
                </div>

                <div class="form-group">
                    <label for="STOCKS">Total Price:</label>
                    <input type="number" name="total" required readonly>
                </div>

                <div class="form-group">
                    <label for="STOCKS">Customer Name:</label>
                    <input type="text" name="customer_name" required readonly>
                </div>
                


                <div class="button-group">
                    <input type="submit"  class="btn btn-add" name="add" value="Done"> -->
                     <!-- <input type="submit"  class="btn btn-update" name="update" value="Update"> -->
                    <!-- <input type="reset" class="btn btn-export" name="reset" value="Reset">
                </div>
            </form>
        </aside> -->

        <!-- Main Content -->
        <main class="main-content">
            <div class="header">
                <h1>CUSTOMER ORDERS</h1>
            </div>

            <!-- Search Section -->
            <div class="search-section">
                <div class="search-controls">
                    <label for="searchBy">Search by:</label>
                    <select id="searchBy" name="searchBy">
                         <option value="product_id">Customer ID Number</option>
                        <option value="product_id">Product ID Number</option>
                        <option value="product_name">Product Name</option>
                          <option value="price">Price</option>
                        <option value="stocks">Stocks</option>
                    </select>
                    <input type="text" id="searchInput" placeholder="Enter search term...">
                </div>
            </div>

            <!-- Students Table -->
            <div class="table-container">
                <table>
                    <thead>
                          <tr>
                            <th>Customer ID:</th>
                             <th>Product ID:</th>
                             <th>Product Name:</th>
                             <th>Price: </th>
                             <th>Quantity:</th>
                              <th>Total Price:</th>
                              <th>Customer Name:</th>
                              <th>Email:</th>
                               <th>Customer Address:</th>
                                <th>Customer Contact:</th>
                            </tr>
                    </thead>
                    <tbody id="studentsTableBody">
                         <?php
          $sql = "SELECT * FROM orders";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<td>{$row['order_id']}</td>";
              echo "<td>{$row['product_id']}</td>";
              echo "<td>{$row['product_name']}</td>";
              echo "<td>{$row['price']}</td>";
              echo "<td>{$row['quantity']}</td>";
              echo "<td>{$row['total']}</td>";
               echo "<td>{$row['customer_name']}</td>";
               echo "<td>{$row['email']}</td>";
               echo "<td>{$row['customer_address']}</td>";
                echo "<td>{$row['contact']}</td>";


             
              echo "</tr>";
            }
          } else {
            echo "<tr ><td></td><td colspan='5'>No records found</td></tr>";
          }
          ?>
                        
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <script>
        
    document.addEventListener("DOMContentLoaded", function() {
        const searchInput = document.getElementById("searchInput");
        const searchBy = document.getElementById("searchBy");

        searchInput.addEventListener("input", filterTable);
        searchBy.addEventListener("change", filterTable);
        
        function filterTable() {
            const term = searchInput.value.toLowerCase();
            const category = searchBy.value.toLowerCase();
            const rows = document.querySelectorAll("table tbody tr");

            const  columnIndex = getColumnIndex(category);

            rows.forEach (rows => {
                const cell = rows.querySelector(`td:nth-child(${columnIndex})`);
                if (cell && cell.textContent.toLowerCase().startsWith(term)) {
                    rows.style.display = "";
                }
                else {
                    rows.style.display="none";
                }
            });
        }

        function getColumnIndex(columnName) {
            switch (columnName) {
                case "customer_id": return 1;
                case "product_id": return 2;
                case "product_name": return 3;
                case "price": return 4;
                case "stocks": return 5;
                default: return 1;
            }
        }
    });

    //      document.addEventListener("DOMContentLoaded", function() {
    //   const rows = document.querySelectorAll("table tbody tr");
    //   rows.forEach(row => {
    //     row.addEventListener("click", function() {
    //       const cells = row.querySelectorAll("td");
    //       document.querySelector("input[name='customer_id']").value = cells[0].textContent;
    //       document.querySelector("input[name='product_id']").value = cells[1].textContent;
    //       document.querySelector("input[name='product_name']").value = cells[2].textContent;
    //       document.querySelector("input[name='price']").value = cells[3].textContent;
    //       document.querySelector("input[name='quantity']").value = cells[4].textContent;
    //       document.querySelector("input[name='total']").value = cells[5].textContent;
    //       document.querySelector("input[name='customer_name']").value = cells[6].textContent;
      
    //     });
    //   });
    // });

    </script>
</body>
</html>
