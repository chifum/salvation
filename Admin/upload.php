<?php 
session_start();
require_once'../config/conn.php';

if(!isset($_SESSION['username'])) {
  header("location:login.php");
}

$conn = mysqli_connect(servername, username, password, dbname);

$errors = array();
$successes = array();

$sql = "SELECT * FROM categories ORDER BY cat_id DESC";
$result = mysqli_query($conn, $sql);
$count = 0;
if(mysqli_num_rows($result)>$count){
  while($row = mysqli_fetch_assoc($result)) {
    $cat_id[] = $row["cat_id"];
    $category[] = $row["category"];
    $count++;
  }
}

$sql0 = "SELECT * FROM subcategories ORDER BY subcat_id DESC";
$result0 = mysqli_query($conn, $sql0);
$count0 = 0;
if(mysqli_num_rows($result0)>$count0){
  while($row = mysqli_fetch_assoc($result0)) {
    $subcat_id[] = $row["subcat_id"];
    $subcategory[] = $row["subcategory"];
    $count0++;
  }
}

  if(isset($_POST['upload'])) {
    $title = htmlspecialchars(trim(stripcslashes($_POST['title'])));
    $speaker = htmlspecialchars(trim(stripcslashes($_POST['speaker'])));
    $topic = htmlspecialchars(trim(stripcslashes($_POST['topic'])));
    $bible_text = htmlspecialchars(trim(stripcslashes($_POST['bible_text'])));
    $text = htmlspecialchars(trim(stripcslashes($_POST['text'])));
    $cat_id = htmlspecialchars(trim(stripcslashes($_POST['cat_id'])));
    $subcat_id = htmlspecialchars(trim(stripcslashes($_POST['subcat_id'])));
    $image = htmlspecialchars(trim(stripcslashes($_FILES['image']['name'])));
    $e = 'image/'.$image;
    $g = move_uploaded_file($_FILES['image']['tmp_name'],$e);

    //Check file size
    // if($_FILES["image"]["size"] > 500000) {
    //     $errors["image"] = "Sorry, your file is too large.";
    //     $uploadOk = 0;
    // }

    // Allow certain file formats
    // if($image != "jpg" && $image != "png" && $image != "jpeg" && $image != "gif" ) {
    //     $errors['image'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    //     $uploadOk = 0;
    // }

    if(empty($title)) {$errors['title'] = "Title is required";}
    if(empty($speaker)) {$errors['speaker'] = "Speaker is required";}
    if(empty($topic)) {$errors['topic'] = "Topic is required";}
    if(empty($bible_text)) {$errors['bible_text'] = "Bible text is required";}
    if(empty($text)) {$errors['text'] = "Message is required";}

  // Finally, add user if there are no errors in the form
    if (count($errors) === 0) {
        $sql =  "INSERT INTO maintable (title, speaker, topic, bible_text, text, cat_id, subcat_id, created_date, image) VALUES(?, ?, ?, ?, ?, ?, ?, NOW(), ?)";
        //var_dump($sql);
        $stmt = $conn->prepare($sql);
        //Bind the parameters to the placeholder
        $stmt->bind_param("ssssssss", $title, $speaker, $topic, $bible_text, $text, $cat_id, $subcat_id, $image);
        //Execute the statement
        if ($stmt->execute()) {

            $successes['success'] = "<strong>Content uploaded successfully</strong>";
        } 
        else {
            $errors['failed'] = "<strong>Failed to uploaded content</strong>";
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
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Upload</a>
      </li>
      <li class="breadcrumb-item active">Overview</li>
    </ol>

  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Upload Content</div>
      <div class="card-body">
      <?php require'../config/errors.php'; ?>
        <form action="upload.php" method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-3">
                <span style="padding-bottom: 2%; display: block;">Image</span>
                <div class="form-label-group">
                  <input type="file" name="image" class="form-control">
                </div>
              </div>

              <div class="col-md-3">
                <span style="padding-bottom: 2%; display: block;">Title</span>
                <div class="form-label-group">
                  <input type="text" id="" class="form-control" name="title" value="<?php if(isset($title)) { echo $title ;} ?>">
                </div>
              </div>

              <div class="col-md-3">
                <span style="padding-bottom: 2%; display: block;">Speaker</span>
                <div class="form-label-group">
                  <input type="text" id="" class="form-control" name="speaker" value="<?php if(isset($speaker)) { echo $speaker ;} ?>">
                </div>
              </div>

              <div class="col-md-3">
                <span style="padding-bottom: 2%; display: block;">Topic</span>
                <div class="form-label-group">
                  <input type="text" id="" class="form-control" name="topic" value="<?php if(isset($topic)) { echo $topic ;} ?>">
                </div>
              </div>

            </div>
          </div>

          <div class="form-group">
            <div class="form-row">

              <div class="col-md-3">
                <span style="padding-bottom: 2%; display: block;">Bible Text</span>
                <div class="form-label-group">
                  <input type="text" id="" class="form-control" name="bible_text" value="<?php if(isset($bible_text)) { echo $bible_text ;} ?>">
                </div>
              </div>

              <div class="col-md-3">
                <span style="padding-bottom: 2%; display: block;">Message</span>
                <div class="form-label-group">
                  <input type="text" id="" class="form-control" name="text"  value="<?php if(isset($text)) { echo $text ;} ?>">
                </div>
              </div>

              <div class="col-md-3">
                <span style="padding-bottom: 2%; display: block;">Category</span>
                <div class="form-label-group">
                <select class="form-control" name="cat_id">
                    <option value="">- Choose Cateogry -</option>
                    <?php for($a = 0; $a < $count; $a++){?>
                      <option value="<?php echo $cat_id[$a] ?>"><?php echo $category[$a]?></option>
                    <?php }?>
                  </select>
                </div>
              </div>

              <div class="col-md-3">
                <span style="padding-bottom: 2%; display: block;">Subcategory</span>
                <div class="form-label-group">
                <select class="form-control" name="subcat_id">
                    <option value="">- Choose Subcateogry -</option>
                    <?php for($b = 0; $b < $count0; $b++){?>
                      <option value="<?php echo $subcat_id[$b] ?>"><?php echo $subcategory[$b]?></option>
                    <?php }?>
                  </select>
                </div>
              </div>

            </div>
          </div>
          <!-- <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <span style="padding-bottom: 2%; display: block;">Speaker</span>
                <div class="form-label-group">
                  <input type="text" id="" class="form-control" name="speaker" required="required" autofocus="autofocus" value="<?php //if(isset($speaker)) { echo $speaker ;} ?>">     
                </div>
              </div>
              <div class="col-md-6">
                <span style="padding-bottom: 2%; display: block;">Topic</span>
                <div class="form-label-group">
                  <input type="text" id="" class="form-control" name="topic" required="required" value="<?php //if(isset($topic)) { echo $topic ;} ?>">
                </div>
              </div>
            </div>
          </div> -->
          <!-- <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <span style="padding-bottom: 2%; display: block;">Bible Text</span>
                <div class="form-label-group">
                  <input type="text" id="" class="form-control" name="bible_text" required="required" autofocus="autofocus" value="<?php //if(isset($bible_text)) { echo $bible_text ;} ?>">                
                </div>
              </div>
              <div class="col-md-6">
                <span style="padding-bottom: 2%; display: block;">Message</span>
                <div class="form-label-group">
                  <input type="text" id="" class="form-control" name="text" required="required" value="<?php //if(isset($text)) { echo $text ;} ?>">
                </div>
              </div>
            </div>
          </div> -->
          <!-- <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <span style="padding-bottom: 2%; display: block;">Category</span>
                <div class="form-label-group">
                  <select class="form-control" required="required" name="cat_id">
                    <option value="">- Choose Cateogry -</option>
                    <?php //for($a = 0; $a < $count; $a++){ ?>
                      <option value="<?php //echo $cat_id[$a] ?>"><?php //echo $category[$a]?></option>
                    <select class="form-control" required="required" name="subcat_id">
                    <option value="">- Choose Subcateogry -</option>
                    <?php //for($b = 0; $b < $count0; $b++){?>
                      <option value="<?php //echo $subcat_id[$b] ?>"><?php //echo $subcategory[$b]?></option>
                    <?php //} ?>
                  </select>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <span style="padding-bottom: 2%; display: block;">Subcategory</span>
                <div class="form-label-group">
                  <select class="form-control" required="required" name="subcat_id">
                    <option value="">- Choose Subcateogry -</option>
                    <?php //for($b = 0; $b < $count0; $b++){?>
                      <option value="<?php //echo $subcat_id[$b] ?>"><?php //echo $subcategory[$b]?></option>
                    <?php //} ?>
                  </select>
                </div>
              </div>
            </div>
          </div> -->
          <button type="submit" name="upload" class="btn btn-primary btn-block">Upload</button>
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
