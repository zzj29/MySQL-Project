<?php
session_start();
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Out Process</title>
    <link href="https://fonts.googleapis.com/css?family=Quando&display=swap" rel="stylesheet">
    <link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
  <header> <img src="images/accommodation.png" alt="Accommodation">
    <h1>Log Out Process</h1>
  </header>

  <section>

    <?php
    echo "You have been logged out.";
    $logID = $_SESSION['logID'];
    #Record the log out time INTO log table
        #Connect to the mysql server
        $link = mysqli_connect("localhost", "root", "", "sunnyspot");
        # check if the connection was successful
        if($link == FALSE){
        exit("Connection error: " . mysqli_connect_error());
        }
        
        #Set up mysql query statement
        $query = "UPDATE `log` 
                  SET `logoutDateTime`= CURRENT_TIMESTAMP() 
                  WHERE `logID`= $logID;";
        
        #Run the query against the database
        $result = mysqli_query($link, $query);
        if($result == FALSE){
          exit("Query error: " . mysqli_error($link));
        }

    #Unset the session 
    session_destroy();
    unset($_SESSION['userAuth']);

    ?>

    </section>

    <footer> 
    <a href="adminMenu.php">Back to Admin Menu</a> 
    </footer>
</body>
</html>