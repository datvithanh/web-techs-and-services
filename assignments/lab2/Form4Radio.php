<html>
  <head><title> Receiving Input</title></head>
  <body>
    <font size=5> ty for your input</font>
    <?php
      $email = $_POST["email"];
      $contact = $_POST["contact"];
      print("<br>your email add is $email");
      print("<br>contact preference is $contact");
    ?>
  </body>
</html>