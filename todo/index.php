<?php 
   require_once 'config.php';

   // Handle task insertion
   if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['task'])) { // isset is used to check if a variable is set and not null
      $task = mysqli_real_escape_string($conn, $_POST['task']); // it used for preventing SQL injection
      $sql = "INSERT INTO tasks (task) VALUES ('$task')"; // QUERY method
      mysqli_query($conn, $sql);  // executing QUERY 
   }
   // Handle task status update
   if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['status']) && isset($_POST['id'])) {
      $id = (int) $_POST['id'];
      $status = mysqli_real_escape_string($conn, $_POST['status']);
      $sql = "UPDATE tasks SET status='$status' WHERE id=$id";
      mysqli_query($conn, $sql);
   }

   // Handle delete
   if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_id'])) {
      $id = (int) $_POST['delete_id'];
      $sql = "DELETE FROM tasks WHERE id=$id";
      mysqli_query($conn, $sql);
   }
?>
   <head>
      <link rel="stylesheet" href="./style.css">
   </head>



   <h2> Add Task </h2>
   <form action="index.php" method="post">
      <input type="text" name="task" placeholder="Enter your task here" required /> 
      <button type="submit">Add Task</button>
   </form>

   <h2> Task List </h2>
   <?php 
      $result = mysqli_query($conn, "SELECT * FROM tasks ORDER BY id DESC");

      if (mysqli_num_rows($result) > 0):
         while ($row = mysqli_fetch_assoc($result)): 
   ?>

      <p>
         <?= htmlspecialchars($row['task']) ?> 
         <strong> <?= htmlspecialchars($row['STATUS']) ?> </strong>
         <form action="index.php" method="post">
            <input type="hidden" name="id" value="<?= $row['id'] ?>">
            <button type="submit" name="status" value="completed">Complete</button>
         </form>
         <form action="index.php" method="post">
            <input type="hidden" name="delete_id" value="<?= $row['id'] ?> ">
            <button type="submit">Delete</button>
         </form>
      </p>

   <?php endwhile; else: ?>
      <p>No tasks found.</p>
   <?php endif; ?>

   <?php mysqli_close($conn); ?>