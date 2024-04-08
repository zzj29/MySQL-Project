<?php 
  session_start();
  #check if the user is NOT authorised - redirect to the login page
  if(!isset($_SESSION['userAuth'])){
    header("Location:login.php");
  }
  else{
    echo "User is logged in";
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert New cabin Process</title>
    <link href="https://fonts.googleapis.com/css?family=Quando&display=swap" rel="stylesheet">
    <link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
  <header> <img src="images/accommodation.png" alt="Accommodation">
    <h1>Insert New cabin Process</h1>
  </header>

  <section>

    <?php

        #Connect to the mysql server
        $link = mysqli_connect("localhost", "root", "", "sunnyspot");
        # check if the connection was successful
        if($link == FALSE){
        exit("Connection error: " . mysqli_connect_error());
        }

        #Get values from form on InsertNewCabin.php
        $cType = mysqli_real_escape_string($link, $_POST['cabinType']);
        $cDescri = mysqli_real_escape_string($link, $_POST['cabinDescription']);
        $pNight = mysqli_real_escape_string($link, $_POST['cabinPricePerNight']);
        $pWeek = mysqli_real_escape_string($link, $_POST['cabinPricePerWeek']);
        $pho = mysqli_real_escape_string($link, $_POST['cabinPhoto']);

        #Test image file is uploaded. If not, use default value "testCabin.jpg"
        if(empty($pho)){
          $pho = "testCabin.jpg";
        }

        #Test price per night is a positive number 
        if($pNight <= 0){
          echo "Invalid value: Please provide positive value for price per night.";
          mysqli_close($link);
          exit();
        }

        #Test price per week is no more than 5 times the price per night
        else{
          if($pWeek > $pNight*5){
            echo "Invalid value: Price per week shoule be not more than 5 times the price per night.";
            mysqli_close($link);
            exit();
          }
        }

        #Set up mysql query statement
        $query = "INSERT INTO cabin(`cabinType`,`cabinDescription`,`pricePerNight`,`pricePerWeek`,`photo`) 
                  VALUES('$cType', '$cDescri', '$pNight', '$pWeek', '$pho');";

        #Run the query against the database
        $result = mysqli_query($link, $query);
        if($result == FALSE){
        exit("Query error: " . mysqli_error($link));
        }
        else{
            echo "New Cabin " . $cType . " Successfully Inserted <br>";
        }

        #Close the connection to the DB after we have retrieced data from the DB
        mysqli_close($link);
    ?>

  </section>

  <footer> 
    <a href="adminMenu.php">Back to Admin Menu</a> 
  </footer>
</body>
</html>

<?php
  }
?>