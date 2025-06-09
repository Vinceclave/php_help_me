<?php 
    require_once "config.php";

    if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['title']) &&
        isset($_POST['copyright'])  && isset($_POST['edition'])  && 
        isset($_POST['price'])  && isset($_POST['quantity'])) {
        
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $copyright = mysqli_real_escape_string($conn, $_POST['copyright']);
        $edition = mysqli_real_escape_string($conn, $_POST['edition']);
        $price = mysqli_real_escape_string($conn, $_POST['price']);
        $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);

        $sql = "INSERT INTO books (title, copyright, edition, price, quantity) 
                VALUES ('$title', '$copyright', '$edition', '$price', '$quantity')";
        if (mysqli_query($conn, $sql)) ;        
         echo("Added Books");
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete-id'])) {
        $delete_id = (int) mysqli_real_escape_string($conn, $_POST['delete-id']);

        $sql = "DELETE FROM books WHERE IBSN = $delete_id";
        
        if (!mysqli_query($conn, $sql)) die('Query Failed' . mysqli_error($conn));
        echo 'Deleted Successfully';
    }

    $books = [];
    $result = '';

    if (isset($_POST['search-field']) && !empty($_POST['search-field'])) {
        $search = mysqli_real_escape_string($conn, $_POST['search-field']);
        $result = mysqli_query($conn, "SELECT * FROM books WHERE IBSN LIKE '%$search%'");
    } else {
        $result= mysqli_query($conn, 'SELECT * FROM books');
    }

    if (!$result) {
    die('Query Failed: ' . mysqli_error($conn));
    }
    $books = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>



<form action="index.php" method="post">
    <input type="text" name="search-field" placeholder="Search IBSN....">
    <button type="submit">Search</button>
    <button type="button">Add</button>
</form>
<table>
    <thead>
        <tr>
            <th>Title</th>
            <th>Copyright</th>
            <th>Edition</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            if(!empty($books)):
                foreach($books as $book):
        ?>
        <tr>
            <td>s</td>
            <td>s</td>
            <td>s</td>
            <td>s</td>
            <td>s</td>
            <td>
                <form action="index.php" method="post" onsubmit="confirm('Are you sure you want to delete?')">
                    <input type="type" name="delete-id" value="<?= $book['IBSN'] ?>">
                    <button type="submit">Delete</button>
                </form>
                <button type="button">Edit</button>
            </td>
        </tr>
      <?php 
        endforeach;
        else:
      ?>
        <p>No Data</p>
     <?php 
        endif;
        mysqli_close($conn);
     ?>
    </tbody>
</table>


<!-- modal -->
<div>
    <h2>Add Book</h2>
    <form action="index.php" method="post">
        <input class="input-fields" type="text" name="title" placeholder="title" required>
        <input class="input-fields" type="number" name="copyright" placeholder="copyright" required>
        <input class="input-fields" type="text" name="edition" placeholder="edition" required>
        <input class="input-fields" type="number" name="price" placeholder="price" required>
        <input class="input-fields" type="number" name="quantity" placeholder="quanitity" required>
        <button type="submit">Add Book</button>

    </form>
</div>

<div>
    <h2>Update Book</h2>
    <form action="index.php" method="post">
        <input class="input-fields" type="text" name="title" placeholder="title" required>
        <input class="input-fields" type="number" name="copyright" placeholder="copyright" required>
        <input class="input-fields" type="text" name="edition" placeholder="edition" required>
        <input class="input-fields" type="number" name="price" placeholder="price" required>
        <input class="input-fields" type="number" name="quantity" placeholder="quanitity" required>
        <button type="submit">Edit</button>
        <button type="submit">Cancel</button>
        <button type="submit">Save</button>
    </form>
</div>