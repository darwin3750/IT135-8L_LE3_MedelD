<?php
  //destroy session and redirect to landing page
  session_start();
  session_destroy();
  header("location: ../index.php");

?>