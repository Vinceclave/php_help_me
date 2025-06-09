<?php 
    $db_host = 'localhost';
    $db_user = "root";
    $db_pass = "";
    $db_name = "contactlist";

    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

    $sql = "CREATE TABLE IF NOT EXISTS contacts (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(100) NOT NULL,
                email VARCHAR(100) NOT NULL,
                phone VARCHAR(20),
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )";

    if (!$conn || !mysqli_query($conn, $sql))
       die ("Connection Failed" . mysqli_connect_error());
?>