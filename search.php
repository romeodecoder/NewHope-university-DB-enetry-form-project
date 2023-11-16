<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Search = $_POST['search'];

    $serverName = "DESKTOP-G0LLV6O\SQLEXPRESS2014"; // Replace with your SQL Server name
    $connectionOptions = array(
        "Database" => "NewHopeASDB", // Replace with your database name
    );

    $conn = sqlsrv_connect($serverName, $connectionOptions);

    if (!$conn) {
        // die("Connection failed: " . print_r(sqlsrv_errors(), true));
        // echo "Connection to Database failed Due to Invalid credentials";
        echo "<script>alert('Connection to Database Failed  Due to Invalid credentials');</script>";
        die();

    }

    // $sql = "SELECT * FROM courseFacMem( ?)";
    $sql = "SELECT * FROM courseFacMem1('" . $Search . "')";


    $params = array(
        array($Search, SQLSRV_PARAM_IN)
    );

    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt === false) {
        die("Error: " . print_r(sqlsrv_errors(), true));
    } else {
        if (sqlsrv_has_rows($stmt)) {
            echo "<table style='border-collapse: collapse; width: 100%; border: 1px solid #ddd;'>";
            echo "<tr><th style='border: 1px solid #ddd; padding: 8px; text-align: left;'>CourseID</th><th style='border: 1px solid #ddd; padding: 8px; text-align: left;'>Name</th><th style='border: 1px solid #ddd; padding: 8px; text-align: left;'>DeptID</th><th style='border: 1px solid #ddd; padding: 8px; text-align: left;'>FirstName</th><th style='border: 1px solid #ddd; padding: 8px; text-align: left;'>LastName</th><th style='border: 1px solid #ddd; padding: 8px; text-align: left;'>DepartmentName</th><th style='border: 1px solid #ddd; padding: 8px; text-align: left;'>FacultyName</th></tr>";

            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                echo "<tr><td style='border: 1px solid #ddd; padding: 8px; text-align: left;'>"
                    . $row["StaffID"] . "</td><td style='border: 1px solid #ddd; padding: 8px; text-align: left;'>"
                    . $row["Name"] . "</td><td style='border: 1px solid #ddd; padding: 8px; text-align: left;'>"
                    . $row["CourseID"] . "</td><td style='border: 1px solid #ddd; padding: 8px; text-align: left;'>"
                    . $row["FirstName"] . "</td><td style='border: 1px solid #ddd; padding: 8px; text-align: left;'>"
                    . $row["LastName"] . "</td><td style='border: 1px solid #ddd; padding: 8px; text-align: left;'>"
                    . $row["DepartmentName"] . "</td><td style='border: 1px solid #ddd; padding: 8px; text-align: left;'>"
                    . $row["FacultyName"] . "</td></tr>";
            }

            echo "</table>";
        } else {
            echo "No results found.";
        }
    }

    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
}
?>