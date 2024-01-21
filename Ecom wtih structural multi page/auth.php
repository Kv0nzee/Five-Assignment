<?php
require_once("./components/header.php");

// Initialize variables for form values and errors
$fullName = $email = $password = $confirmPassword = $userPhone = $userAddress = "";
$fullNameError = $emailError = $passwordError = $confirmPasswordError = $userPhoneError = $userAddressError = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["logname"]) && $_POST["confirm_pass"]) {
        // Process signup logic
        $fullName = $_POST["logname"];
        $email = $_POST["logemail"];
        $password = $_POST["logpass"];
        $confirmPassword = $_POST["confirm_pass"];
        $userPhone = $_POST["userPhone"];
        $userAddress = $_POST["userAddress"];

        // Perform validation
        if (empty($fullName)) {
            $fullNameError = "Full Name is required";
        }

        if (empty($email)) {
            $emailError = "Email is required";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailError = "Invalid email format";
        }

        if (empty($password)) {
            $passwordError = "Password is required";
        }

        if ($password !== $confirmPassword) {
            $confirmPasswordError = "Passwords do not match";
        }

        if (empty($userPhone)) {
            $userPhoneError = "Phone number is required";
        }

        if (empty($userAddress)) {
            $userAddressError = "Address is required";
        }

        if (empty($fullNameError) && empty($emailError) && empty($passwordError) && empty($confirmPasswordError) && empty($userPhoneError) && empty($userAddressError)) {
            // Assuming you have a 'users' table in your database
            $insert_sql = "INSERT INTO users (userName, userEmail, userPass, userPhone, userAddress, userType) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($insert_sql);

            if ($stmt->execute([$fullName, $email, password_hash($password, PASSWORD_DEFAULT), $userPhone, $userAddress, 'user'])) {
                $user = $stmt->fetch(PDO::FETCH_OBJ);
                header("Location: auth.php");
                exit();
            } else {
                echo "Error creating user.";
            }
        }
    } else {
        $email = $_POST["logemail"];
        $password = $_POST["logpass"];

        // Validate and authenticate user
        $select_sql = "SELECT * FROM users WHERE userEmail = ?";
        $stmt = $pdo->prepare($select_sql);
        if ($stmt->execute([$email])) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                // Verify password during login
                $check = password_verify($password, $user['userPass']);
                if ($check) {
                    // Authentication successful
                    $_SESSION['user'] =  $user;
                    header("Location: ./");
                    exit();
                } else {
                    $passwordError = "Invalid password";
                }
            } else {
                $emailError = "User not found";
            }
        } else {
            echo "Error fetching user data: " . $stmt->errorInfo()[2];
        }
    }
}
?>

