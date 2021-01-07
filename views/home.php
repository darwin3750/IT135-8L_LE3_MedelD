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
  <section id="topbar" class="le3-bg-main d-block w-100 fixed-top">
    <section class="container d-flex flex-column flex-md-row justify-content-between align-items-center p-3">
      <h2 class="le3-bold le3-color-contrast">Home Page</h2>
      <div class="d-flex flex-column flex-sm-row align-items-center justify-content-center">
        <p class="m-3">Hello, <?php print "$user" ?>!</p>
        <a href="../scripts/logout.php" class="btn btn-lg le3-btn-primary">Click here to logout</a>
      </div>
    </section>
  </section>
  <section id="main" class="container">
    <div class="d-flex justify-content-between pt-3">
      <h2 class="le3-semibold">My list</h2>
      <button onclick="revealAdd()" class="btn le3-btn-outline-primary le3-hill pr-4 pl-4"><b>Add an Entry</b></button>
    </div>
    <table class="table table-bordered">
      <thead>
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
    </table>
  </section>
  <br /><br /><br />
  <br /><br /><br />
  <br /><br /><br />
  <br /><br /><br />
  <br /><br /><br />
  <br /><br /><br />
  <br /><br /><br />
  <section id="bottombar" class="fixed-bottom">
    <section class="w-100 d-flex justify-content-end">
      <button onclick="hideAdd()" class="btn le3-hill le3-btn-primary pr-5 pl-5 mr-1">
        <img src="../assets/chevron-down.svg" width="25" height="25" />
      </button>
    </section>
    <section class="le3-bg-main">
      <div class="container p-3">
        <form action="../scripts/add.php" method="POST">
          Add more to list: <br />
          Details: <input type="text" name="details" /><br />
          Public Post? <input type="checkbox" name="public[]" value="yes" /><br />
          <input type="submit" value="Add to list" />
        </form>
      </div>
    </section>
  </section>
</body>

<style>
  #bottombar {
    transform: translateY(100%);
  }
</style>

<script>
  window.onload = () => {
    document.querySelector("#main").style.marginTop = document.querySelector("#topbar").offsetHeight;
  }
  window.onresize = () => {
    document.querySelector("#main").style.marginTop = document.querySelector("#topbar").offsetHeight;
  }

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