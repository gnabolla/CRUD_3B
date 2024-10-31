
<?php 
include 'db_connect.php'; 
$id = $_POST['id']; 
$firstname = $_POST['firstname']; 
$lastname = $_POST['lastname']; 
$email = $_POST['email']; 

$sql = "UPDATE users SET firstname='$firstname', lastname='$lastname', email='$email' WHERE id=$id"; 

if ($conn->query($sql) === TRUE) { 
    header("location: /");
} else { 
    echo "Error updating record: " . $conn->error; 
} 
$conn->close(); 
?>
