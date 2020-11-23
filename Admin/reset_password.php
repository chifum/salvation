<!-- START header -->
<?php include'a_includes/a_header.php' ?>
  <!-- END header -->

<?php
session_start();
require_once'../config/conn.php';

$errors = array();

$conn = mysqli_connect(servername, username, password, dbname);

  if(isset($_POST['reset_password'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $newPassword = mysqli_real_escape_string($conn, $_POST['newPassword']);
    $retypePassword = mysqli_real_escape_string($conn, $_POST['retypePassword']);
  
    if(empty($password)) {
      $errors['password'] = "Enter Current Password";
    }

    if(empty($newPassword)) {
      $errors['newPassword'] = "Enter Current Password";
    }

    if(empty($retypePassword)) {
      $errors['retypePassword'] = "Enter Confirm New Password";
    }
        
      
          $stmt = $conn->prepare("SELECT * FROM admin WHERE id = ? AND password = ? ");
          $stmt->bind_param('is', $id, $password);
          $stmt->execute();
          $result = $stmt->get_result(); // get the mysqli result
          $check_pass = $result->fetch_assoc(); // fetch data

          
          if($check_pass == 1) {
          $check_old_password = password_verify($password, $check_pass['password']);
          
          
          //die($check_pass);
          if($newPassword != $retypePassword) {
            // $errors['newPassword'] = "Password do not match!";
              echo "<script>alert('Password do not match!')</script>";
              echo"  <script>window.open('reset_password.php', '_self')</script>";
              // $msg = "Password do not match!";
              // $msgClass = 'alert-danger';
              // exit;
          }
          else {
              $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);
              $stmt = $conn->prepare("UPDATE admin SET password = ? WHERE id = ?");
              $stmt ->bind_param('si', $newPassword, $id);
              $stmt->execute();
                // echo"  <script>alert('Updated')</script>";
                // echo"  <script>window.open('index.php', '_self')</script>";
              }

              }
            
            else {
            echo " <script>alert('Wrong Password!')</script> ";
            echo"  <script>window.open('reset_password.php', '_self')</script>";
            exit;
          }
          }

        $id = $_SESSION['id'];
        $sql = "SELECT * FROM admin WHERE id = '$id'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result)) {
          $row = mysqli_fetch_assoc($result);
        }
?>

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

        
  <div class="container" style="margin-bottom: 4%;">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Reset Password</div>
      <div class="card-body">
      <?php require'../config/errors.php'; ?>
        <form action="" method="POST" >
          <div class="form-group">
            <span style="margin-bottom: 8px; display: block;">Current Password</span>
            <div class="form-label-group">
              <input type="password" name="password" class="form-control" placeholder="Email address" required="required">
              <!-- <label for="inputEmail">Current Password</label> -->
            </div>
          </div>
          <div class="form-group">
            <span style="margin-bottom: 8px; display: block;">New Password</span>
            <div class="form-label-group">
              <input type="password" name="newPassword" class="form-control" placeholder="Password" required="required">
              <!-- <label for="inputPassword">New Password</label> -->
            </div>
          </div>
          <div class="form-group">
            <span style="margin-bottom: 8px; display: block;">Retype New Password</span>
            <div class="form-label-group">
              <input type="password" name="retypePassword" class="form-control" placeholder="Retype New Password" required="required">
              <!-- <label for="inputPassword">Retype New Password</label> -->
            </div>
          </div>
          <input type="hidden" name="id" value="<?php if(isset($_SESSION['id'])) { echo($_SESSION['id']); } ?>">
          <input type="submit" name="reset_password" value="Reset Password" class="btn btn-primary btn-block">
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
