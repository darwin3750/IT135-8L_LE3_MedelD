<?php
session_start(); //starts the session
if(isset($_SESSION['user'])) { //checks if user is logged in
  header("location:home.php"); // redirects if user is logged in
}
?>

<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Food Delivery Store</title>
  <link rel="stylesheet" href="assets/styles/styles.css">
  <script src="javascript/anime.min.js"></script>
</head>

<body class="theme1 text-center d-flex justify-content-center align-items-center h-100">
  <div class="p-md-0 p-3">
    <h1 class="le3-title mb-2 le3-animate-wavetext">My Food Delivery Store</h1>
    <hr class="p-1 le3-bg-contrast rounded le3-animate-slide">
    <h2 class="le3-bold mb-3 mt-4 le3-animate-fadein">To begin using our services, <a href="views/register.php">register</a> to our site.</h2>
    <h4 class="le3-semibold le3-animate-fadein">Already have an account? <a href="views/login.php">Sign in</a>.</h4>
  </div>
</body>

<script defer>
  //put every letter in the text on a separate tag
  const textWrapper = document.querySelector('.le3-animate-wavetext');
  const textRetain = textWrapper.innerHTML;
  textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

  anime.timeline({ loop: false }).add({
    targets: '.le3-animate-wavetext .letter',
    translateY: [-100, 0],
    easing: "easeOutExpo",
    delay: (el, i) => i * 30,
    duration: 800,
    offset: 600,
  }).add({
    targets: '.le3-animate-slide',
    scaleX: [0,1],
    opacity: [0,1],
    easing: "easeOutQuad",
    offset: '-=1100',
    duration: 800,
  }).add({
    targets: '.le3-animate-fadein',
    opacity: [0,1],
    easing: "easeOutExpo",
    offset: '-=200',
    duration: 600
  });
</script>
</html>