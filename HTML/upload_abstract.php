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

$email    = addslashes($_POST['email']);
$research = $_POST['research'];
$field    = $_POST['field'];
$talk     = $_POST['talk'];

if((!empty($_FILES["abstract"])) && ($_FILES['abstract']['error'] == 0)) {
	$filename = basename($_FILES['abstract']['name']);
	$newname = 'abstracts/' . $title . '.' . $filename;
	$ext = pathinfo($filename, PATHINFO_EXTENSION);
	if($ext !== 'pdf') {
                echo '<script language="javascript">
                alert("Error: Please upload a PDF file.");
                window.location.replace("http://btbatw.org/2025/#abstract");
                </script>';
        } else {
                if ((move_uploaded_file($_FILES['abstract']['tmp_name'],$newname))) {
                        $sql = "INSERT INTO sym_abstract (email, research, field, talk, filename) VALUES ('$email', '$research', '$field', '$talk', '$newname')";
	
                        if (mysqli_query($conn, $sql)) {
                                echo '<script language="javascript"> 
                                alert("Thank you so much for submitting the abstract."); 
                                window.location.replace("http://btbatw.org/2025/"); 
                                </script>';
                        } else {
                                echo '<script language="javascript"> 
                                alert("Error: We cannot process your abstract submission. Please contact us."); 
                                window.location.replace("http://btbatw.org/2025/#abstract"); 
                                </script>';
                        }
                }
        }
}

mysqli_close($conn);
?>
