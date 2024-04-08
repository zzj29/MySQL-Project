<?php 
    session_start();
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Process</title>
    <link href="https://fonts.googleapis.com/css?family=Quando&display=swap" rel="stylesheet">
    <link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
  <header> <img src="images/accommodation.png" alt="Accommodation">
    <h1>Login Process</h1>
  </header>

  <section>

  <?php
    #Connect to the mysql server
    $link = mysqli_connect("localhost", "root", "", "sunnyspot");
    # check if the connection was successful
    if($link == FALSE){
    exit("Connection error: " . mysqli_connect_error());
    }

    #Get values from login.php
    $Username = mysqli_real_escape_string($link, trim($_POST['username']));
    $Password = mysqli_real_escape_string($link, $_POST['password']);

    #Set up mysql query statement
    $query = "SELECT * FROM `admin` WHERE `userName`='$Username' AND `password`='$Password';";
    
    #Run the query against the database
    $result = mysqli_query($link, $query);
    if($result == FALSE){
      exit("Query error: " . mysqli_error($link));
    }
  
    #Check if number of row is 0, redirect the user to the login.php page with error message 
    $RowCount = mysqli_num_rows($result);
    if($RowCount == 0){
      header("Location:login.php?error=true");
    }

    #If number of row is 1, login seccessful
    else{

      #store the adminID for the second query 
      $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
      $adminID = $row['staffID'];

      #Set up second mysql query statement for log
      $queryinsert = "INSERT INTO `log`(`staffID`, `loginDateTime`) 
      VALUES ($adminID,CURRENT_TIMESTAMP());";

      #Run the query against the database
      $result2 = mysqli_query($link, $queryinsert);
      if($result == FALSE){
      exit("Query error: " . mysqli_error($link));
      }

      #Set session variables for user authorised and the auto_increment logID
      $_SESSION['userAuth'] = true;
      $_SESSION['logID'] = mysqli_insert_id($link);

      #Redirect the user to adminMenu.php page
      header("Location:adminMenu.php");

    } //END else for $RowCount == 1

    #Close the connection to the DB after we have retrieced data from the DB
    mysqli_close($link);
  ?>

  </section>

<footer> 
  <a href="adminMenu.php">Back to Admin Menu</a> 
</footer>
</body>
</html>