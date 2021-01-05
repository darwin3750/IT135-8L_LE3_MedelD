<?php
session_start(); //starts the session
if($_SESSION['user']) { //checks if user is logged in
  header("location:home.php"); // redirects if user is logged in
}
$user = $_SESSION['user']; //assigns user value
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Food Delivery Store</title>
  <link rel="stylesheet" href="../assets/styles/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/styles/styles.css">
</head>

<body>
  <h1>To begin using our services, please register.</h1>
</body>

</html>