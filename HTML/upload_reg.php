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
$email        = htmlspecialchars($_POST['email']);
$members = htmlspecialchars($_POST['members']);
$innovation        = addslashes($_POST['innovation']);
$development        = addslashes($_POST['development']);
$market        = addslashes($_POST['market']);
$intellectual        = addslashes($_POST['intellectual']);
$background  = addslashes($_POST['background']);
$future  = addslashes($_POST['future']);

// Check the uniqueness of event_code
$query = "SELECT * FROM sym_entrepr WHERE sym_entrepr_teamname='$teamname'";
$result = mysqli_query($conn, $query);    

if (mysqli_num_rows($result) > 0) {
  // Error message
  echo '<script language="javascript"> 
	  alert("ERROR: The team name has been used! Please try again or contact us."); 
  window.location.replace("http://btbatw.org/2016/#register"); 
  </script>';
} else {

	if((!empty($_FILES["materials"])) && ($_FILES['materials']['error'] == 0)) {
		$filename = basename($_FILES['materials']['name']);
    $newname = 'materials/' . $teamname . '.' . $filename;

		if ((move_uploaded_file($_FILES['materials']['tmp_name'],$newname))) {
			$sql = "INSERT INTO sym_entrepr (sym_entrepr_id, sym_entrepr_teamname, sym_entrepr_email, sym_entrepr_members, sym_entrepr_innovation, sym_entrepr_development, sym_entrepr_market, sym_entrepr_intellectual, sym_entrepr_background, sym_entrepr_future, sym_entrepr_material)
			VALUES ('default', '$teamname', '$email', $members, '$innovation', '$development', '$market', '$intellectual', '$background', '$future', '$newname')";
			
			if (mysqli_query($conn, $sql)) {
				echo '<script language="javascript">
				alert("Thank you so much for the registration."); 
				window.location.replace("http://btbatw.org/2016/#register"); 
				</script>';
			} else {
				echo '<script language="javascript"> 
				alert("Error: We cannot process your registraction. Please contact us."); 
				window.location.replace("http://btbatw.org/2016/#register"); 
				</script>';
			}
		} else {
				echo '<script language="javascript"> 
				alert("Error: We cannot process your registraction. Please contact us."); 
				window.location.replace("http://btbatw.org/2016/#register"); 
				</script>';
		}
	} else {
				echo '<script language="javascript"> 
				alert("Error: Please upload supporting materials."); 
				window.location.replace("http://btbatw.org/2016/#register"); 
				</script>';	
	}
}

mysqli_close($conn);
?>
