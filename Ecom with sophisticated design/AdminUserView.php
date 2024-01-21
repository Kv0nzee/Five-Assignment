<?php 
    require('./components/sidebar.php');
    $users = getAllUsers();

    if(isset($_POST["update"])){
        $id = $_POST["user_id"];
        header("Location: adminuserupdate.php?id=$id");
        
      }
    
      if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["delete"])) {
        $id = $_POST["user_id"];
        $delete_sql = "DELETE FROM users WHERE userID = $id";
    
        $stmt = $pdo->prepare($delete_sql);
    
        if ($stmt->execute()) {
            header("Location: adminuserView.php");
            exit();
        } else {
            echo "Error deleting product.";
        }
    } 

 ?>
<div class="body-wrapper">  
    <div class="col-lg-8 d-flex align-items-stretch w-100">
        <div class="card w-100">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Users View</h5>
                <a href="adminUserCreate.php" class="btn btn-primary m-1">User Create</a>
                <div class="table-responsive">
                    <table class="table text-nowrap mb-0 align-middle w-100">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">User ID</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">User Name</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">User Email</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">User Address</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">User Phone</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">User Type</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Action</h6>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Assuming $users is an array containing user data
                            foreach ($users as $user) {
                            ?>
                                <tr>
                                    <td class="border-bottom-0"><h6 class="fw-semibold mb-0"><?= $user['userID'] ?></h6></td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-1"><?= $user['userName'] ?></h6>
                                        <span class="fw-normal"><?= $user['userType'] ?></span>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal"><?= $user['userEmail'] ?></p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal"><?= $user['userAddress'] ?></p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal"><?= $user['userPhone'] ?></p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal"><?= $user['userType'] ?></p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <form method="POST">
                                            <input type="hidden" name="user_id" value=<?= $user['userID']?> >
                                            <button class="btn btn-outline-info" name="update">Update</button>
                                            <button class="btn btn-outline-danger" name="delete">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>