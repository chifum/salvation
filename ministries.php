<?php 
$page = "Ministries";
include'./includes/header.php';

$conn = mysqli_connect(servername, username, password, dbname);
$sql = "SELECT * FROM maintable WHERE cat_id = 15 AND subcat_id = 4 ORDER BY id ASC LIMIT 3";
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
?>
<body>
<!-- START nav -->
<?php include'./includes/nav.php' ?>
<!-- END nav -->
	
	<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/bg_1.jpg');">
		<div class="overlay"></div>
		<div class="container">
			<div class="row no-gutters slider-text align-items-end js-fullheight">
				<div class="col-md-9 ftco-animate pb-5">
					<p class="breadcrumbs mb-2"><span class="mr-2"><a href="index.html">Home <i class="fa fa-chevron-right"></i></a></span> <span>Ministries <i class="fa fa-chevron-right"></i></span></p>
					<h1 class="mb-0 bread">Church Ministries</h1>
				</div>
			</div>
		</div>
	</section>

	<section class="ftco-section">
		<div class="container">
			<div class="row">
				<?php for($a = 0; $a < $count; $a++) { ?>
				<div class="col-md-4 ministry ftco-animate">
					<div class="img"style="background-image: url(admin/image/<?php echo $image[$a]; ?>);"></div>
					<div class="text p-4">
						<h2 class="mb-4"><a href="read_more.php?id=<?php echo $id[$a]; ?>"><?php echo $title[$a]; ?></a></h2>
						<?php
						    // strip tags to avoid breaking any html
						    $text[$a] = strip_tags($text[$a]);
						    if (strlen($text[$a]) > 100) {

					        // truncate string
					        $textCut = substr($text[$a], 0, 100);
					        $endPoint = strrpos($textCut, ' ');

					        //if the string doesn't contain any space then it will cut without word basis.
					        $text[$a] = $endPoint? substr($textCut, 0, $endPoint) : substr($textCut, 0);
					        $text[$a] .= '... <br><br><a href="read_more.php?id='.$id[$a].'" class="btn btn-primary"> Read More...</a>';
					    	}
						 ?>
						<p><?php echo $text[$a]; ?></p>
						<!-- <p><a href="sermons.html" class="btn btn-primary">More Details</a></p> -->
					</div>
				</div>
				<?php } ?>
				<!-- <div class="col-md-4 ministry ftco-animate">
					<div class="img"style="background-image: url(images/ministry-2.jpg);"></div>
					<div class="text p-4">
						<h2 class="mb-4"><a href="sermons.html">Women's Ministry</a></h2>
						<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
						<p><a href="sermons.html" class="btn btn-primary">More Details</a></p>
					</div>
				</div> -->
				<!-- <div class="col-md-4 ministry ftco-animate">
					<div class="img"style="background-image: url(images/ministry-3.jpg);"></div>
					<div class="text p-4">
						<h2 class="mb-4"><a href="sermons.html">Community Ministry</a></h2>
						<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
						<p><a href="sermons.html" class="btn btn-primary">More Details</a></p>
					</div>
				</div> -->

				<!-- <div class="col-md-4 ministry ftco-animate">
					<div class="img"style="background-image: url(images/ministry-4.jpg);"></div>
					<div class="text p-4">
						<h2 class="mb-4"><a href="sermons.html">Prison Ministry</a></h2>
						<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
						<p><a href="sermons.html" class="btn btn-primary">More Details</a></p>
					</div>
				</div> -->

				<!-- <div class="col-md-4 ministry ftco-animate">
					<div class="img"style="background-image: url(images/ministry-5.jpg);"></div>
					<div class="text p-4">
						<h2 class="mb-4"><a href="sermons.html">Family Ministry</a></h2>
						<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
						<p><a href="sermons.html" class="btn btn-primary">More Details</a></p>
					</div>
				</div> -->

				<!-- <div class="col-md-4 ministry ftco-animate">
					<div class="img"style="background-image: url(images/ministry-6.jpg);"></div>
					<div class="text p-4">
						<h2 class="mb-4"><a href="sermons.html">Music Ministry</a></h2>
						<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
						<p><a href="sermons.html" class="btn btn-primary">More Details</a></p>
					</div>
				</div> -->
			</div>
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