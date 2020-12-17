<html>
  <head><title> Receiving Input</title></head>
  <body>
    <font size=5> ty for your input</font>
    <?php
      $class = $_POST["class"];
      $name = $_POST["name"];
      $uni = $_POST["uni"];
      $hb1 = $_POST["vehicle1"];
      $hb2 = $_POST["vehicle2"];
      $hb3 = $_POST["vehicle3"];
      print("<br>your name is $name");
      print("<br>your class is $class");
      print("<br>your uni is $uni");
      print("<br> hobbies $hb1 $hb2 $hb3")
    ?>
  </body>
</html>