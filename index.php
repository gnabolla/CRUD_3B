<?php
include 'db_connect.php';

$records_per_page = 10; // Number of records to display per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $records_per_page;

$search = isset($_GET['search']) ? $_GET['search'] : '';

if ($search) {
    $count_sql = "SELECT COUNT(id) FROM users
    WHERE firstname LIKE '%$search%' OR lastname LIKE
    '%$search%' OR email LIKE '%$search%'";
} else {
    $count_sql = "SELECT COUNT(id) FROM users";
}
$count_result = $conn->query($count_sql);
$count_row = $count_result->fetch_row();
$total_records = $count_row[0];
$total_pages = ceil($total_records / $records_per_page);

if ($search) {
    $sql = "SELECT id, firstname, lastname, email FROM users
WHERE firstname LIKE '%$search%' OR lastname LIKE '%$search%' OR
email LIKE '%$search%'
LIMIT $start, $records_per_page";
} else {
    $sql = "SELECT id, firstname, lastname, email FROM users
LIMIT $start, $records_per_page";
}
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Management</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f5f5f5;
            color: #333;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }

        h1 {
            color: #2c3e50;
            font-size: 24px;
        }

        .create-btn {
            background-color: #2ecc71;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .create-btn:hover {
            background-color: #27ae60;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: white;
        }

        th,
        td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        th {
            background-color: #f8f9fa;
            color: #2c3e50;
            font-weight: 600;
        }

        tr:hover {
            background-color: #f8f9fa;
        }

        .actions {
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 6px 12px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 14px;
            transition: opacity 0.3s;
        }

        .btn:hover {
            opacity: 0.9;
        }

        .btn-edit {
            background-color: #3498db;
            color: white;
        }

        .btn-delete {
            background-color: #e74c3c;
            color: white;
        }

        .empty-message {
            text-align: center;
            padding: 40px;
            color: #7f8c8d;
            font-style: italic;
        }

        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }

            th,
            td {
                padding: 10px;
            }

            .actions {
                flex-direction: column;
                gap: 5px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Users Management</h1>
            <a href="create.php" class="create-btn">
                <i class="fas fa-plus"></i> Add New User
            </a>
        </div>
        <form method="GET" action="index.php">
            <input type="text" name="search" placeholder="Search by name or email"
                required>
            <button type="submit">Search</button>
        </form>
        <?php 
        if($search){
            echo "<a href='/'>View Users</a>";
        }
        ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . htmlspecialchars($row["id"]) . "</td>
                                <td>" . htmlspecialchars($row["firstname"]) . "</td>
                                <td>" . htmlspecialchars($row["lastname"]) . "</td>
                                <td>" . htmlspecialchars($row["email"]) . "</td>
                                <td class='actions'>
                                    <a href='edit.php?id=" . htmlspecialchars($row["id"]) . "' class='btn btn-edit'>
                                        <i class='fas fa-edit'></i> Edit
                                    </a>
                                    <a href='delete.php?id=" . htmlspecialchars($row["id"]) . "' 
                                       onclick='return confirm(\"Are you sure you want to delete this user?\")' 
                                       class='btn btn-delete'>
                                        <i class='fas fa-trash'></i> Delete
                                    </a>
                                </td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' class='empty-message'>No users found in the database.</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
        <div>
            <?php
            for ($i = 1; $i <= $total_pages; $i++) {
                if ($search) {
                    echo "<a href='index.php?page=$i&search=$search'>$i</a> ";
                } else {
                    echo "<a href='index.php?page=$i'>$i</a> ";
                }
            }
            ?>
        </div>
    </div>
</body>

</html>