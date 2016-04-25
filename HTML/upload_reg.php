<?php
$servername = "btbatworg.ipagemysql.com";
$username = "btbatworg";
$password = "BTBAtw123@";
$dbname = "btba2016";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$teamname  = addslashes($_POST['teamname']);
$email        = addslashes($_POST['email']);
$phone = $_POST['phone'];
$innovation        = addslashes($_POST['innovation']);
$development        = addslashes($_POST['development']);
$market        = addslashes($_POST['market']);
$intellectual        = addslashes($_POST['intellectual']);
$background  = addslashes($_POST['background']);
$future  = addslashes($_POST['future']);
$materials = $_POST['materials'];

// Check the uniqueness of event_code
$query = "SELECT * FROM sym_entrepr WHERE sym_entrepr_teamname='$teamname'";
$result = mysqli_query($conn, $query);    

if (mysqli_num_rows($result) > 0) {
  // Error message
  echo '<script language="javascript"> 
	  alert("ERROR: The team name has been used! Please try again or contact us."); 
  window.location.replace("http://btbatw.org/2025/#register"); 
  </script>';
} else {

	$sql = "INSERT INTO sym_entrepr (sym_entrepr_id, sym_entrepr_teamname, sym_entrepr_email, sym_entrepr_phone, sym_entrepr_innovation, sym_entrepr_development, sym_entrepr_market, sym_entrepr_intellectual, sym_entrepr_background, sym_entrepr_future, sym_entrepr_material)
		VALUES ('default', '$teamname', '$email', '$phone', '$innovation', '$development', '$market', '$intellectual', '$background', '$future', '$_POST[materials]')";


  if (mysqli_query($conn, $sql)) {
    echo '<script language="javascript"> 
    alert("Thank you so much for the registration."); 
    window.location.replace("http://btbatw.org/2025/#register"); 
    </script>';
  } else {
    echo '<script language="javascript"> 
    alert("Error: We cannot process your registraction. Please contact us."); 
    window.location.replace("http://btbatw.org/2016/#register"); 
    </script>';
  }

}

mysqli_close($conn);
?>
