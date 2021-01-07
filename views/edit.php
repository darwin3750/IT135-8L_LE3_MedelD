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
  <link rel="stylesheet" href="../assets/styles/styles.css">
</head>

<body class="theme1">
  <section id="topbar" class="le3-bg-main d-block w-100 fixed-top">
    <section class="container d-flex flex-column flex-md-row justify-content-between align-items-center p-3">
      <h2 class="le3-bold le3-color-contrast">Home Page</h2>
      <div class="d-flex flex-column flex-sm-row align-items-center justify-content-center">
        <p class="m-3 text-nowrap">Hello, <?php print "$user" ?>!</p>
        <a href="../scripts/logout.php" class="btn w-md-auto  d-block btn-lg le3-btn-primary mr-sm-3">Click here to logout</a>
        <a href="home.php" class="btn w-md-auto w-100 d-block btn-lg le3-btn-primary mt-2 mt-sm-0">Return to Home page</a>
      </div>
    </section>
  </section>

  <section id="main" class="container">
    <h2 align="center">Currently Selected</h2>
    <table border="1px" width="100%">
      <tr>
        <th>Id</th>
        <th>Details</th>
        <th>Post Time</th>
        <th>Edit Time</th>
        <th>Public Post</th>
      </tr>
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
        print '<form action="edit.php" method="POST">
            Update List: <br/>
            Details: <input type="text" name="details" value="' . $details . '"/><br/>';
        if ($public == "yes") {
          print 'Public Post? <input type="checkbox" name="public[]" checked/><br/>';
        } else {
          print 'Public Post? <input type="checkbox" name="public[]"/><br/>';
        }
        print '<input type="submit" value="Update List"/></form>';
      } else {
        print '<h2 align="center">There is no data to be edited.</h2>';
      }
      ?>
  </section>
</body>

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