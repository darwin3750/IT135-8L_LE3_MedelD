<?php
session_start(); //starts the session
if (!$_SESSION['user']) { //checks if user is not logged in
  header("location: ../index.php"); // redirects if user is not logged in
}
$user = $_SESSION['user']; //assigns user value
?>

<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Food Delivery Store</title>
  <link rel="stylesheet" href="../assets/styles/styles.css">
  <script src="../javascript/anime.min.js"></script>
</head>

<body class="theme1">
  <section id="topbar" class="le3-bg-contrast d-block w-100 fixed-top">
    <section class="container d-flex flex-column flex-md-row justify-content-between align-items-center p-3">
      <h2 class="le3-bold le3-color-base">Home Page</h2>
      <div class="d-flex flex-column flex-sm-row align-items-center justify-content-center le3-color-base w-md-fit-content w-100">
        <p class="m-3">Hello, <?php print "$user" ?>!</p>
        <a href="../scripts/logout.php" class="btn btn-lg le3-btn-primary w-md-fit-content w-100">Click here to logout</a>
      </div>
    </section>
  </section>
  <section id="main" class="container le3-animate-slidefadein">
    <div class="d-flex justify-content-between pt-3">
      <h2 class="le3-semibold">My list</h2>
      <button onclick="revealAdd()" class="btn le3-btn-outline-primary le3-hill pr-4 pl-4"><b>Add an Entry</b></button>
    </div>
    <table class="table table-hover le3-table">
      <thead class="le3-table-head text-center">
        <tr>
          <th>Id</th>
          <th>Details</th>
          <th>Post Time</th>
          <th>Edit Time</th>
          <th>Edit</th>
          <th>Delete</th>
          <th>Public Post</th>
        </tr>
      </thead>
        <tbody>
          <?php
          $con = mysqli_connect("localhost", "root", "", "deliverydb") or die(mysqli_connect_error()); //Connect to server
          $query = mysqli_query($con, "Select * from list"); // SQL Query
          while ($row = mysqli_fetch_array($query)) {
            print "<tr>";
            print '<td align="center">' . $row['id'] . "</td>";
            print '<td align="center">' . $row['details'] . "</td>";
            print '<td align="center">' . $row['date_posted'] . " - " . $row['time_posted'] . "</td>";
            print '<td align="center">' . $row['date_edited'] . " - " . $row['time_edited'] . "</td>";
            print '<td align="center"><a href="edit.php?id=' . $row['id'] . '">edit</a> </td>';
            print '<td align="center"><a href="#" onclick="myFunction(' . $row['id'] . ')">delete</a> </td>';
            print '<td align="center">' . $row['public'] . "</td>";
            print "</tr>";
          }
          ?>
        </tbody>
    </table>
    <p class="text-center">IT135-8L_LE3_MedelD</p>
  </section>
  <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
  <section id="bottombar" class="fixed-bottom">
    <section class="w-100 d-flex justify-content-end">
      <button onclick="hideAdd()" class="btn le3-hill le3-btn-primary pr-5 pl-5 mr-1">
        <img src="../assets/chevron-down.svg" width="25" height="25" />
      </button>
    </section>
    <section class="le3-bg-contrast">
      <div class="container p-3">
        <form action="../scripts/add.php" method="POST">
          <h3 class="le3-semibold le3-color-base underline">Add more to list</h3>
          <div class="form-group">
            <label for="details" class="le3-regular le3-color-base">Details:</label>
            <input id="details" type="text" name="details" class="form-control" />
          </div>
          <div class="form-check mb-2">
            <input id="public_checkbox" type="checkbox" name="public[]" value="yes" class="form-check-input" />
            <label for="public_checkbox" class="le3-regular le3-color-base form-check-label">Public Post?</label>
          </div>
          <input type="submit" value="Add to list" class="btn btn-block le3-btn-primary btn-lg" />
        </form>
      </div>
    </section>
  </section>
</body>

<style>
  #bottombar {
    transform: translateY(100%);
  }
  .le3-animate-slidefadein{
    opacity: 0;
  }
</style>

<script>
  window.onload = () => {
    document.querySelector("#main").style.marginTop = document.querySelector("#topbar").offsetHeight;
  }
  window.onresize = () => {
    document.querySelector("#main").style.marginTop = document.querySelector("#topbar").offsetHeight;
  }

  anime({
    targets: '.le3-animate-slidefadein',
    opacity: [0,1],
    translateY: ['3rem', 0],
    easing: "easeOutExpo",
    duration: 3000,
    offset: 600,
  })

  function revealAdd() {
    anime({
      targets: '#bottombar',
      translateY: ['100%', 0],
      easing: "easeOutExpo"
    });
  }

  function hideAdd() {
    anime({
      targets: '#bottombar',
      translateY: [0, '100%'],
      easing: "easeOutExpo"
    });
  }

  function myFunction(id) {
    var r = confirm("Are you sure you want to delete this record?");
    if (r == true) {
      window.location.assign("../scripts/delete.php?id=" + id);
    }
  }
</script>

</html>