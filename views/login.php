<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Food Delivery Store</title>
  <!-- link CSS and animation API library -->
  <link rel="stylesheet" href="../assets/styles/styles.css">
  <script src="../anime.min.js"></script> 
</head>

<body class="h-100 theme1">
  <!-- login form in a card -->
  <div class="d-sm-flex align-items-center justify-content-center h-100">
    <section class="overflow-hidden container p-0">
      <div class="le3-bg-contrast rounded-top p-3 position-relative le3-border-contrast-2" style="z-index: 999;">
        <h2 class="le3-semibold text-center le3-color-base">Login Page</h2>
      </div>
      <div class="card rounded-top-0 le3-border-contrast-2 h-sm-auto h-100 p-0 le3-animate-slidedown">
        <section class="row p-4">
          <section class="col-md-5 d-flex align-items-center justify-content-center p-5">
            <img src="../assets/join.svg" height="auto" width="300px" />
          </section>
          <section class="col-md-7 mt-auto mb-auto">
            <form class="overflow-hidden" action="../scripts/checklogin.php" method="POST">
              <div class="form-group">
                <label for="username" class="le3-animate-slidein">Username:</label>
                <input id="username" type="text" name="username" class="form-control le3-animate-slidein" required="required" />
              </div>
              <div class="form-group">
                <label for="password" class="le3-animate-slidein">Password:</label>
                <input id="password" type="password" name="password" class="form-control le3-animate-slidein" required="required" />
              </div>
              <input type="submit" value="Login" class="btn le3-btn-primary btn-lg btn-block mb-2 le3-animate-slidein" />
              <a class="le3-animate-slidein d-block" href="register.php">Don't have an Account? Register here!</a>
            </form>
            <p class="text-center">IT135-8L_LE3_MedelD</p>
          </section>
        </section>
      </div>
    </section>
  </div>
</body>

<!-- animate content on load -->
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