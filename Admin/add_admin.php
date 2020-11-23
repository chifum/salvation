<?php
session_start();
require_once'../config/conn.php';

$conn = mysqli_connect(servername, username, password, dbname);

$errors = array();

  if(isset($_POST['submit'])) {
    $username = htmlspecialchars(trim(stripcslashes($_POST['username'])));
    $password = htmlspecialchars(trim(stripcslashes($_POST['password'])));
    $cpassword = htmlspecialchars(trim(stripcslashes($_POST['cpassword'])));
    // $password = htmlspecialchars(trim(stripcslashes($_POST['password'])));
    if($password !== $cpassword) {
      $errors['password'] = "The two password do not match";
    }

    if(empty($username)) {
      $errors['username'] = "Username is required";
    }

    if(!preg_match('/^[a-zA-Z]*$/', $username)) {
      $errors['username'] = "Only letters and white space is allowed";
    }

    if(empty($password)) {
      $errors['password'] = "Password is required";
    }

    if(empty($cpassword)) {
      $errors['cpassword'] = "Confirm password is required";
    }

    $user_check_query = "SELECT * FROM admin WHERE username = ? ";
    //Create a prepared statement
    $stmt = $conn->prepare($user_check_query);
    //Bind the parameters to the placeholder
    $stmt->bind_param('s', $username);
    //Execute the statement
    $stmt->execute();

    $result = $stmt->get_result();
    $user = mysqli_fetch_assoc($result);
    $stmt->close();

    if ($user) { // if user already exists
        if ($user['username'] === $username) {
            $errors['username'] = "Username already exists";
        }
    }
    $password = password_hash($password, PASSWORD_DEFAULT);//encrypt the password before saving in the database
  // Finally, add user if there are no errors in the form
    if (count($errors) === 0) {
        //Create a prepared statement
        $sql =  "INSERT INTO admin (username, password) VALUES(?,?)";
        $stmt = $conn->prepare($sql);
        //Bind the parameters to the placeholder
        $stmt->bind_param("ss", $username, $password);
        //Execute the statement
        if ($stmt->execute()) {
            echo "<script>alert('New admin have been created successfully, Thanks!!')</script>";
          // exit();
        } 
        else {
            die('Failed to register ' .mysqli_error($conn));
        }
        // }
      }
    }
?>
<!-- START header -->
  <?php include'a_includes/a_header.php' ?>
  <!-- END header -->
<body id="page-top">

  <!-- START nav -->
  <?php include'a_includes/a_nav.php' ?>
  <!-- END nav -->

  <div id="wrapper">

  <!-- START sidebar -->
  <?php include'a_includes/a_sidebar.php' ?>
  <!-- END sidebar -->

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Overview</li>
        </ol>

        
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Add Another Admin</div>
      <div class="card-body">
      <?php require'../config/errors.php'; ?>
        <form action="add_admin.php" method="POST" >
          <div class="form-group">
            <span style="padding-bottom: 2%; display: block;">Username</span>
            <div class="form-label-group">
              <input type="text" name="username" value="<?php if(isset($username)) { echo $username;} ?>" id="inputEmail" class="form-control" placeholder="Email address" required="required">
              <!-- <label for="inputEmail">Username</label> -->
            </div>
          </div>
          <div class="form-group">
            <span style="padding-bottom: 2%; display: block;">Password</span>
            <div class="form-label-group">
              <input type="password" name="password" class="form-control" placeholder="Password" required="required">
              <!-- <label for="inputPassword">Password</label> -->
            </div>
          </div>
          <div class="form-group">
            <span style="padding-bottom: 2%; display: block;">Confirm Password</span>
            <div class="form-label-group">
              <input type="password" name="cpassword" class="form-control" placeholder="Password" required="required">
              <!-- <label for="inputPassword">Confirm Password</label> -->
            </div>
          </div>
          <input type="submit" name="submit" value="Submit" class="btn btn-primary btn-block">
        </form>
      </div>
    </div>
  </div>


      <!-- Sticky Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright © Your Website 2019</span>
          </div>
        </div>
      </footer>

    </div>
    <!-- /.content-wrapper -->

  </div>
</div>
  <!-- /#wrapper -->


  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="vendor/chart.js/Chart.min.js"></script>
  <script src="vendor/datatables/jquery.dataTables.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="js/demo/datatables-demo.js"></script>
  <script src="js/demo/chart-area-demo.js"></script>

</body>

</html>
