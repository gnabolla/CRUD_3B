
<?php 
include 'db_connect.php'; 
$firstname = $_POST['firstname']; 
$lastname = $_POST['lastname']; 
$email = $_POST['email']; 

$sql = "INSERT INTO users (firstname, lastname, email) VALUES ('$firstname', '$lastname', '$email')"; 

if ($conn->query($sql) === TRUE) { 
    header("location: /");
} else { 
    echo "Error: " . $sql . "<br>" . $conn->error; 
} 
$conn->close(); 
?>
