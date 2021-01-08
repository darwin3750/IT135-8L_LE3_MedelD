<?php

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = ($_POST['username']);
    $password = ($_POST['password']);
    $bool = true;
    $db_name = "deliverydb";
    $db_username = "root";
    $db_pass = "";
    $db_host = "localhost";
    $con = mysqli_connect("$db_host", "$db_username", "$db_pass", "$db_name")
      or die(mysqli_connect_error()); //Connect to server
    $query = "SELECT * from users";
    $results = mysqli_query($con, $query); //Query the users table
    while ($row = mysqli_fetch_array($results)) //display all rows from query
    {
      $table_users = $row['username']; // the first username row is passed on to $table_users, and so on until the query is finished
      if ($username == $table_users) // checks if there are any matching fields
      {
        $bool = false; // sets bool to false
        print '<script>alert("Username has been taken!");</script>'; //Prompts the user
        //print '<script>window.location.assign("register.php");</script>'; // redirects to register.php
      }
    }
    if ($bool) // checks if bool is true
    {
      mysqli_query($con, "INSERT INTO users (username, password) VALUES ('$username','$password')"); //Inserts the value to table users
      print '<script>alert("Successfully Registered!");</script>'; // Prompts the user
      //print '<script>window.location.assign("register.php");</script>'; // redirects to register.php
    }
  }
?>

<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Food Delivery Store</title>
  <link rel="stylesheet" href="../assets/styles/styles.css">
  <script src="../javascript/anime.min.js"></script>
</head>

<body class="h-100 theme1">
  <div class="d-sm-flex align-items-center justify-content-center h-100">
    <section class="overflow-hidden container p-0">
      <div class="le3-bg-contrast rounded-top p-3 le3-border-contrast-2 position-relative" style="z-index: 999;">
        <h2 class="le3-semibold text-center le3-color-base">Registration Page</h2>
      </div>
      <div class="card rounded-top-0 le3-border-contrast-2 h-sm-auto h-100 p-0 le3-animate-slidedown">
        <section class="row p-4">
          <section class="col-md-5 d-flex align-items-center justify-content-center p-5">
            <img src="../assets/join.svg" height="auto" width="300px" />
          </section>
          <section class="col-md-7 mt-auto mb-auto">
            <form class="overflow-hidden" action="register.php" method="POST">
              <div class="form-group">
                <label for="username" class="le3-animate-slidein">Username:</label>
                <input id="username" type="text" name="username" class="form-control le3-animate-slidein" required="required" />
              </div>
              <div class="form-group">
                <label for="password" class="le3-animate-slidein">Password:</label>
                <input id="password" type="password" name="password" class="form-control le3-animate-slidein" required="required" />
              </div>
              <input type="submit" value="Register" class="btn le3-btn-primary btn-lg btn-block mb-2 le3-animate-slidein" />
              <a class="le3-animate-slidein d-block" href="login.php">Have an Account? Login here!</a>
            </form>
            <p class="text-center">IT135-8L_LE3_MedelD</p>
          </section>
        </section>
      </div>
    </section>
  </div>
</body>

<script defer>
  anime.timeline({
    loop: false
  }).add({
    targets: '.le3-animate-slidedown',
    translateY: ['-100%', 0],
    easing: "easeOutExpo",
    duration: 3000,
    offset: 600,
  }).add({
    targets: '.le3-animate-slidein',
    translateX: ['-100%', '0'],
    easing: "easeOutQuad",
    delay: (el, i) => i * 200,
    offset: 600,
    duration: 1000,
  })
</script>

</html>