<!--  Author : Stefano Corra -->
<html>
  <head>
    <meta charset="utf-8">
    <title>Reservation</title>
    <!-- Latest minified JQuery -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </head>
  <body>
    <?php
    if(isset($_POST['submit'])){
      $servername = "127.0.0.1";
      $username = "root";
      $password = "password";


      // Create connection
      $conn = mysql_connect($servername, $username, $password);
      mysql_select_db("myDB", $conn);

      // Check connection
      if (!$conn) {
          die("Connection failed: " . mysqli_connect_error());
      }

      $firstname = $_POST['firstname'];
      $lastname = $_POST['lastname'];
      $date = $_POST['date'];
      $seat = $_POST['seat'];

      // Verification if is duplicated
      $sql = "SELECT * FROM Reservation WHERE seatID ='$seat' AND transactDate ='$date';";
      $result = mysql_query($sql,$conn);
      $numrow = mysql_num_rows($result);

      if ($numrow > 0) {
        //Redirect to the Results Page
        $url='failed.php';
        echo '<script>window.location = "'.$url.'";</script>';
        die;
      } else {
        // Insert values into database
        $sql2 = "INSERT INTO Reservation".
               "(firstname, lastname, transactDate, seatID) ".
               "VALUES ('$firstname', '$lastname', '$date', '$seat');";

        if (mysql_query($sql2,$conn)) {
            echo "Records created successfully";
        } else {
            echo "Error inserting records: " . mysqli_error($conn);
        }

        mysql_close($conn);

        //Redirect to the Results Page
        $url='success.php';
        echo '<script>window.location = "'.$url.'";</script>';
        die;
      }
    }else{}
    ?>
    <div class="container">
      <h2>Reservation Form</h2><br/>
    </br/>
      <form class="form-horizontal" method = "post" action = "<?php $_PHP_SELF ?>">

          <legend>Personal information:</legend>
          <div class="form-group">
            <div class="col-xs-4">
              <label for="firstname">First Name:</label>
              <input class="form-control" type="text" name="firstname"  placeholder="Enter here" required>
            </div>
          </div>
          <div class="form-group">
            <div class="col-xs-4">
              <label for="lastname">Last Name:</label>
              <input class="form-control" type="text" name="lastname"  placeholder="Enter here" required>
            </div>
          </div>
          <div class="form-group">
            <div class="col-xs-4">
              <label for="date">Date:</label>
              <input class="form-control" type="date" name="date" required>
            </div>
          </div>
          <div class="form-group">
            <div class="col-xs-4">
              <label for="seat">Seat ID:</label>
              <select class="form-control" type="text" name="seat"  required>
                <option value="" disabled selected>Select here</option>
                <option value="34A">34A</option>
                <option value="34B">34B</option>
                <option value="34C">34C</option>
                <option value="35A">35A</option>
                <option value="35B">35B</option>
                <option value="35C">35C</option>
              </select>
            </div>
          </div>
            <div class="col-xs-2">
              <input type="submit" class="btn btn-primary" name="submit" >
            </div>
      </form>
    </div>
  </body>
</html>
