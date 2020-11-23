<?php 
$page = "Sermons";
include'./includes/header.php';
$conn = mysqli_connect(servername, username, password, dbname);

$sql = "SELECT * FROM maintable WHERE cat_id = 14 ORDER BY id ASC LIMIT 1";
$result = mysqli_query($conn, $sql);
$count = 0;
if(mysqli_num_rows($result)>$count){
  while($row = mysqli_fetch_assoc($result)) {
    $id[] = $row['id'];
    $title[] = $row['title'];
      $speaker[] = $row['speaker'];
      $topic[] = $row['topic'];
      $bible_text[] = $row['bible_text'];
      $text[] = $row['text'];
      $cat_id[] = $row['cat_id'];
      $subcat_id[]	 = $row['subcat_id'];
      $image[]	 = $row['image'];
      $created_date[]	 = date('l j F, Y', strtotime($row['created_date']) );
      $count++;
  }
}

$sql1 = "SELECT * FROM maintable WHERE cat_id = 14 ORDER BY id DESC LIMIT 1";
$result1 = mysqli_query($conn, $sql1);
$count1 = 0;
if(mysqli_num_rows($result1)>$count1){
  while($row1 = mysqli_fetch_assoc($result1)) {
    $id1[] = $row1['id'];
    $title1[] = $row1['title'];
      $speaker1[] = $row1['speaker'];
      $topic1[] = $row1['topic'];
      $bible_text1[] = $row1['bible_text'];
      $text1[] = $row1['text'];
      $cat_id1[] = $row1['cat_id'];
      $subcat_id1[]   = $row1['subcat_id'];
      $image1[]   = $row1['image'];
      $created_date[]  = date('l j F, Y', strtotime($row1['created_date']));
      $count1++;
  }

  
}
?>
<body>

<!-- START nav -->
<?php include'./includes/nav.php' ?>
<!-- END nav -->

<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/bg_1.jpg');">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end">
      <div class="col-md-9 ftco-animate pb-5">
       <p class="breadcrumbs mb-2"><span class="mr-2"><a href="index.php">Home <i class="fa fa-chevron-right"></i></a></span> <span>Sermons <i class="fa fa-chevron-right"></i></span></p>
       <h1 class="mb-0 bread">Sermons</h1>
     </div>
   </div>
 </div>
</section>

