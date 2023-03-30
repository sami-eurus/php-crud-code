<?php
// Connect to MySQL database
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'mydatabase';
$connection = mysqli_connect($host, $user, $password, $dbname);

// Check connection
if (!$connection) {
    die('Connection failed: ' . mysqli_connect_error());
}

// Create operation
if (isset($_POST['create'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $sql = "INSERT INTO users (name, email) VALUES ('$name', '$email')";
    mysqli_query($connection, $sql);
}

// Read operation
$sql = "SELECT * FROM users";
$result = mysqli_query($connection, $sql);

// Update operation
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $sql = "UPDATE users SET name='$name', email='$email' WHERE id=$id";
    mysqli_query($connection, $sql);
}

// Delete operation
if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM users WHERE id=$id";
    mysqli_query($connection, $sql);
}

// Close database connection
mysqli_close($connection);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>CRUD Operations</title>
</head>
<body>
    <h1>CRUD Operations</h1>

    <!-- Create form -->
    <h2>Create User</h2>
    <form method="post" action="index.php">
        <label for="name">Name:</label>
        <input type="text" name="name">
        <br>
        <label for="email">Email:</label>
        <input type="email" name="email">
        <br>
        <button type="submit" name="create">Create User</button>
    </form>

    <!-- Read data from database -->
    <h2>List of Users</h2>
    <?php
    // Connect to database
    $host = 'your-rds-endpoint-or-hostname';
    $user = 'your-rds-username';
    $password = 'your-rds-password';
    $dbname = 'your-rds-database-name';
    $port = 3306;
    $connection = mysqli_connect($host, $user, $password, $dbname, $port);

    // Check connection
    if (!$connection) {
        die('Connection failed: ' . mysqli_connect_error());
    }

    // Retrieve data from database
    $sql = "SELECT * FROM users";
    $result = mysqli_query($connection, $sql);

    // Display data in a table
    echo '<table>';
    echo '<tr><th>ID</th><th>Name</th><th>Email</th><th>Actions</th></tr>';
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>' . $row['id'] . '</td>';
        echo '<td>' . $row['name'] . '</td>';
        echo '<td>' . $row['email'] . '</td>';
        echo '<td>';
        echo '<form method="post" action="index.php">';
        echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
        echo '<button type="submit" name="update">Update</button> ';
        echo '<button type="submit" name="delete">Delete</button>';
        echo '</form>';
        echo '</td>';
        echo '</tr>';
    }
    echo '</table>';

    // Close database connection
    mysqli_close($connection);
    ?>

    <!-- Update form -->
    <h2>Update User</h2>
    <form method="post" action="index.php">
        <input type="hidden" name="id" value="">
        <label for="name">Name:</label>
        <input type="text" name="name">
        <br>
        <label for="email">Email:</label>
        <input type="email" name="email">
        <br>
        <button type="submit" name="update">Update User</button>
    </form>

    <!-- Delete form -->
    <h2>Delete User</h2>
    <form method="post" action="index.php">
        <input type="hidden" name="id" value="">
        <button type="submit" name="delete">Delete User</button>
    </form>
</body>
</html>
