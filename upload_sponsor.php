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

$name   = addslashes($_POST['name']); 
$email   = addslashes($_POST['email']);
$subject   = addslashes($_POST['subject']); 
$message = addslashes($_POST['message']);


	$sql = "INSERT INTO sym_sponsor (name, email, subject, message)
		VALUES ('$name', '$email', '$subject', '$message')";


  if (mysqli_query($conn, $sql)) {
    echo '<script language="javascript"> 
    alert("Thank you so much for being willing to help us. We will contact you soon."); 
    window.location.replace("http://btbatw.org/2016/#sponsors"); 
    </script>';
  } else {
    echo '<script language="javascript"> 
    alert("Error: We are very sorry that we cannot process your message. Please contact us, "btba.tw@gmail.com"."); 
    window.location.replace("http://btbatw.org/2016/#sponsors"); 
    </script>';
  }


mysqli_close($conn);
?>
