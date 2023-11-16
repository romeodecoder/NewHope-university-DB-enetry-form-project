<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $firstName = $_POST['FirstName'];
    $lastName = $_POST['LastName'];
    $academicQualification = $_POST['Academic_Qualification'];
    $deptID = $_POST['DeptID'];
    $dateOfBirth = $_POST['Date_of_birth'];
    $hireDate = $_POST['HireDate'];
    $email = $_POST['Email'];
    $phoneNumber = $_POST['Phone_number'];
    $gender = $_POST['Gender'];

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
    $sql = "INSERT INTO Staff (FirstName, LastName, Academic_Qualification, DeptID, Date_of_birth, HireDate, Email, Phone_number, Gender)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $params = array(
        $firstName,
        $lastName,
        $academicQualification,
        $deptID,
        $dateOfBirth,
        $hireDate,
        $email,
        $phoneNumber,
        $gender
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