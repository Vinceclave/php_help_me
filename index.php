<?php 
    require_once 'config.php'; // import 
    # handling query (POST, PUT, DELETE, READ)


    #post
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['name']) && isset($_POST['email'])){
        $name = mysqli_real_escape_string($conn, trim($_POST['name']));
        $email = mysqli_real_escape_string($conn, trim($_POST['email']));
        $phone = isset($_POST['phonenum']) ? mysqli_real_escape_string($conn, trim($_POST['phonenum'])) : '';

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "invalid email format.";
            return;
}
        // true
        $sql = "INSERT INTO contacts (name, email, phone) VALUES ('$name', '$email', '$phone')";
        if (mysqli_query($conn, $sql))
            echo "contact added";
        else 
            echo "error: " . mysqli_error($conn);
    }


    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_id'])) {
        $id = (int) $_POST['delete_id'];
        $sql = "DELETE FROM contacts WHERE id=$id";

        mysqli_query($conn, $sql);
    }

    // Fetch contact list
$result = mysqli_query($conn, "SELECT * FROM contacts");
if (!$result) {
    echo "Query failed: " . mysqli_error($conn);
}
?>

    <head>
        <link rel="stylesheet" href="./style.css">
    </head>


    <h2> Contacts </h2>
    <form id="contact-form" action="index.php" method="post">
        <input type="text" name="name" placeholder="Enter your name here..." required>  
        <input type="text" name="email" placeholder="Enter your email here..." required>
        <input type="text" name="phonenum" placeholder="Enter your number here..." required>
        <button type="submit">Add Contact</button>  
    </form>

    <h3> Contact Lists </h3>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
                 <?php if (mysqli_num_rows($result) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>

                        <td>
                            <?= htmlspecialchars($row['name']) ?> 
                        </td>
                        <td>
                            <?= htmlspecialchars($row['email']) ?> 
                        </td>
                        <td>
                            <?= htmlspecialchars($row['phone']) ?> 
                        </td>
                        <td>
                                                        <form action="index.php" method="post">
                                                            <input type="hidden" name="delete_id" value="<?= $row['id']?>">
                                                            <button type="submit">Delete</button>
                                                        </form>
                        </td>
            </tr>

                    <?php endwhile; ?>
                <?php else: ?>
            <tr>
                    
                    <p>No contacts found.</p>
            </tr>
                
                    <?php endif; ?>
        </tbody>

    </table>
    <?php mysqli_close($conn); ?>