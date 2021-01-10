<?php
session_start(); //starts the session
if(isset($_SESSION['user'])) { //checks if user is logged in
  header("location: views/home.php"); // redirects if user is logged in
}
?>

<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Food Delivery Store</title>
  <!-- link CSS and animation API library -->
  <link rel="stylesheet" href="assets/styles/styles.css">
  <script src="anime.min.js"></script>
</head>
<body class="h-100 theme1">
  <section class="text-center d-flex flex-column justify-content-between align-items-center h-100">
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 220" style="margin-bottom:-220"><path fill="#1D3557" fill-opacity="1" d="M0,96L60,106.7C120,117,240,139,360,133.3C480,128,600,96,720,96C840,96,960,128,1080,138.7C1200,149,1320,139,1380,133.3L1440,128L1440,0L1380,0C1320,0,1200,0,1080,0C960,0,840,0,720,0C600,0,480,0,360,0C240,0,120,0,60,0L0,0Z"></path></svg>
  <div class="p-md-0 p-3 position-relative">
    <h1 class="le3-title mb-2 le3-animate-wavetext">My Food Delivery Store</h1>
    <hr class="p-1 le3-bg-contrast rounded le3-animate-slidescale">
    <h2 class="le3-bold mb-3 mt-4 le3-animate-fadein">To begin using our services, <a href="views/register.php">register</a> to our site.</h2>
    <h4 class="le3-semibold le3-animate-fadein">Already have an account? <a href="views/login.php">Sign in</a>.</h4>
  </div>
  <p>IT135-8L_LE3_MedelD</p>
  </section>
</body>
<script defer>

    //put every letter in the text on a separate tag
    const textWrapper = document.querySelector('.le3-animate-wavetext');
    const textRetain = textWrapper.innerHTML;
    textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, 
        "<div class='le3-animate-wavetext-letter-container'><span class='le3-animate-wavetext-letter'>$&</span></div>");

    //animate texts
    anime.timeline({ loop: false }).add({
      targets: '.le3-animate-wavetext-letter',
      translateY: [-100, 0],
      easing: "easeOutExpo",
      delay: (el, i) => i * 30,
      duration: 800,
      offset: 600,
      complete: function() {
        document.querySelector('.le3-animate-wavetext').innerHTML = "<div class='d-inline-block overflow-hidden'>" + textRetain + "</div>";
      }
    }).add({
      targets: '.le3-animate-slidescale',
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
      duration: 600,
    })
</script>
</html>