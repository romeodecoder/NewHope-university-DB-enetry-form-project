<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $facultyName = $_POST['FacultyName'];



    // Database connection parameters
    $serverName = "DESKTOP-G0LLV6O\SQLEXPRESS2014";  // Replace with your SQL Server name
    $connectionOptions = array(
        "Database" => "NewHopeASDB",  // Replace with your database name

    );

    // Establish a connection to SQL Server with Windows Authentication
    $conn = sqlsrv_connect($serverName, $connectionOptions);

    if (!$conn) {
        die("Connection failed: " . print_r(sqlsrv_errors(), true));
    }

    // Prepare the SQL insert statement
    $sql = "INSERT INTO Faculty (FacultyName)
            VALUES (?)";

    $params = array(
        $facultyName,


    );

    // Execute the SQL insert statement
    $stmt = sqlsrv_prepare($conn, $sql, $params);

    if (sqlsrv_execute($stmt) === false) {
        die("Error: " . print_r(sqlsrv_errors(), true));
    } else {
        echo "Data inserted successfully.";
    }

    // Clean up resources
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
}
?>