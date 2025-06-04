<?php 
    require_once 'config.php';
    # handling query (POST, PUT, DELETE, READ)

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['name']) && isset($_POST['email'])){
        $name = mysqli_real_escape_string($conn, trim($_POST['name']));
        $email = mysqli_real_escape_string($conn, trim($_POST['email']));
        $phone = isset($_POST['phonenum']) ? mysqli_real_escape_string($conn, trim($_POST['phonenum'])) : '';

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
            echo "invalid email format.";
        $sql = "INSERT INTO contacts (name, email, phone) VALUES ('$name', '$email', '$phone')";
        if (mysqli_query($conn, $sql))
            echo "contact added";
        else 
            echo "error: " . mysqli_error($conn);
    
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
    <?php if (mysqli_num_rows($result) > 0): ?>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <p>
                <?= htmlspecialchars($row['name']) ?> 
                <?= htmlspecialchars($row['email']) ?> 
                <?= htmlspecialchars($row['phone']) ?> 
                <form action="index.php" method="post">
                    
                </form>
            </p>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No contacts found.</p>
    <?php endif; ?>

    <?php mysqli_close($conn); ?>