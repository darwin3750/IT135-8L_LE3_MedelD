<html>

<head>
  <title>My Food Delivery Store</title>
</head>
<?php
session_start(); //starts the session
if ($_SESSION['user']) { //checks if user is logged in
} else {
  //header("location:index.php"); // redirects if user is not logged in
}
$user = $_SESSION['user']; //assigns user value
?>

<body>
  <h2>Home Page</h2>
  <p>Hello <?php print "$user" ?>!</p>
  <!--Displays user's name-->
  <a href="logout.php">Click here to logout</a><br /><br />
  <form action="add.php" method="POST">
    Add more to list: <br />
    Details: <input type="text" name="details" /><br />
    Public Post? <input type="checkbox" name="public[]" value="yes" /><br />
    <input type="submit" value="Add to list" />
  </form>
  <h2 align="center">My list</h2>
  <table border="1px" width="100%">
    <tr>
      <th>Id</th>
      <th>Details</th>
      <th>Post Time</th>
      <th>Edit Time</th>
      <th>Edit</th>
      <th>Delete</th>
      <th>Public Post</th>
    </tr>
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
  <script>
    function myFunction(id) {
      var r = confirm("Are you sure you want to delete this record?");
      if (r == true) {
        window.location.assign("delete.php?id=" + id);
      }
    }
  </script>
</body>

</html>