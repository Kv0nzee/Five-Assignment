<?php
require_once("./components/AdminNavber.php");

$sql = "SELECT * FROM users";
$statement = $pdo->prepare($sql);
$statement->execute();
$users = $statement->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['create_user'])) {
    header("Location: adminUserCreate.php");
    exit();
}

if (isset($_POST['view'])) {
    $id = $_POST['user_id'];
    header("Location: adminuserdetailview.php?id=$id");
    exit();
}

if (isset($_POST['delete'])) {
    $id = $_POST['user_id'];
    // Perform delete action here
    header("Location: adminUserDelete.php?id=$id");
    exit();
}

if (isset($_GET['delete']) && $_GET['delete'] == true) {
    echo "<script>alert('User Deleted.')</script>";
}
?>


<div class="container mt-5">
    <div class="mb-3">
        <form method="POST">
            <button class="btn btn-primary" type="submit" name="create_user">Create New User</button>
        </form>
    </div>
    <table class="table table-bordered table-hover table-striped">
        <thead class="table-primary">
            <tr>
                <th scope="col">User ID</th>
                <th scope="col">User Name</th>
                <th scope="col">Email</th>
                <th scope="col">Address</th>
                <th scope="col">Phone</th>
                <th scope="col">User Type</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <form method="POST">
                    <?php $user_id = $user['userID']; ?>
                    <tr>
                        <th scope="row"><?= $user_id ?></th>
                        <td><?= $user['userName'] ?></td>
                        <td><?= $user['userEmail'] ?></td>
                        <td><?= $user['userAddress'] ?></td>
                        <td><?= $user['userPhone'] ?></td>
                        <td><?= $user['userType'] ?></td>
                        <td>
                            <input type="hidden" name="user_id" value=<?= $user_id ?>>
                            <button class="btn btn-info btn-sm" type="submit" name="view">View</button>
                            <button class="btn btn-danger btn-sm" type="submit" name="delete">Delete</button>
                        </td>
                    </tr>
                </form>
            <?php endforeach ?>
        </tbody>
    </table>
</div>