<style>
    [type="checkbox"]:checked,
    [type="checkbox"]:not(:checked) {
        position: absolute;
        left: -9999px;
    }

    .checkbox:checked + label,
    .checkbox:not(:checked) + label {
        position: relative;
        display: block;
        text-align: center;
        width: 60px;
        height: 16px;
        border-radius: 8px;
        padding: 0;
        margin: 10px auto;
        cursor: pointer;
        background-color: #3B5D50;
    }

    .checkbox:checked + label:before,
    .checkbox:not(:checked) + label:before {
        position: absolute;
        display: block;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        color: #3B5D50;
        background-color: #3B5D50;
        font-family: 'unicons';
        content: '\eb4f';
        z-index: 20;
        top: -10px;
        left: -10px;
        line-height: 36px;
        text-align: center;
        font-size: 24px;
        transition: all 0.5s ease;
    }

    .checkbox:checked + label:before {
        transform: translateX(44px) rotate(-270deg);
    }

    .card-3d-wrap {
        position: relative;
        width: 440px;
        max-width: 100%;
        height: 400px;
        -webkit-transform-style: preserve-3d;
        transform-style: preserve-3d;
        perspective: 800px;
        margin-top: 60px;
    }

    .card-3d-wrapper {
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
        -webkit-transform-style: preserve-3d;
        transform-style: preserve-3d;
        transition: all 600ms ease-out;
    }

    .card-front,
    .card-back {
        width: 100%;
        height: 100%;
        background-color: #3B5D50;
        background-position: bottom center;
        background-repeat: no-repeat;
        background-size: 300%;
        position: absolute;
        border-radius: 6px;
        left: 0;
        top: 0;
        -webkit-transform-style: preserve-3d;
        transform-style: preserve-3d;
        -webkit-backface-visibility: hidden;
        -moz-backface-visibility: hidden;
        -o-backface-visibility: hidden;
        backface-visibility: hidden;
    }

    .card-back {
        transform: rotateY(180deg);
    }

    .checkbox:checked ~ .card-3d-wrap .card-3d-wrapper {
        transform: rotateY(180deg);
    }

    .center-wrap {
        position: absolute;
        width: 100%;
        padding: 0 35px;
        top: 50%;
        left: 0;
        transform: translate3d(0, -50%, 35px) perspective(100px);
        z-index: 20;
        display: block;
    }

    .form-group {
        position: relative;
        display: block;
        margin: 0;
        padding: 0;
    }

    .form-style {
        padding: 13px 20px;
        padding-left: 55px;
        height: 48px;
        width: 100%;
        font-weight: 500;
        border-radius: 4px;
        font-size: 14px;
        line-height: 22px;
        letter-spacing: 0.5px;
        outline: none;
        color: #c4c3ca;
        background-color: #1f2029;
        border: none;
        -webkit-transition: all 200ms linear;
        transition: all 200ms linear;
        box-shadow: 0 4px 8px 0 rgba(21, 21, 21, .2);
    }

    .form-style:focus,
    .form-style:active {
        border: none;
        outline: none;
        box-shadow: 0 4px 8px 0 rgba(21, 21, 21, .2);
    }

    .input-icon {
        position: absolute;
        top: 0;
        left: 18px;
        height: 48px;
        font-size: 24px;
        line-height: 48px;
        text-align: left;
        color: #3B5D50;
        -webkit-transition: all 200ms linear;
        transition: all 200ms linear;
    }

    .form-group input:-ms-input-placeholder {
        color: #c4c3ca;
        opacity: 0.7;
        -webkit-transition: all 200ms linear;
        transition: all 200ms linear;
    }

    .form-group input::-moz-placeholder {
        color: #c4c3ca;
        opacity: 0.7;
        -webkit-transition: all 200ms linear;
        transition: all 200ms linear;
    }

    .form-group input:-moz-placeholder {
        color: #c4c3ca;
        opacity: 0.7;
        -webkit-transition: all 200ms linear;
        transition: all 200ms linear;
    }

    .form-group input::-webkit-input-placeholder {
        color: #c4c3ca;
        opacity: 0.7;
        -webkit-transition: all 200ms linear;
        transition: all 200ms linear;
    }

    .form-group input:focus:-ms-input-placeholder {
        opacity: 0;
        -webkit-transition: all 200ms linear;
        transition: all 200ms linear;
    }

    .form-group input:focus::-moz-placeholder {
        opacity: 0;
        -webkit-transition: all 200ms linear;
        transition: all 200ms linear;
    }

    .form-group input:focus:-moz-placeholder {
        opacity: 0;
        -webkit-transition: all 200ms linear;
        transition: all 200ms linear;
    }

    .form-group input:focus::-webkit-input-placeholder {
        opacity: 0;
        -webkit-transition: all 200ms linear;
        transition: all 200ms linear;
    }
</style>

