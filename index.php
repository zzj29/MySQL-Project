<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sunnspot Accommodation</title>
    <link href="https://fonts.googleapis.com/css?family=Quando&display=swap" rel="stylesheet">
    <link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
  <header> <img src="images/accommodation.png" alt="Accommodation">
    <h1>Sunnyspot Accomodation</h1>
  </header>

  <section>

  <?php
  $link = mysqli_connect("localhost", "root", "", "sunnyspot");
  # check if the connection was successful
  if($link == FALSE){
    exit("Connection error: " . mysqli_connect_error());
  }

  #Sel up mysql query statement
  $query = "SELECT * FROM cabin;";

  #Run the query against the database
  $result = mysqli_query($link, $query);
  if($result == FALSE){
    exit("Query error: " . mysqli_error($link));
  }

  #Store the results in an array
  while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

  #Store field values in variables (words in [] need to match column name in DB)
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
  </footer>
</body>
</html>
