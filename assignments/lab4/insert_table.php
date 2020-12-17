<html>
  <body>
    <?php
      $desc = $_POST["desc"];
      $weight = $_POST["weight"];
      $cost = $_POST["cost"];
      $avail = $_POST["avail"];
      $sql = "INSERT INTO Products (ProductID, Product_desc, Cost, Weight, Numb)
              VALUES (0, '$desc', $weight, $cost, $avail)";

      echo "The query is $sql <br>";
      $server = 'db';
      $username = 'wordpress';
      $password = 'wordpress';
      $mydb = 'wordpress';
      $table_name = 'Products';
    
      $conn = new mysqli($server, $username, $password, $mydb, 3306);
      if ($conn->query($sql) === TRUE) {
        echo "query executed successfully";
      } else {
        echo "Error execute query: " . $conn->error;
      }
    ?>
  </body>
</html>