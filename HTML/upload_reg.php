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

$firstname  = addslashes($_POST['firstname']);
$lastname  = addslashes($_POST['lastname']);
$email        = addslashes($_POST['email']);
$event_code = $_POST['event_code'];
$org        = addslashes($_POST['org']);
$pos_other  = addslashes($_POST['pos_other']);

// Check the uniqueness of event_code
$query = "SELECT * FROM sym_registrant WHERE event_code='$event_code'";
$result = mysqli_query($conn, $query);    

if (mysqli_num_rows($result) > 0) {
  // Error message
  echo '<script language="javascript"> 
	  alert("ERROR: The EventBrite order number has been used! Please try again or contact us."); 
  window.location.replace("http://btbatw.org/2015/#register"); 
  </script>';
} else {

	$sql = "INSERT INTO sym_registrant (firstname, lastname, email, event_code, org, org_type, position, pos_other, diet)
		VALUES ('$firstname', '$lastname', '$email', '$event_code', '$org', '$_POST[org_type]', '$_POST[position]', '$pos_other', '$_POST[diet]')";


  if (mysqli_query($conn, $sql)) {
    echo '<script language="javascript"> 
    alert("Thank you so much for the registration. Please submit your abstract and C.V. if you are interested in giving a presentation and joining the career fair."); 
    window.location.replace("http://btbatw.org/2015/#register"); 
    </script>';
  } else {
    echo '<script language="javascript"> 
    alert("Error: We cannot process your registraction. Please contact us."); 
    window.location.replace("http://btbatw.org/2015/#register"); 
    </script>';
  }

}

mysqli_close($conn);
?>