<?php for($a = 0; $a < $count; $a++) { ?>
<section class="ftco-section">
 <div class="container">
 <!-- class="img"  style="background-image: url(images/sermon-1.jpg);" -->
  <div class="row no-gutters d-flex sermon-wrap ftco-animate bg-light">
    <div class="col-md-6 d-flex align-items-stretch js-fullheight ftco-animate">
     <a href="read_more.php?id=<?php echo $id[$a]; ?>" class="img" style="background-image: url(admin/image/<?php echo $image[$a]; ?>);">
     <!-- <img class="img" src="admin/image/<?php //echo $image1[$b]; ?>"> -->
   </a>
   </div>
   <div class="col-md-6 py-4 py-md-5 ftco-animate d-flex align-items-center">
     <div class="text p-md-5">
      <h2 class="mb-4"><a href="read_more.php?id=<?php echo $id[$a]; ?>"><?php echo $title[$a]; ?></a></h2>
      <div class="meta">
       <p>
        <span>Bible Text: <a href="#" class="ptr"><?php echo $bible_text[$a]; ?></a></span>
        <span>Speaker: <a href="#" class="ptr"><?php echo $speaker[$a]; ?></a></span>
        <span>Categories: <a href="#">God</a>, <a href="#">Pray</a>, <a href="#">Faith</a></span>
        <span><a href="#">On <?php echo $created_date[$a]; ?></a></span>
      </p>
    </div>
    <?php
    // strip tags to avoid breaking any html
    $text[$a] = strip_tags($text[$a]);
    if (strlen($text[$a]) > 200) {

        // truncate string
        $textCut = substr($text[$a], 0, 200);
        $endPoint = strrpos($textCut, ' ');

        //if the string doesn't contain any space then it will cut without word basis.
        $text[$a] = $endPoint? substr($textCut, 0, $endPoint) : substr($textCut, 0);
        $text[$a] .= '... <br><br><a href="read_more.php?id='.$id[$a].'" class="btn btn-primary btn-outline-primary px-4 py-3 ml-lg-2"><span class="fa fa-download"></span> Read More...</a>';
    }
    ?>
    <p><?php //echo $text[$a]; ?></p>
    <p class="mt-4 btn-customize">
      <!-- <a href="https://vimeo.com/45830194" class="btn btn-primary px-4 py-3 mr-md-2 popup-vimeo"><span class="fa fa-play"></span> Watch Sermons</a>  -->
      <?php echo $text[$a]; ?>
    </p>
  </div>
</div>
</div>
<?php } ?>
<!-- class="img" style="background-image: url(images/sermon-2.jpg);" -->
<?php for($b = 0; $b < $count1; $b++) { ?>
<div class="row no-gutters d-flex sermon-wrap ftco-animate bg-light">
  <div class="col-md-6 d-flex align-items-stretch js-fullheight ftco-animate order-md-last">
   <a href="read_more.php?id=<?php echo $id1[$b]; ?>" class="img" style="background-image: url(admin/image/<?php echo $image1[$b]; ?>);">
     <!-- <img class="img" src="admin/image/<?php //echo $image1[$b]; ?>"> -->
   </a>
 </div>
 <div class="col-md-6 py-4 py-md-5 ftco-animate d-flex align-items-center">
   <div class="text p-md-5">
    <h2 class="mb-4"><a href="read_more.php?id=<?php echo $id1[$b]; ?>"><?php echo $title1[$b]; ?></a></h2>
    <div class="meta">
     <p>
      <span>Speaker: <a href="#" class="ptr"><?php echo $speaker1[$b]; ?></a></span>
      <span>Categories: <a href="#">God</a>, <a href="#">Pray</a>, <a href="#">Faith</a></span>
      <span><a href="#">On <?php echo $created_date[$a]; ?></a></span>
    </p>
  </div>
  <?php
    // strip tags to avoid breaking any html
    $text1[$b] = strip_tags($text1[$b]);
    if (strlen($text1[$b]) > 200) {

        // truncate string
        $textCut = substr($text1[$b], 0, 200);
        $endPoint = strrpos($textCut, ' ');

        //if the string doesn't contain any space then it will cut without word basis.
        $text1[$b] = $endPoint? substr($textCut, 0, $endPoint) : substr($textCut, 0);
        $text1[$b] .= '... <br><br><a href="read_more.php?id='.$id1[$b].'" class="btn btn-primary btn-outline-primary px-4 py-3 ml-lg-2"><span class="fa fa-download"></span> Read More...</a>';
    }
    ?>
  <p><?php echo $text1[$b]; ?></p>
  <p class="mt-4 btn-customize">
    <!-- <a href="https://vimeo.com/45830194" class="btn btn-primary px-4 py-3 mr-md-2 popup-vimeo"><span class="fa fa-play"></span> Watch Sermons</a>  -->
    <!-- <a href="#" class="btn btn-primary btn-outline-primary px-4 py-3 ml-lg-2"><span class="fa fa-download"></span> Read More..</a> -->
  </p>
</div>
</div>
</div>
<?php } ?>
<!-- <div class="row no-gutters d-flex sermon-wrap ftco-animate bg-light">
  <div class="col-md-6 d-flex align-items-stretch js-fullheight ftco-animate">
   <a href="#" class="img" style="background-image: url(images/sermon-3.jpg);"></a>
 </div>
 <div class="col-md-6 py-4 py-md-5 ftco-animate d-flex align-items-center">
   <div class="text p-md-5">
    <h2 class="mb-4"><a href="sermon.html">God Wants To Do A New Thing In Your Life</a></h2>
    <div class="meta">
     <p>
      <span>Speaker: <a href="#" class="ptr">Dr. Rolando Henderson</a></span>
      <span>Categories: <a href="#">God</a>, <a href="#">Pray</a>, <a href="#">Faith</a></span>
      <span><a href="#">On Sunday 13 Jan, 2019</a></span>
    </p>
  </div>
  <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
  <p class="mt-4 btn-customize">
    <a href="https://vimeo.com/45830194" class="btn btn-primary px-4 py-3 mr-md-2 popup-vimeo"><span class="fa fa-play"></span> Watch Sermons</a> <a href="#" class="btn btn-primary btn-outline-primary px-4 py-3 ml-lg-2"><span class="fa fa-download"></span> Download Sermons</a>
  </p>
