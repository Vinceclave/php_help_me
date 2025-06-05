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
$contacts = mysqli_fetch_all($result, MYSQLI_ASSOC);

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
            <?php 
                if (!empty($contacts)) :
                    foreach($contacts as $contact):
            ?>  
                <tr>
                    <td><?= htmlspecialchars($contact['name']) ?></td>
                    <td><?= htmlspecialchars($contact['email']) ?></td>
                    <td><?= htmlspecialchars($contact['phone']) ?></td>
                    <td><form action="index.php" method="post" onSubmit="return confirm('are you sure you want to delete');">
                        <input type="hidden" name="delete_id" value="<?= $contact['id'] ?>">
                        <button type="submit">Delete</button>
                    </form></td>
                </tr>
            <?php 
                endforeach; 
                else:
            ?>
                <p> No Contacts Found. </p> 
            <?php
                endif;
                mysqli_close($conn)
            ?>            
        </tbody>
    </table>

