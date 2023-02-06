
<?php
$servername = "localhost";
$database = "edoictas_IctaHelpdesk";
$username = "edoictas";
$password = "u2MhO3zN1;O";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully";
?>
