<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Zhijun Zhang Project Assessment #2">
    <title>Sunnspot Login</title>
    <link href="https://fonts.googleapis.com/css?family=Quando&display=swap" rel="stylesheet">
    <link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
  <header> <img src="images/accommodation.png" alt="Accommodation">
    <h1>Sunnyspot Login</h1>
  </header>
  
    <?php
    if(isset($_GET['error'])){
        echo "<div style='color:red;'>Please provide valid Username or Password.</div>";
    }
    ?>

    <main>
        <h1>Login</h1>
        <form action="login_process.php" method="post">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username">
                <br><br>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password">
                <br><br>
                <button type="submit" name="login">LOGIN</button>
        </form>
    </main>
  <footer> 
    <a href="adminMenu.php">Back to Admin Menu</a> 
  </footer>

</body>
</html>