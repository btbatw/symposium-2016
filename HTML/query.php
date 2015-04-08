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

  while($row = mysqli_fetch_assoc($result)){
    echo "<b>EventBrite order #: </b>" . $row['event_code'] . "<br>";
    echo "<b>Firstname: </b>" . $row['firstname'] . "<br>";
    echo "<b>Lastname: </b>" . $row['lastname'] . "<br>";
    echo "<b>Email: </b>" . $row['email'] . "<br>";
    echo "<br><br><b>ABSTRACT</b><br>";
    echo "<b>Authors:Name; Affiliations</b><br>";
    echo "1st author: " . $row['author1_name'] . "; " . $row['author1_aff1']. "; " . $row['author1_aff2']. "; " . $row['author1_aff3']. "; " . $row['author1_aff4'] . "<br>";
    echo "2nd author: " . $row['author2_name'] . "; " . $row['author2_aff1']. "; " . $row['author2_aff2']. "; " . $row['author2_aff3']. "; " . $row['author2_aff4'] . "<br>";
    echo "3rd author: " . $row['author3_name'] . "; " . $row['author3_aff1']. "; " . $row['author3_aff2']. "; " . $row['author3_aff3']. "; " . $row['author3_aff4'] . "<br>";
    echo "4th author: " . $row['author4_name'] . "; " . $row['author4_aff1']. "; " . $row['author4_aff2']. "; " . $row['author4_aff3']. "; " . $row['author4_aff4'] . "<br>";
    echo "5th author: " . $row['author5_name'] . "; " . $row['author5_aff1']. "; " . $row['author5_aff2']. "; " . $row['author5_aff3']. "; " . $row['author5_aff4'] . "<br>";
    echo "6th author: " . $row['author6_name'] . "; " . $row['author6_aff1']. "; " . $row['author6_aff2']. "; " . $row['author6_aff3']. "; " . $row['author6_aff4'] . "<br>";
    echo "<b>Affiliations:</b><br>";
    echo "1st affiliation: " . $row['aff1_name'] . ", " . $row['aff1_addr'] . "<br>";
    echo "2nd affiliation: " . $row['aff2_name'] . ", " . $row['aff2_addr'] . "<br>";
    echo "3rd affiliation: " . $row['aff3_name'] . ", " . $row['aff3_addr'] . "<br>";
    echo "4th affiliation: " . $row['aff4_name'] . ", " . $row['aff4_addr'] . "<br>";
    echo "<b>Content:</b>(New lines may not be shown properly.)<br>";
    echo $row['content'] . "</p><br>";
    echo "<br><b>CAREER FAIR:</b><br>Your preference<br>";
    echo $row['com1_prefer'] . "  Taiwan Liposome Company (TLC)" . "<br>";
    echo $row['com2_prefer'] . "  PharmaEssentia Corporation" . "<br>";
    echo $row['com3_prefer'] . "  Simpson Biotech Co., Ltd." . "<br>";
    echo $row['com4_prefer'] . "  CHO Pharma" . "<br>";
    echo $row['com5_prefer'] . "  Diamond Biofund/ Fountain Biopharma" . "<br>";
    echo $row['com6_prefer'] . "  TaiRx (tentative)" . "<br>";
  }
}

mysqli_close($conn);

echo '<br><br><a href="http://btbatw.org/2015/#register">Back to 2015 BTBA symposium!</a>';
?>
