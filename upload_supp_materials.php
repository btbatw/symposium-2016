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

// Check the uniqueness of event_code
$query = "SELECT * FROM sym_entrepr WHERE sym_entrepr_teamname='$teamname' AND sym_entrepr_email='$email'";
$result = mysqli_query($conn, $query);    
if (mysqli_num_rows($result) == 0) {
  // Error message
  echo '<script language="javascript"> 
  alert("Sorry, we can not verify your registration. Please make sure the same team name and email that you used for your registration."); 
  window.location.replace("http://btbatw.org/2025/#register");
  </script>';
} else {
  // Upload CV
  if((!empty($_FILES["materials"])) && ($_FILES['materials']['error'] == 0)) {
    $filename = basename($_FILES['materials']['name']);
    $newname = 'materials/' . $teamname . '.' . $filename;

    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    if($ext !== 'pdf') {
      echo '<script language="javascript"> 
      alert("Error: Please upload a PDF file."); 
      window.location.replace("http://btbatw.org/2015/#register"); 
      </script>';
    } else {
      if ((move_uploaded_file($_FILES['materials']['tmp_name'],$newname))) {
	$sql = "UPDATE sym_entrepr SET ".
               "materials = '$newname', ".
               "WHERE sym_entrepr_teamname='$teamname' AND sym_entrepr_email='$email'";
  
        if (mysqli_query($conn, $sql)) {
          echo '<script language="javascript"> 
          alert("Thank you so much for submitting Supporting Materials."); 
          window.location.replace("http://btbatw.org/2025/#register"); 
          </script>';
        } else {
          echo '<script language="javascript"> 
          alert("Error: We cannot process your Supporting Materials. Please contact us."); 
          window.location.replace("http://btbatw.org/2025/#register"); 
          </script>';
        }
      } else {
        echo '<script language="javascript"> 
        alert("Error: We cannot upload your Supporting Materials. Please contact us."); 
        window.location.replace("http://btbatw.org/2025/#register"); 
        </script>';
      }
    }
  }
}

mysqli_close($conn);
?>
