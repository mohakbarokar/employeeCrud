<?php
// PostgreSQL database configuration
//$host = 'your_host';
//$port = 'your_port';
//$dbname = 'your_database';
//$user = 'your_username';
//$password = 'your_password';

// Create a database connection
$conn = pg_connect("host=jhhdevopsterra-pgsql-server.postgres.database.azure.com port=5432 dbname=employee user=azureuser password=Password@123");

if (!$conn) {
    die("Connection failed: " . pg_last_error());
}

// SQL query to select all records from your table
$query = "SELECT * FROM employee";

// Execute the query
$result = pg_query($conn, $query);

if (!$result) {
    die("Query failed: " . pg_last_error());
}

// Display the data in an HTML table
echo "<table>";
echo "<tr><th>ID</th><th>Name</th></tr>";

while ($row = pg_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $row['employeeid'] . "</td>";
    echo "<td>" . $row['employee_name'] . "</td>";
    echo "</tr>";
}

echo "</table>";

// Close the database connection
pg_close($conn);
?>
