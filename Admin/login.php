<?php
session_start();
require_once'../config/conn.php';
$conn = mysqli_connect(servername, username, password, dbname);
// $msg = "";
// $msgClass = "";
// // LOGIN USER
// if (isset($_POST['login_user'])) {
//   $username = mysqli_real_escape_string($conn, $_POST['username']);
//   $password = mysqli_real_escape_string($conn, $_POST['password']);

// //Validation
//   if(empty($username)) { 
//     $msg = "Username filed is required";
//     $msgClass = 'alert-danger';
//   }

//   elseif(empty($password)) {
//     $msg = "Password filed is required";
//     $msgClass = 'alert-danger';
//   }

//   if(!preg_match("/^[a-zA-Z ]*$/", $username)){
//     $msg = "Only letters and white space allowed";
//     $msgClass = 'alert-danger';
//   }

// // Prepare our SQL, preparing the SQL statement will prevent SQL injection.
// $stmt = $conn->prepare('SELECT * FROM admin WHERE username = ? AND password = ?');
//   // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
//   $stmt->bind_param('ss', $_POST['username'], $_POST['password']);
//   $stmt->execute();
//   // Store the result so we can check if the account exists in the database.
//   // $stmt->get_result();
//   $result = $stmt->get_result();
//   $user = $result->fetch_assoc();

//   // Account exists, now we verify the password.
//   // Note: remember to use password_hash in your registration file to store the hashed passwords.
//   if (password_verify($password, $user['password'], $password)) {
//     // Verification success! User has loggedin!
//     // Create sessions so we know the user is logged in, they basically act like cookies but remember the data on the server.
//     session_regenerate_id();
//     $_SESSION['loggedin'] = TRUE;
//     $_SESSION['username'] = $_POST['username'];
//     $_SESSION['id'] = $id;
//     // echo 'Welcome ' . $_SESSION['name'] . '!';
//     header("Location:index.php");
//   } 
//   // else {
//   //   // Incorrect password
//   //   $msg = "Username or Password is incorrect";
//   //   $msgClass = 'alert-danger';
//   // } 
// else {
//   // Incorrect username
//   $msg = "Username or Password is incorrect";
//   $msgClass = 'alert-danger';
//   }
// }


$errors =array();
$successes = array();
// LOGIN
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);

    if(empty($username)) { $errors['username'] = "Email required";}
    if(empty($password)) { $errors['password'] = "Password required";}

    if (count($errors) === 0) {
        $query = "SELECT * FROM admin WHERE username = ? LIMIT 1";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->bind_result($id, $username, $password);
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        

        if(password_verify($password, $user['password'])) { // if password matches
              //login success
              $_SESSION['id'] = $user['id'];
              $_SESSION['username'] = $user['username'];
              //$_SESSION['password'] = $user['password'];

            //   $_SESSION['message'] = "Category uploaded successfully";
            // $_SESSION['alert-class'] = "alert-success";

              // $_SESSION['message'] = 'You are logged in!';
              // $_SESSION['alert-class'] = 'alert-success';
              header('location: index.php');
              exit();
            } 
            else { // if password does not match
                $errors['login_fail'] = "Wrong username / password";
                // $errors['login_fail'] = "Wrong username / password";
            }

            }
        // else {
        //     $msg = "Database error. Login failed!";
        //     $msgClass = "alert-danger";
        //     // $_SESSION['message'] = "Database error. Login failed!";
        //     //$_SESSION['type'] = "alert-danger";
        // }
    // }
}
 ?>
<!-- START header -->
  <?php include'a_includes/a_header.php' ?>
  <!-- END header -->

<body class="bg-dark">

  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Login</div>
      <div class="card-body">
        <?php //if($msg != ''): ?>
        <!-- <div class="alert <?php //echo $msgClass; ?>"><?php //echo $msg; ?></div> -->
        <?php //endif; ?>
        <?php include'../config/errors.php'; ?>
        <form action="login.php" method="POST">
          <div class="form-group">
            <div class="form-label-group">
              <input type="text" name="username" id="inputEmail" class="form-control" placeholder="Username" required="required" autofocus="autofocus">
              <label for="inputEmail">Email address</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required="required">
              <label for="inputPassword">Password</label>
            </div>
          </div>
          <button type="submit" name="login_user" class="btn btn-primary btn-block">Login</button>
        </form>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>
