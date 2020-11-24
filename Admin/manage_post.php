<?php
session_start();
require_once'../config/conn.php';

if(!isset($_SESSION['username'])) {
  header("location:login.php");
}
//$sender_id = $_SESSION['customer_id'];
$conn = mysqli_connect(servername, username, password, dbname);
$errors = array();
$sql = "SELECT id, title FROM maintable";
$result = mysqli_query($conn, $sql);
$count = 0;
if(mysqli_num_rows($result)>$count) { // I 'i' use instead of count var
  while($row = mysqli_fetch_assoc($result)) {
    $title[] = $row['title'];
    $id[] = $row['id'];
    //$acc_num[] = $row['acc_num'];
    //$balance[] = $row['balance'];
    $count++;
  }

  // $sql = "SELECT balance FROM passbook".$sender_id."";
  //   $result = mysqli_query($conn, $sql);
  //   $count = 0;
  //  if (mysqli_num_rows($result) >$count) {
  //      while ($row = mysqli_fetch_assoc($result)) {
  //          $balance[] = $row["balance"];
  //          $count++;
  //      }
  //  }
}

// $sql2 = "SELECT balance FROM passbook".$sender_id."";
//     $result2 = mysqli_query($conn, $sql2);
//    if (mysqli_num_rows($result)) {
//        while ($row2 = mysqli_fetch_assoc($result2)) {
//            $balance = $row2["balance"];
//        }
//    }

// $sql0 = "SELECT MAX(customer_id) FROM customers";
// $result = $conn->query($sql0);
// $row = $result->fetch_assoc();
// $id = $row["MAX(customer_id)"] + 1;

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
          <li class="breadcrumb-item active">Manage Clients</li>
        </ol>

        <div class="flex-container">
        <?php for($a = 0; $a<$count; $a++) { ?>
        <div class="flex-item">
                  <div class="flex-item-1">
                      <p id="id"><?php echo $id[$a] . "."; ?></p>
                  </div>
                  <div class="flex-item-2">
                      <p id="name"><?php echo $title[$a]; ?></p>
                      <!-- <p id="acno">Ac/No : <?php //echo $acc_num[$a]; ?></p> -->
                      <!-- <p style="margin-left: 20px; color: #212121; font-size: 20px; font-family: Roboto-Regular; margin-top: -25px;">Available Balance $<?php //echo $balance[$a]; ?></p> -->
                  </div>
                    <div class="flex-item-1">
                        <div class="dropdown">
                              <button onclick="dropdown_func(<?php echo $id[$a] ?>)" class="dropbtn"></button>
                          <div id="dropdown<?php echo $id[$a] ?>" class="dropdown-content">
                              <!--Pass the customer trans_id as a get variable in the link-->
                              <a href="manage_post.php?id=<?php echo $id[$a]; ?>">View / Edit</a>
                              <!-- <a href="http://localhost/net-banking/transactions.php?cust_id=6">Transactions</a> -->
                              <a href="delete.php?id=<?php echo $id[$a]; ?>" onclick="return confirm(&#39;Are you sure?&#39;)">Delete</a>
                          </div>
                        </div>
                    </div>
                </div>
                <?php 
                    // display the links to the pages
                    //for ($page=1;$page<=$number_of_pages;$page++) {
                      //echo '<a href="manage_customers.php?page=' . $page . '">' . $page . '</a> ';
                    //}
                 ?>
        <?php } ?>        
        </div>

        <?php
          // $conn = mysqli_connect(servername, username, password, dbname);
          // // define how many results you want per page
          // $results_per_page = 2;

          // // find out the number of results stored in database
          // $sql = "SELECT * FROM customers";
          // $result = mysqli_query($conn, $sql);
          // $number_of_results = mysqli_num_rows($result);

          // // determine number of total pages available
          // $number_of_pages = ceil($number_of_results/$results_per_page);

          // // determine which page number visitor is currently on
          // if (!isset($_GET['page'])) {
          //   $page = 1;
          // } else {
          //   $page = $_GET['page'];
          // }

          // determine the sql LIMIT starting number for the results on the displaying page
          // $this_page_first_result = ($page-1)*$results_per_page;

          // // retrieve selected results from database and display them on page
          // $sql='SELECT * FROM customers LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
          // $result = mysqli_query($conn, $sql);

          // while($row = mysqli_fetch_array($result)) {
          //   echo $row['customer_id'] . ' ' . $row['fullName']. '<br>';
          // }

          // // display the links to the pages
          // for ($page=1;$page<=$number_of_pages;$page++) {
          //   echo '<a href="manage_customers.php?page=' . $page . '">' . $page . '</a> ';
          // }
        ?>
          <div class="container">
            <?php //for ($page=1;$page<=$number_of_pages;$page++) { ?>     
            <ul class="pagination justify-content-end">
              <!-- <?php //echo 'li class="page-item"><a class="page-link" href="manage_customers.php?page=' . $page . '">' . $page . '</a></li> '; ?> -->
              <!-- <li class="page-item"><a class="page-link" href="javascript:void(0);">Previous</a></li> -->
              <!-- <li class="page-item"><a class="page-link" href="javascript:void(0);">1</a></li>
              <li class="page-item"><a class="page-link" href="javascript:void(0);">2</a></li>
              <li class="page-item"><a class="page-link" href="javascript:void(0);">Next</a></li> -->
            </ul>
            <?php //} ?>
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
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

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

  <script>
    /*  The problem with lots of menus sharing same anchor(dropdown-content) is that clicking on
        any of the buttons produces the same output as clicking the first button. Thus only the
        menu associated with the first button opens. This is BIG PROBLEM when we have lots of menus
        inside the while-loop.
        Hence, solve this problem using dynamic naming to create different anchors for different
        buttons.
        This is a proper solution and NOT a hack/workaround */
    function dropdown_func(count) {
        // Dynamic naming of the dropdown #id
        var doc_id = "dropdown".concat(count.toString());

        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;

        // Close any menus, if opened, before opening a new one
        for (count = 0; count < dropdowns.length; count++) {
            var openDropdown = dropdowns[count];
            if (openDropdown.classList.contains('show')) {
              openDropdown.classList.remove('show');
            }
        }

        document.getElementById(doc_id).classList.toggle("show");
        return false;
    }

    // Close the dropdown if the user clicks outside of it
    window.onclick = function(event) {
      if (!event.target.matches('.dropbtn')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        var count;

        for (count = 0; count < dropdowns.length; count++) {
          var openDropdown = dropdowns[count];
          if (openDropdown.classList.contains('show')) {
            openDropdown.classList.remove('show');
          }
        }
      }
    }
    </script>

</body>

</html>
