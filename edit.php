
<?php 
include 'db_connect.php'; 
$id = $_GET['id']; 
$sql = "SELECT * FROM users WHERE id=$id"; 
$result = $conn->query($sql); 
$row = $result->fetch_assoc(); 
?> 
<!DOCTYPE html> 
<html> 
<head> 
    <title>Edit User</title> 
</head> 
<body> 
<h1>Edit User</h1>
<a href="index.php">View Users</a>  
<form action="update.php" method="post"> 
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>"> 
    First Name: <input type="text" name="firstname" value="<?php echo $row['firstname']; ?>" required><br><br> 
    Last Name: <input type="text" name="lastname" value="<?php echo $row['lastname']; ?>" required><br><br> 
    Email: <input type="email" name="email" value="<?php echo $row['email']; ?>"><br><br> 
    <input type="submit" value="Update User"> 
</form> 
</body> 
</html>
