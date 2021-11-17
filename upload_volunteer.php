<?php
$servername = "btbatworg.ipagemysql.com";
$username = "btbatw";
$password = "btbatw123";
$dbname = "btba";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$email      = addslashes($_POST['email']);

$sql = "INSERT INTO sym_volunteer (email) VALUES ('$email')";
if (mysqli_query($conn, $sql)) {
  echo '<script language="javascript"> 
  alert("Thank you so much for being willing to help us! We will contact you."); 
  window.location.replace("http://btbatw.org/2015/"); 
  </script>';
}

mysqli_close($conn);
?>
