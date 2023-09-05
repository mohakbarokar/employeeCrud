<!DOCTYPE html>
<head>
    <title>Insert data to PostgreSQL with php - creating a simple web application</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        li {listt-style: none;}
    </style>
</head>
<body>
<h2>Enter information regarding book</h2>
<ul>
    <form name="insert" action="insert.php" method="POST" >
        <li>Book ID:</li><li><input type="text" name="bookid" /></li>
        <li>Book Name:</li><li><input type="text" name="book_name" /></li>
        <li>Author:</li><li><input type="text" name="author" /></li>
        <li>Publisher:</li><li><input type="text" name="publisher" /></li>
        <li>Date of publication:</li><li><input type="text" name="dop" /></li>
        <li>Price (USD):</li><li><input type="text" name="price" /></li>
        <li><input type="submit" /></li>
    </form>
</ul>
</body>
</html>

<?php
// Database connection parameters
//$host = 'your_host';
//$port = 'your_port'; // Default is usually 5432
//$database = 'your_database';
//$username = 'your_username';
//$password = 'your_password';

// Establish the PostgreSQL database connection
$conn = pg_connect("host=jhhdevopsterra-pgsql-server.postgres.database.azure.com port=5432 dbname=employee user=azureuser password=Password@123");

if (!$conn) {
    die("Connection failed: " . pg_last_error());
}

// Check if the table already exists
$tableName = 'employee';
$tableExistsQuery = "SELECT EXISTS (SELECT 1 FROM information_schema.tables WHERE table_name = '$tableName')";
$tableExistsResult = pg_query($conn, $tableExistsQuery);

if (!$tableExistsResult) {
    die("Error checking table existence: " . pg_last_error($conn));
}

$tableExists = pg_fetch_result($tableExistsResult, 0);

if ($tableExists === 'f') {
    // Table does not exist, so create it
    $createTableQuery = "CREATE TABLE $tableName ( employeeid integer, employee_name text)";

    $createTableResult = pg_query($conn, $createTableQuery);

    if (!$createTableResult) {
        die("Error creating table: " . pg_last_error($conn));
    }
    echo "Table created successfully!";
} else {
    echo "Table already exists!";
}
$query = "INSERT INTO $tableName VALUES ('$_POST[employeeid]','$_POST[employee_name]')";
$result = pg_query($query);

// Close the database connection
pg_close($conn);
?>
