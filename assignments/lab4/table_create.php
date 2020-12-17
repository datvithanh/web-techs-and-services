<html>

<head>
  <title>Create Table</title>
</head>

<body>
  <?php
  $server = 'db';
  $username = 'wordpress';
  $password = 'wordpress';
  $mydb = 'wordpress';
  $table_name = 'Products';

  $conn = new mysqli($server, $username, $password, $mydb, 3306);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  } else {
    $SQLcmd = "CREATE TABLE $table_name(
              ProductID INT UNSIGNED NOT NULL
              AUTO_INCREMENT PRIMARY KEY,
              Product_desc VARCHAR(50),
              Cost INT,
              Weight INT,
              Numb INT)";
    $conn -> select_db($mydb);

    if ($conn->query($SQLcmd) === TRUE) {
      echo "Table $table_name created successfully";
    } else {
      echo "Error creating table: " . $conn->error;
    }
  }
  ?></body>

</html>