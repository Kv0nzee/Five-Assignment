<?php
require_once("Connect.php");

// Fetching admin users from the database
$adminUsers_sql = "SELECT * FROM users";
$stmt = $pdo->prepare($adminUsers_sql);
$stmt->execute();
$adminUsers = $stmt->fetchAll(PDO::FETCH_ASSOC);

if(isset($_POST["update"])){
    $id = $_POST["user_id"];
    header("Location: adminuserupdate.php?id=$id");
    
  }

  if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["delete"])) {
    $id = $_POST["user_id"];
    $delete_sql = "DELETE FROM users WHERE id = $id";

    $stmt = $pdo->prepare($delete_sql);

    if ($stmt->execute()) {
        header("Location: adminuserView.php");
        exit();
    } else {
        echo "Error deleting product.";
    }
} 
require('sidebar.php');
?>

<div class="container mt-5">
    <form action="adminuserCreate.php">
      <h2>User View</h2>
        <button class="btn btn-outline-primary" type="submit" >
          Create
        </button>
          <!-- <a class="blue text-decoration-none btn btn-outline-warning"  href="productCreat.php">Created by a</a> -->
    </form>

    <table class="table table-striped p-5">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Type</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($adminUsers as $adminUser) { ?>
                <tr>
                    <td><?= $adminUser['name']; ?></td>
                    <td><?= $adminUser['email']; ?></td>
                    <td><?= $adminUser['type']; ?></td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="user_id" value=<?= $adminUser['id']?> >
                            <button class="btn btn-outline-info" name="update">Update</button>
                            <button class="btn btn-outline-danger" name="delete">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
