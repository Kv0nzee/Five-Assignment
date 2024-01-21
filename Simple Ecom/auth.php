<?php
      require_once("navbar.php");
  
      // Initialize variables for form values and errors
      $fullName = $email = $password = $confirmPassword = "";
      $fullNameError = $emailError = $passwordError = $confirmPasswordError = "";
  
      // Check if the form is submitted
      if ($_SERVER["REQUEST_METHOD"] === "POST") {
          if (isset($_POST["logname"]) && $_POST["confirm_pass"]) {
              // Process signup logic
              $fullName = $_POST["logname"];
              $email = $_POST["logemail"];
              $password = $_POST["logpass"];
              $confirmPassword = $_POST["confirm_pass"];
  
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
  
              if (empty($fullNameError) && empty($emailError) && empty($passwordError) && empty($confirmPasswordError)) {
                  // Assuming you have a 'users' table in your database
                  $insert_sql = "INSERT INTO users (name, email, password, type) VALUES (?, ?, ?, ?)";
                  $stmt = $pdo->prepare($insert_sql);
                  
                  if ($stmt->execute([$fullName, $email, password_hash($password, PASSWORD_DEFAULT), 'user'])) {
                      $user = $stmt->fetch(PDO::FETCH_OBJ);
                      $_SESSION['user'] =  $user;
                      header("Location: userProductView.php");
                      exit();
                  } else {
                      echo "Error creating user.";
                  }
              }
              else{
                die('fdsaf');
              }
          } else {
            $email = $_POST["logemail"];
            $password = $_POST["logpass"];
        
            // Validate and authenticate user
            $select_sql = "SELECT * FROM users WHERE email = ?";
            $stmt = $pdo->prepare($select_sql);
            if ($stmt->execute([$email])) {
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($user) {
                    // Verify password during login
                    $check = password_verify($password, $user['password']);
                    if ($check) {
                        // Authentication successful
                        $_SESSION['user'] =  $user;
                        header("Location: userProductView.php");
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

   

    <div class="section">
        <div class="container">
            <div class="row full-height justify-content-center">
                <div class="col-12 text-center align-self-center py-5">
                    <div class="section pb-5 pt-5 pt-sm-2 text-center">
                        <h6 class="mb-0 pb-3"><span>Log In </span><span>Sign Up</span></h6>
                        <input class="checkbox" type="checkbox" id="reg-log" name="reg-log" />
                        <label for="reg-log"></label>
                        <div class="card-3d-wrap mx-auto">
                            <div class="card-3d-wrapper">
                                <div class="card-front">
                                    <div class="center-wrap">
                                        <div class="section text-center">
                                            <h4 class="mb-4 pb-3">Log In</h4>
                                            <form method="post" action="">
                                                <div class="form-group">
                                                    <input type="email" name="logemail" class="form-style" placeholder="Your Email" id="logemail" autocomplete="off">
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
                                            <h4 class="mb-4 pb-3">Sign Up</h4>
                                            <form method="post" action="">
                                                <div class="form-group">
                                                    <input type="text" name="logname" class="form-style" placeholder="Your Full Name" id="logname" autocomplete="off">
                                                    <i class="input-icon uil uil-user"></i>
                                                    <?php if (!empty($fullNameError)) { ?>
                                                        <div class="error-message"><?php echo $fullNameError; ?></div>
                                                    <?php } ?>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="email" name="logemail" class="form-style" placeholder="Your Email" id="logemail" autocomplete="off">
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

