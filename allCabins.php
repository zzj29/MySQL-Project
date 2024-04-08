<?php
  $link = mysqli_connect("localhost", "root", "", "sunnyspot");
  # check if the connection was successful
  if($link == FALSE){
    exit("Connection error: " . mysqli_connect_error());
  }
  else{
    echo "Connection successful </br>";
  }

  #Sel up mysql query statement
  $query = "SELECT * FROM cabin;";

  #Run the query against the database
  $result = mysqli_query($link, $query);
  if($result == FALSE){
    exit("Query error: " . mysqli_error($link));
  }

  #Check to see that rows of data were returned from the DB
  if(mysqli_num_rows($result)){
    #Show the number of returned rows on the screen
    echo "Returned rows are: " . mysqli_num_rows($result);
  }

  #Store the results in an array
  while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
    
  #Store field values in variables (words in [] need to match column name in DB)
  $cType = $row['cabinType'];
  $cDescri = $row['cabinDescription'];
  $pNight = $row['pricePerNight'];
  $pWeek = $row['pricePerWeek'];
  $pho = $rwo['photo'];

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