</div>
</div>
</div> -->

<!-- <div class="row no-gutters d-flex sermon-wrap ftco-animate bg-light">
  <div class="col-md-6 d-flex align-items-stretch js-fullheight ftco-animate order-md-last">
   <a href="#" class="img" style="background-image: url(images/sermon-4.jpg);"></a>
 </div>
 <div class="col-md-6 py-4 py-md-5 ftco-animate d-flex align-items-center">
   <div class="text p-md-5">
    <h2 class="mb-4"><a href="sermon.html">God Wants To Do A New Thing In Your Life</a></h2>
    <div class="meta">
     <p>
      <span>Speaker: <a href="#" class="ptr">Dr. Rolando Henderson</a></span>
      <span>Categories: <a href="#">God</a>, <a href="#">Pray</a>, <a href="#">Faith</a></span>
      <span><a href="#">On Sunday 13 Jan, 2019</a></span>
    </p>
  </div>
  <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
  <p class="mt-4 btn-customize">
    <a href="https://vimeo.com/45830194" class="btn btn-primary px-4 py-3 mr-md-2 popup-vimeo"><span class="fa fa-play"></span> Watch Sermons</a> <a href="#" class="btn btn-primary btn-outline-primary px-4 py-3 ml-lg-2"><span class="fa fa-download"></span> Download Sermons</a>
  </p>
</div>
</div>
</div> -->

<!-- <div class="row no-gutters d-flex sermon-wrap ftco-animate bg-light">
  <div class="col-md-6 d-flex align-items-stretch js-fullheight ftco-animate">
   <a href="#" class="img" style="background-image: url(images/sermon-5.jpg);"></a>
 </div>
 <div class="col-md-6 py-4 py-md-5 ftco-animate d-flex align-items-center">
   <div class="text p-md-5">
    <h2 class="mb-4"><a href="sermon.html">God Wants To Do A New Thing In Your Life</a></h2>
    <div class="meta">
     <p>
      <span>Speaker: <a href="#" class="ptr">Dr. Rolando Henderson</a></span>
      <span>Categories: <a href="#">God</a>, <a href="#">Pray</a>, <a href="#">Faith</a></span>
      <span><a href="#">On Sunday 13 Jan, 2019</a></span>
    </p>
  </div>
  <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
  <p class="mt-4 btn-customize">
    <a href="https://vimeo.com/45830194" class="btn btn-primary px-4 py-3 mr-md-2 popup-vimeo"><span class="fa fa-play"></span> Watch Sermons</a> <a href="#" class="btn btn-primary btn-outline-primary px-4 py-3 ml-lg-2"><span class="fa fa-download"></span> Download Sermons</a>
  </p>
</div>
</div>
</div> -->



<!-- <div class="row mt-5">
  <div class="col text-center">
    <div class="block-27">
      <ul>
        <li><a href="#">&lt;</a></li>
        <li class="active"><span>1</span></li>
        <li><a href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#">4</a></li>
        <li><a href="#">5</a></li>
        <li><a href="#">&gt;</a></li>
      </ul>
    </div>
  </div>
</div> -->
</div>
</section>

<!-- START footer -->
<?php include'./includes/footer.php' ?>
<!-- END footer -->



<!-- loader -->
<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


<script src="js/jquery.min.js"></script>
<script src="js/jquery-migrate-3.0.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.easing.1.3.js"></script>
<script src="js/jquery.waypoints.min.js"></script>
<script src="js/jquery.stellar.min.js"></script>
<script src="js/jquery.animateNumber.min.js"></script>
<script src="js/bootstrap-datepicker.js"></script>
<script src="js/jquery.timepicker.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/scrollax.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
<script src="js/google-map.js"></script>
<script src="js/main.js"></script>

</body>
</html>