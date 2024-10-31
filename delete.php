
<?php 
include 'db_connect.php'; 
$id = $_GET['id']; 

$sql = "DELETE FROM users WHERE id=$id"; 

if ($conn->query($sql) === TRUE) { 
    echo "Record deleted successfully. <a href='index.php'>View Users</a>"; 
} else { 
    echo "Error deleting record: " . $conn->error; 
} 
$conn->close(); 
?>
