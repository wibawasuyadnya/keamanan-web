<?php
$host = 'mysql-server';
$port = 3306;
$servername = "localhost:8080";
$username = "root";
$password = "mypass";
$database = "keamanan_web";

$mysqli = new mysqli($host, $username, $password, $database, $port);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}


$tables = $mysqli->query("SELECT * FROM users");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM users WHERE id = '$id'";
    $result = $mysqli->query($query);

    if ($result) {
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo "User ID: " . $row['id'] . "<br>";
            echo "Username: " . $row['username'] . "<br>";
            echo "Password: " . $row['password'] . "<br>";
        } else {
            echo "No user found with ID: $id";
        }

        $result->free();
    } else {
        echo "Query failed: " . $mysqli->error;
    }
}

if (isset($_GET['table'])) {
    $table = $_GET['table'];
    $query = "SELECT * FROM $table";
    $result = $mysqli->query($query);

    if ($result) {
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                foreach ($row as $key => $value) {
                    echo "$key: $value<br>";
                }
                echo "<br>";
            }
        } else {
            echo "No data found in table: $table";
        }

        // Free the result set
        $result->free();
    } else {
        echo "Query failed: " . $mysqli->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dangerous Input</title>
</head>
<body>
    <h2>Simple User Validation</h2>
    <form action="db.php" method="GET" style="padding-bottom: 20px;">
        <label for="id">Username:</label>
        <input type="text" name="id" id="id">
        <input type="submit" value="Submit">
    </form>
    <form action="db.php" method="GET">
        <label for="table">Password:</label>
        <input type="password" name="table" id="table">
        <input type="submit" value="Submit">
    </form>
</body>
</html>