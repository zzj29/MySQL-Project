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
    <title>Delete cabin</title>
    <link href="https://fonts.googleapis.com/css?family=Quando&display=swap" rel="stylesheet">
    <link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
  <header> <img src="images/accommodation.png" alt="Accommodation">
    <h1>Delete cabin</h1>
  </header>

  <?php
    #for DELETE, pull date from DB where cabinID = the one to delete 
    $cID = $_GET['cabinID'];
    echo "Are you sure you are going to delete Cabin " . $cID;
    
    #Run a query to get cabin information from the database where cabinID is given
    $link = mysqli_connect("localhost", "root", "", "sunnyspot");
   
    # check if the connection was successful
    if($link == FALSE){
      exit("Connection error: " . mysqli_connect_error());
    }
  
    #Sel up mysql query statement
    $query = "SELECT * FROM cabin WHERE `cabinID`in ($cID);";
  
    #Run the query against the database
    $result = mysqli_query($link, $query);
    if($result == FALSE){
      exit("Query error: " . mysqli_error($link));
    }

    #Store the results in an array
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
  
    #Store field values in variables (words in [] need to match column name in DB)
    $cType = $row['cabinType'];
    $cDescri = $row['cabinDescription'];
    $pNight = $row['pricePerNight'];
    $pWeek = $row['pricePerWeek'];
    $pho = $row['photo'];

    #Free the memory related to the result
    mysqli_free_result($result);

    #Close the connection to the DB after we have retrieced data from the DB
    mysqli_close($link);
  ?>

  <section>
    <!-- form to update the cabin details required -->
    <form action="DeleteCabin_process.php" method="post">
        <br>
        <input type="hidden" id="cabinID" name="cabinID" value="<?php echo $cID ?>">
        <label for="cabinType">Cabin Type</label>
        <input type="text" id="cabinType" name="cabinType" value="<?php echo $cType ?>">
        <br><br>
        <label for="cabinDescription">Cabin Description</label>
        <input type="text" id="cabinDescription" name="cabinDescription" value="<?php echo $cDescri ?>">
        <br><br>
        <label for="cabinPricePerNight">Cabin Price Per Night</label>
        <input type="text" id="cabinPricePerNight" name="cabinPricePerNight" value="<?php echo $pNight ?>">
        <br><br>
        <label for="cabinPricePerWeek">Cabin Price Per Week</label>
        <input type="text" id="cabinPricePerWeek" name="cabinPricePerWeek" value="<?php echo $pWeek ?>">
        <br><br>
        <label for="cabinPhoto">Cabin Photo</label>
        <input type="text" id="cabinPhoto" name="cabinPhoto" value="<?php echo $pho ?>">
        <br><br>
        <button type="submit" name="confirm">Confirm</button>
        <br><br>
    </form>

  </section>

  <footer> 
    <a href="adminMenu.php">Back to Admin Menu</a> 
    <a href="logout_process.php">Log Out</a>
  </footer>
</body>
</html>

<?php
  }
?>