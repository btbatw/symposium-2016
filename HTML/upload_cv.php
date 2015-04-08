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
$event_code = $_POST['event_code'];

// Check the uniqueness of event_code
$query = "SELECT * FROM sym_registrant WHERE event_code='$event_code' AND email='$email'";
$result = mysqli_query($conn, $query);    
if (mysqli_num_rows($result) == 0) {
  // Error message
  echo '<script language="javascript"> 
  alert("Sorry, we can not verify your registration. Please make sure the same order # and email that you used for your registration."); 
  window.location.replace("http://btbatw.org/2015/#register");
  </script>';
} else {
  // Upload CV
  if((!empty($_FILES["cv"])) && ($_FILES['cv']['error'] == 0)) {
    $filename = basename($_FILES['cv']['name']);
    $newname = 'cv/' . $event_code . '.' . $filename;

    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    if($ext !== 'pdf') {
      echo '<script language="javascript"> 
      alert("Error: Please upload a PDF file."); 
      window.location.replace("http://btbatw.org/2015/#register"); 
      </script>';
    } else {
      if ((move_uploaded_file($_FILES['cv']['tmp_name'],$newname))) {
	$sql = "UPDATE sym_registrant SET ".
               "cv = '$newname', ".
	       "com1_prefer = '$_POST[com1_prefer]', ".
	       "com2_prefer = '$_POST[com2_prefer]', ".
	       "com3_prefer = '$_POST[com3_prefer]', ".
	       "com4_prefer = '$_POST[com4_prefer]', ".
	       "com5_prefer = '$_POST[com5_prefer]', ".
               "com6_prefer = '$_POST[com6_prefer]' ".
               "WHERE event_code = '$event_code' AND email = '$email'";
  
        if (mysqli_query($conn, $sql)) {
          echo '<script language="javascript"> 
          alert("Thank you so much for submitting the C.V."); 
          window.location.replace("http://btbatw.org/2015/#register"); 
          </script>';
        } else {
          echo '<script language="javascript"> 
          alert("Error: We cannot process your abstract submission. Please contact us."); 
          window.location.replace("http://btbatw.org/2015/#register"); 
          </script>';
        }
      } else {
        echo '<script language="javascript"> 
        alert("Error: We cannot upload your C.V. Please contact us."); 
        window.location.replace("http://btbatw.org/2015/#register"); 
        </script>';
      }
    }
  }
}

mysqli_close($conn);
?>
