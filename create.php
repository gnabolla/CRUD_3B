
<!DOCTYPE html> 
<html> 
<head> 
    <title>Add New User</title> 
</head> 
<body> 
<h1>Add New User</h1>
<a href="index.php">View Users</a> 
<form action="insert.php" method="post"> 
    First Name: <input type="text" name="firstname" required><br><br> 
    Last Name: <input type="text" name="lastname" required><br><br> 
    Email: <input type="email" name="email"><br><br> 
    <input type="submit" value="Add User"> 
</form> 
</body> 
</html>