<div class="section">
    <div class="container">
        <div class="row full-height justify-content-center">
            <div class="col-12 text-center align-self-center py-5">
                <div class="section pb-5 pt-5 pt-sm-2 text-center">
                    <h6 class="mb-0 pb-3 text"><span>Log In </span>/<span>Sign Up</span></h6>
                    <input class="checkbox" type="checkbox" id="reg-log" name="reg-log" />
                    <label for="reg-log"></label>
                    <div class="card-3d-wrap mx-auto">
                        <div class="card-3d-wrapper" style="min-height:520px;">
                            <div class="card-front">
                                <div class="center-wrap">
                                    <div class="section text-center">
                                        <h4 class="mb-4 pb-3 text-white">Log In</h4>
                                        <form method="post" action="">
                                            <div class="form-group">
                                                <input type="email" name="logemail" class="form-style" placeholder="Your Email" id="logemail" value="<?php echo htmlspecialchars($email); ?>" autocomplete="off">
                                                <i class="input-icon uil uil-at"></i>
                                                <?php if (!empty($emailError)) { ?>
                                                    <div class="error-message"><?php echo $emailError; ?></div>
                                                <?php } ?>
                                            </div>
                                            <div class="form-group mt-2">
                                                <input type="password" name="logpass" class="form-style" placeholder="Your Password" id="logpass" autocomplete="off">
                                                <i class="input-icon uil uil-lock-alt"></i>
                                                <?php if (!empty($passwordError)) { ?>
                                                    <div class="error-message"><?php echo $passwordError; ?></div>
                                                <?php } ?>
                                            </div>
                                            <button type="submit" class="btn mt-4">Submit</button>
                                        </form>
                                        <p class="mb-0 mt-4 text-center"><a href="#0" class="link">Forgot your password?</a></p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-back">
                                <div class="center-wrap">
                                    <div class="section text-center">
                                        <h4 class="mb-4 pb-3 text-white">Sign Up</h4>
                                        <form method="post" action="">
                                            <div class="form-group">
                                                <input type="text" name="logname" class="form-style" placeholder="Your Full Name" id="logname" value="<?php echo htmlspecialchars($fullName); ?>" autocomplete="off">
                                                <i class="input-icon uil uil-user"></i>
                                                <?php if (!empty($fullNameError)) { ?>
                                                    <div class="error-message"><?php echo $fullNameError; ?></div>
                                                <?php } ?>
                                            </div>
                                            <div class="form-group mt-2">
                                                <input type="email" name="logemail" class="form-style" placeholder="Your Email" id="logemail" value="<?php echo htmlspecialchars($email); ?>" autocomplete="off">
                                                <i class="input-icon uil uil-at"></i>
                                                <?php if (!empty($emailError)) { ?>
                                                    <div class="error-message"><?php echo $emailError; ?></div>
                                                <?php } ?>
                                            </div>
                                            <div class="form-group mt-2">
                                                <input type="password" name="logpass" class="form-style" placeholder="Your Password" id="logpass" autocomplete="off">
                                                <i class="input-icon uil uil-lock-alt"></i>
                                                <?php if (!empty($passwordError)) { ?>
                                                    <div class="error-message"><?php echo $passwordError; ?></div>
                                                <?php } ?>
                                            </div>
                                            <div class="form-group mt-2">
                                                <input type="password" name="confirm_pass" class="form-style" placeholder="Confirm Password" id="confirm_pass" autocomplete="off">
                                                <i class="input-icon uil uil-lock-alt"></i>
                                                <?php if (!empty($confirmPasswordError)) { ?>
                                                    <div class="error-message"><?php echo $confirmPasswordError; ?></div>
                                                <?php } ?>
                                            </div>
                                            <div class="form-group mt-2">
                                                <input type="text" name="userPhone" class="form-style" placeholder="Your Phone Number" id="userPhone" value="<?php echo htmlspecialchars($userPhone); ?>" autocomplete="off">
                                                <i class="input-icon uil uil-phone"></i>
                                                <?php if (!empty($userPhoneError)) { ?>
                                                    <div class="error-message"><?php echo $userPhoneError; ?></div>
                                                <?php } ?>
                                            </div>
                                            <div class="form-group mt-2">
                                                <input type="text" name="userAddress" class="form-style" placeholder="Your Address" id="userAddress" value="<?php echo htmlspecialchars($userAddress); ?>" autocomplete="off">
                                                <i class="input-icon uil uil-map-marker"></i>
                                                <?php if (!empty($userAddressError)) { ?>
                                                    <div class="error-message"><?php echo $userAddressError; ?></div>
                                                <?php } ?>
                                            </div>
                                            <button type="submit" class="btn mt-4">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require('./components/footer.php') ?>