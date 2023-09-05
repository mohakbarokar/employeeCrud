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
    $createTableQuery = "CREATE TABLE $tableName ( bookid integer, book_name text, author text, publisher text, dop text, price integer)";

    $createTableResult = pg_query($conn, $createTableQuery);

    if (!$createTableResult) {
        die("Error creating table: " . pg_last_error($conn));
    }
    echo "Table created successfully!";
} else {
    echo "Table already exists!";
}

// Close the database connection
pg_close($conn);
?>
