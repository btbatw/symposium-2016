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

//$sqp = "UPDATE sym_registrant SET author1_name = 'Wan-Ping Lee', author2_name = '', author3_name = '', author4_name = '', author5_name = '', author6_name = '', aff1_name = 'Seven Bridges Genomics Inc., R&D', aff2_name = 'BC', aff3_name = '', aff4_name = '', aff1_addr = '', aff2_addr = '', aff3_addr = '', aff4_addr = '', content = 'ppp' WHERE event_code = '999999999' AND email = 'chunti.chen@bc.edu'";


$email      = addslashes($_POST['email']);
$event_code = $_POST['event_code'];
$content    = addslashes($_POST['content']);

$author1_name = addslashes($_POST['author1_name']);
$author2_name = addslashes($_POST['author2_name']);
$author3_name = addslashes($_POST['author3_name']);
$author4_name = addslashes($_POST['author4_name']);
$author5_name = addslashes($_POST['author5_name']);
$author6_name = addslashes($_POST['author6_name']);

$aff1_name = addslashes($_POST['aff1_name']);
$aff2_name = addslashes($_POST['aff2_name']);
$aff3_name = addslashes($_POST['aff3_name']);
$aff4_name = addslashes($_POST['aff4_name']);
$aff1_addr = addslashes($_POST['aff1_addr']);
$aff2_addr = addslashes($_POST['aff2_addr']);
$aff3_addr = addslashes($_POST['aff3_addr']);
$aff4_addr = addslashes($_POST['aff4_addr']);

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
	$sql = "UPDATE sym_registrant SET ".
               "research = '$research', ".
               "field = '$field', ".
	       "talk = '$talk', ".
               "author1_name = '$author1_name', ".
               "author2_name = '$author2_name', ".
               "author3_name = '$author3_name', ".
	       "author4_name = '$author4_name', ".
               "author5_name = '$author5_name', ".
	       "author6_name = '$author6_name', ".
	       "author1_aff1 = '$_POST[author1_aff1]', ".
               "author1_aff2 = '$_POST[author1_aff2]', ".
               "author1_aff3 = '$_POST[author1_aff3]', ".
	       "author1_aff4 = '$_POST[author1_aff4]', ".
	       "author2_aff1 = '$_POST[author2_aff1]', ".
               "author2_aff2 = '$_POST[author2_aff2]', ".
               "author2_aff3 = '$_POST[author2_aff3]', ".
	       "author2_aff4 = '$_POST[author2_aff4]', ".
	       "author3_aff1 = '$_POST[author3_aff1]', ".
               "author3_aff2 = '$_POST[author3_aff2]', ".
               "author3_aff3 = '$_POST[author3_aff3]', ".
	       "author3_aff4 = '$_POST[author3_aff4]', ".
	       "author4_aff1 = '$_POST[author4_aff1]', ".
               "author4_aff2 = '$_POST[author4_aff2]', ".
               "author4_aff3 = '$_POST[author4_aff3]', ".
	       "author4_aff4 = '$_POST[author4_aff4]', ".
	       "author5_aff1 = '$_POST[author5_aff1]', ".
               "author5_aff2 = '$_POST[author5_aff2]', ".
               "author5_aff3 = '$_POST[author5_aff3]', ".
	       "author5_aff4 = '$_POST[author5_aff4]', ".
	       "author6_aff1 = '$_POST[author6_aff1]', ".
               "author6_aff2 = '$_POST[author6_aff2]', ".
               "author6_aff3 = '$_POST[author6_aff3]', ".
               "author6_aff4 = '$_POST[author6_aff4]', ".
               "aff1_name = '$aff1_name', ".
               "aff2_name = '$aff2_name', ".
               "aff3_name = '$aff3_name', ".
               "aff4_name = '$aff4_name', ".
               "aff1_addr = '$aff1_addr', ".
               "aff2_addr = '$aff2_addr', ".
               "aff3_addr = '$aff3_addr', ".
	       "aff4_addr = '$aff4_addr', ".
               "content = '$content' ".
               "WHERE event_code = '$event_code' AND email = '$email'";

  
  if (mysqli_query($conn, $sql)) {
    echo '<script language="javascript"> 
    alert("Thank you so much for submitting the abstract."); 
    window.location.replace("http://btbatw.org/2015/"); 
    </script>';
  } else {
    echo '<script language="javascript"> 
    alert("Error: We cannot process your abstract submission. Please contact us."); 
    window.location.replace("http://btbatw.org/2015/#register"); 
    </script>';
  }
}

mysqli_close($conn);
?>
