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
    <title>Administrative menu</title>
    <link href="https://fonts.googleapis.com/css?family=Quando&display=swap" rel="stylesheet">
    <link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
  <header> <img src="images/accommodation.png" alt="Accommodation">
    <h1>Administrative menu</h1>
  </header>


  <menu>
  <a href="CreateCabin.php">Insert New cabin</a>
  <!-- <a href="UpdateCabin.php">Update Cabin</a> -->
  <!-- <a href="DeleteCabin.php">Delete Cabin</a> -->
  </menu>


  <section>

  <?php
  $link = mysqli_connect("localhost", "root", "", "sunnyspot");
  # check if the connection was successful
  if($link == FALSE){
    exit("Connection error: " . mysqli_connect_error());
  }

  #Set up mysql query statement
  $query = "SELECT * FROM cabin;";

  #Run the query against the database
  $result = mysqli_query($link, $query);
  if($result == FALSE){
    exit("Query error: " . mysqli_error($link));
  }

  #Store the results in an array
  while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

  #Store field values in variables (words in [] need to match column name in DB)
  $cID = $row['cabinID'];
  $cType = $row['cabinType'];
  $cDescri = $row['cabinDescription'];
  $pNight = $row['pricePerNight'];
  $pWeek = $row['pricePerWeek'];
  $pho = $row['photo'];

  #Dsiplay data on page
  echo "<article>";
  echo "<h2>$cType</h2>";
  echo "<img src='images/$pho' alt=$cType>";
  echo "<p><span>Details: </span>$cDescri</p>";
  echo "<p><span>Price per night: </span>$pNight</p>";
  echo "<p><span>Price per week: </span>$pWeek</p>";
  echo "<a href='UpdateCabin.php?cabinID=$cID'>UPDATE</a><br>";
  echo "<a href='DeleteCabin.php?cabinID=$cID'>DELETE</a>";
  echo "</article>";
  } // END while loop

  #Free the memory related to the result
  mysqli_free_result($result);

  #Close the connection to the DB after we have retrieced data from the DB
  mysqli_close($link);
  ?>

  </section>

  <footer> 
    <a href="adminMenu.php">Admin</a> 
    <a href="login.php">Log In</a> 
    <a href="logout_process.php">Log Out</a>
  </footer>
</body>
</html>

<?php
  }//END of the logged in else statement
?>