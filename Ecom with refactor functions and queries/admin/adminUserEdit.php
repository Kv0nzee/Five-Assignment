<div class="flex w-full h-full">
<?php
require('../components/sidebar.php');

$id = $_GET['id'];

$user = getUserById($id); // Assuming you have a function like getUserById to retrieve user details

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $userData = [
        'username' => $_POST['username'],
        'email' => $_POST['email'],
    ];

    $success = updateUser($userData, $id);

    if ($success) {
        redirect("/ecomAssignment/admin");

        exit();
    } else {
        echo 'Error updating user in the database.';
    }
}
?>

<div class="w-full p-5 bg-white border rounded-sm border-stroke shadow-default">
    <div class="px-6 py-4 border-b border-stroke">
        <h3 class="font-semibold text-black">
            Edit User
        </h3>
    </div>
    <form method="post">
        <div class="p-6">
            <!-- Add other form fields as needed -->
            <div class="mb-4">
                <label class="block mb-2 text-black">
                    Username
                </label>
                <input type="text" name="username" placeholder="Enter username"
                    value="<?php echo $user->username; ?>"
                    class="w-full rounded border-b-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
            </div>
            <div class="mb-4">
                <label class="block mb-2 text-black">
                    Email
                </label>
                <input type="email" name="email" placeholder="Enter email"
                    value="<?php echo $user->email; ?>"
                    class="w-full rounded border-b-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
            </div>
            <!-- Repeat similar blocks for other fields -->

            <button name="submit"
                class="flex justify-center w-full p-3 font-medium text-white rounded bg-zinc-600 bg-primary text-gray">
                Update User
            </button>
        </div>
    </form>
</div>
</div>