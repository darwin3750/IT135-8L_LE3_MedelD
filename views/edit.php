<?php
session_start(); //starts the session
if (!$_SESSION['user']) { //checks if user is not logged in
  header("location: ../index.php "); // redirects if user is not logged in
}
$user = $_SESSION['user']; //assigns user value
$id_exists = false;
?>

<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Food Delivery Store</title>
  <!-- link CSS -->
  <link rel="stylesheet" href="../assets/styles/styles.css">
</head>

<body class="theme1">
  <!-- top part containing utilities for quick access -->
  <section id="topbar" class="le3-bg-main d-block w-100 fixed-top le3-bg-contrast">
    <section class="container d-flex flex-column flex-md-row justify-content-between align-items-center p-3">
      <h2 class="le3-bold le3-color-base">Home Page</h2>
      <div class="d-flex flex-column flex-sm-row align-items-center justify-content-center le3-color-base w-md-fit-content w-100">
        <p class="m-3 text-nowrap">Hello, <?php print "$user" ?>!</p>
        <a href="../scripts/logout.php" class="btn w-md-fit-content w-100 d-block btn-lg le3-btn-primary mr-sm-3">Click here to logout</a>
        <a href="home.php" class="btn w-md-fit-content w-100 d-block btn-lg le3-btn-primary mt-2 mt-sm-0">Return to Home page</a>
      </div>
    </section>
  </section>

  <section id="main" class="container pt-3">
    <h2 class="le3-semibold">Currently Selected</h2>
    <table class="table table-hover">
      <thead class="le3-table-head text-center">
        <tr>
          <th>Id</th>
          <th>Details</th>
          <th>Post Time</th>
          <th>Edit Time</th>
          <th>Public Post</th>
        </tr>
      </thead>
      <?php
      if (!empty($_GET['id'])) {
        $id = $_GET['id'];
        $_SESSION['id'] = $id;
        $id_exists = true;
        $con = mysqli_connect("localhost", "root", "", "deliverydb") or die(mysqli_connect_error()); //Connect to server
        $sql = "Select * from list Where id='$id'";
        $query = mysqli_query($con, $sql); // SQL Query
        $count = mysqli_num_rows($query);
        if ($count > 0) {
          while ($row = mysqli_fetch_array($query)) {
            print "<tr>";
            print '<td align="center">' . $row['id'] . "</td>";
            print '<td align="center">' . $row['details'] . "</td>";
            print '<td align="center">' . $row['date_posted'] . " - " . $row['time_posted'] . "</td>";
            print '<td align="center">' . $row['date_edited'] . " - " . $row['time_edited'] . "</td>";
            print '<td align="center">' . $row['public'] . "</td>";
            print "</tr></table><br/>";
            $details = $row['details'];
            $public = $row['public'];
          }
        } else {
          $id_exists = false;
        }
      }
      if ($id_exists) {
        print '<form action="edit.php" method="POST" class="p-4 le3-border-contrast-2 rounded shadow">
            <h3 class="le3-semibold">Update List</h3>
            <div class="form-group">
              <label for="details" class="le3-regular">Details:</label>
              <input id="details" type="text" name="details" class="form-control" value="' . $details . '" />
            </div>';
        if ($public == "yes") {
          print '
          <div class="form-check mb-2">
            <input id="public_checkbox" type="checkbox" name="public[]" class="form-check-input" checked/>
            <label for="public_checkbox" class="le3-regular form-check-label">Public Post?</label>
          </div>';
        } else {
          print '
          <div class="form-check mb-2">
            <input id="public_checkbox" type="checkbox" name="public[]" class="form-check-input"/>
            <label for="public_checkbox" class="le3-regular form-check-label">Public Post?</label>
          </div>';
        }
        print '
          <input type="submit" value="Update List" class="btn btn-block le3-btn-primary btn-lg" />
        </form>';
      } else { //error message in case the user gets here by accident
        print '<h2 class="text-center text-danger">There is no data to be edited.</h2>';
      }
      ?>
      <p class="text-center">IT135-8L_LE3_MedelD</p>
  </section>
</body>

<style>
  td {
    word-wrap: break-word;
    max-width: 160px;
  }
</style>

<script>
  window.onload = () => {
    document.querySelector("#main").style.marginTop = document.querySelector("#topbar").offsetHeight;
  }
  window.onresize = () => {
    document.querySelector("#main").style.marginTop = document.querySelector("#topbar").offsetHeight;
  }
</script>

</html>
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $con = mysqli_connect("localhost", "root", "", "deliverydb") or die(mysqli_connect_error()); //Connect to server
  $details = ($_POST['details']);
  $public = "no";
  $id = $_SESSION['id'];
  $time = strftime("%X"); //time
  $date = strftime("%B %d, %Y"); //date
  foreach ($_POST['public'] as $list) {
    if ($list != null) {
      $public = "yes";
    }
  }
  foreach ($_POST['sale'] as $list) {
    if ($list != null) {
      $sale = "yes";
    }
  }
  mysqli_query($con, "UPDATE list SET details='$details', public='$public', date_edited='$date',
time_edited='$time' WHERE id='$id'");
  header("location: home.php");
}
?>