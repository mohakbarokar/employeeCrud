<?php
// Database connection parameters
//$host = 'your_host';
//$port = 'your_port'; // usually 5432 for PostgreSQL
//$database = 'your_database';
//$username = 'your_username';
//$password = 'your_password';

// Connect to the PostgreSQL database
$conn = pg_connect("host=jhhdevopsterra-pgsql-server.postgres.database.azure.com port=5432 dbname=employee user=azureuser password=Password@123");

if (!$conn) {
    die("Connection failed: " . pg_last_error());
}

// SQL query to create a table
$query = "CREATE TABLE IF NOT EXISTS book ( bookid integer, book_name text, author text, publisher text, dop text, price integer)";

// Execute the SQL query
$result = pg_query($conn, $query);

if (!$result) {
    die("Error creating table: " . pg_last_error($conn));
} else {
    echo "Table created successfully!";
}

// Close the database connection
pg_close($conn);
?>
