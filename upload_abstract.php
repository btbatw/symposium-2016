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

$email    = addslashes($_POST['email']);
$title    = addslashes($_POST['title']);
$field    = $_POST['field'];
$talk     = $_POST['talk'];
$name     = addslashes($_POST['name']);
$aff      = addslashes($_POST['aff']);

if((!empty($_FILES['abstract'])) && ($_FILES['abstract']['error'] == 0)) {
	$filename = basename($_FILES['abstract']['name']);
	$newname = 'abstracts/' . $title . '.' . $filename;
	$ext = pathinfo($filename, PATHINFO_EXTENSION);
	if($ext !== 'pdf') {
                echo '<script language="javascript">
                alert("Error: Please upload a PDF file.");
                window.location.replace("http://btbatw.org/2016/#abstract");
                </script>';
        } else {
                if ((move_uploaded_file($_FILES['abstract']['tmp_name'],$newname))) {
                        $sql = "INSERT INTO abstracts (email, title, field, talk, filename, name, aff) VALUES ('$email', '$title', '$field', '$talk', '$newname', '$name', '$aff')";
	
                        if (mysqli_query($conn, $sql)) {
                                echo '<script language="javascript"> 
                                alert("Thank you so much for submitting the abstract."); 
                                window.location.replace("http://btbatw.org/2016/"); 
                                </script>';
                        } else {
                                echo '<script language="javascript"> 
                                alert("Error: We cannot process your abstract submission. Please contact us."); 
                                window.location.replace("http://btbatw.org/2016/#abstract"); 
                                </script>';
                        }
                }
        }
} else {
        echo '<script language="javascript"> 
        alert("Error: We cannot upload your abstract. Please contact us."); 
        window.location.replace("http://btbatw.org/2016/#abstract"); 
        </script>';
}

mysqli_close($conn);
?>
