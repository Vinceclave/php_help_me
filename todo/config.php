<?php 
   // database credentials 
   $db_host = 'localhost';
   $db_user = 'root';
   $db_pass = '';
   $db_name = 'todo';

   // create a connection
   $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

   // creating table 
   $sql = 'CREATE TABLE IF NOT EXISTS tasks (
       id INT AUTO_INCREMENT PRIMARY KEY,
       task VARCHAR(255) NOT NULL,
       STATUS VARCHAR(50) DEFAULT "pending"
       )';
 
   // check connection
   if (!$conn || !mysqli_query($conn, $sql)) {
      die('connection failed: ' . mysqli_connect_error());
   } 
?>