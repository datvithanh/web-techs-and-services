<html>

<head>
  <title>Products data</title>
</head>

<body>
  <?php
  $server = 'db';
  $username = 'wordpress';
  $password = 'wordpress';
  $mydb = 'wordpress';
  $table_name = 'Products';
  $desc = $_POST["desc"];
  $conn = new mysqli($server, $username, $password, $mydb, 3306);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  } else {
    if ($desc != "")
      $SQLcmd = "select * from Products where Product_desc = '$desc'";
    else
      $SQLcmd = "";
    $conn -> select_db($mydb);
    $result = $conn->query($SQLcmd);
    echo "The query is $SQLcmd<br>";
    if ($result->num_rows > 0) {
      // output data of each row
      echo "<table style='width:30%'>";
      while($row = $result->fetch_assoc()) {
        echo "<tr><th>" . $row["ProductID"]. "</th><th>" . $row["Product_desc"]. "</th><th>" . $row["Cost"]. "</th><th>" . $row["Weight"]. "</th><th>" . $row["Numb"]. "</tr>";
      }
      echo "</table>";
    } else {
      echo "0 results";
    }
    $conn->close();
  }
  ?></body>

</html>