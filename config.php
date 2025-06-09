<?php
    $db_host = 'localhost';
    $db_user = 'root';
    $db_pass = '';
    $db_name = 'todo';

    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

    $sql = "CREATE TABLE IF NOT EXISTS books (
                IBSN INT AUTO_INCREMENT PRIMARY KEY,
                title VARCHAR(100) NOT NULL,
                copyright INT NOT NULL,
                edition VARCHAR(100) NOT NULL,
                price DECIMAL(10, 2) NOT NULL,
                quantity INT NOT NULL
            )";

    if (!$conn || !mysqli_query($conn, $sql)) {
        die('Connection failed' . mysqli_connect_error());
    }
?>

