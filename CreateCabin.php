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
    <title>Insert a New cabin</title>
    <link href="https://fonts.googleapis.com/css?family=Quando&display=swap" rel="stylesheet">
    <link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
  <header> <img src="images/accommodation.png" alt="Accommodation">
    <h1>Insert a New cabin</h1>
  </header>

  <section>

    <form action="CreateCabin_process.php" method="post">
        <br>
        <label for="cabinType">Cabin Type</label>
        <input type="text" id="cabinType" name="cabinType">
        <br><br>
        <label for="cabinDescription">Cabin Description</label>
        <input type="text" id="cabinDescription" name="cabinDescription">
        <br><br>
        <label for="cabinPricePerNight">Cabin Price Per Night</label>
        <input type="text" id="cabinPricePerNight" name="cabinPricePerNight">
        <br><br>
        <label for="cabinPricePerWeek">Cabin Price Per Week</label>
        <input type="text" id="cabinPricePerWeek" name="cabinPricePerWeek">
        <br><br>
        <label for="cabinPhoto">Existing CabinPhoto</label>
        <input type="text" id="cabinPhoto" name="cabinPhoto">
        <br><br>
        <button type="submit" name="submit">Submit</button>
        <br><br>
    </form>
    </section>
    <section>
    <form action="upload_image.php" method="post" enctype="multipart/form-data">  
        Select image to upload: 
        <input type="file" name="fileToUpload" id="fileToUpload"> 
        <br> 
        <input type="submit" value="Upload Image" name="submit"> 
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