<?php 
session_start();
require_once'../config/conn.php';

if(!isset($_SESSION['username'])) {
  header("location:login.php");
}

$conn = mysqli_connect(servername, username, password, dbname);

$errors = array();
$successes = array();

  if(isset($_POST['add-subcategory'])) {
    $subcategory = htmlspecialchars(trim(stripcslashes($_POST['subcategory'])));

    if(empty($subcategory)) {
      $errors['subcategory'] = "subcategory is required";
    }

    if(!preg_match('/^[a-zA-Z]*$/', $subcategory)) {
      $errors['subcategory'] = "Only letters and white space is allowed";
    }

    $user_check_query = "SELECT * FROM subcategories WHERE subcategory = ? ";
    //Create a prepared statement
    $stmt = $conn->prepare($user_check_query);
    //Bind the parameters to the placeholder
    $stmt->bind_param('s', $subcategory);
    //Execute the statement
    $stmt->execute();

    $result = $stmt->get_result();
    $user = mysqli_fetch_assoc($result);
    $stmt->close();

    if ($user) { // if user already exists
        if ($user['subcategory'] === $subcategory) {
            $errors['subcategory'] = "subcategory name already exists";
        }
    }
  // Finally, add user if there are no errors in the form
    if (count($errors) === 0) {
        //Create a prepared statement
        $sql =  "INSERT INTO subcategories (subcategory) VALUES(?)";
        $stmt = $conn->prepare($sql);
        //Bind the parameters to the placeholder
        $stmt->bind_param("s", $subcategory);
        //Execute the statement
        if ($stmt->execute()) {

          $successes['success'] = "<strong>subcategory uploaded successfully</strong>";
        } 
        else {
          $errors['failed'] = "<strong>Failed to uploaded subcategory</strong>";
        }
        
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
            <a href="#">Sub subcategory</a>
          </li>
          <li class="breadcrumb-item active">Overview</li>
        </ol>

        
        <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Add Subcategory</div>
      <div class="card-body">
      <?php require'../config/errors.php'; ?>
        <form action="sub-category.php" method="POST" >
          <div class="form-group">
            <span style="padding-bottom: 2%; display: block;">subcategory</span>
            <div class="form-label-group">
              <input type="text" name="subcategory" value="" id="inputEmail" class="form-control" placeholder="Email address">
              <!-- <label for="inputEmail">Username</label> -->
            </div>
          </div>
          <input type="submit" name="add-subcategory" value="Add Subcategory" class="btn btn-primary btn-block">
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

  <!-- Scroll to Top Button-->
  <!-- <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a> -->

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
          <a class="btn btn-primary" href="logout.php">Logout</a>
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
