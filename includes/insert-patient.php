<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
require('db_connect.php');
$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);
 
// Check connection
if($mysqli === false){
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}
 
// Escape user inputs for security
$first_name = $mysqli->real_escape_string($_REQUEST['first_name']);
$last_name = $mysqli->real_escape_string($_REQUEST['last_name']);
$dob = $mysqli->real_escape_string($_REQUEST['dob']);
$blood_group = $mysqli->real_escape_string($_REQUEST['blood_group']);
$address = $mysqli->real_escape_string($_REQUEST['address']);
$phone = $mysqli->real_escape_string($_REQUEST['phone']);
$email = $mysqli->real_escape_string($_REQUEST['email']);



// Attempt insert query execution
$sql = "INSERT INTO patient (first_name, last_name, address, phone, email, dob, blood_group) VALUES (AES_ENCRYPT ('$first_name','$SECRET'), AES_ENCRYPT('$last_name','$SECRET'), AES_ENCRYPT('$address','$SECRET'), AES_ENCRYPT('$phone','$SECRET'), AES_ENCRYPT('$email','$SECRET'),  AES_ENCRYPT('$dob','$SECRET'), AES_ENCRYPT('$blood_group','$SECRET'))";
if($mysqli->query($sql) === true){
    echo "Records inserted successfully.";
	header('Location: ../medical/patient.php');
} else{
    echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
}
 
// Close connection
$mysqli->close();
?>