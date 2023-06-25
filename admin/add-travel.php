<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.php');
} else {
	if (isset($_POST['submit'])) {
		$tname = $_POST['travelname'];
		$ttype = $_POST['traveltype'];
		$tnumber = $_POST['travelnumber'];
		$tfromto = $_POST['travelfromto'];
		$taddress = $_POST['traveladdress'];
		$tprice = $_POST['travelprice'];
		$tfeatures = $_POST['travelfeatures'];
		$tdetails = $_POST['traveldetails'];
		$timage = $_FILES["travelimage"]["name"];
		move_uploaded_file($_FILES["travelimage"]["tmp_name"], "travelimages/" . $_FILES["travelimage"]["name"]);
		$sql = "INSERT INTO TblTravel(TravelName,TravelType,VehicalNumber,TravelFromto,TravelAddress,TravelPrice,TravelFeatures,TravelDetails,TravelImage) VALUES(:tname,:ttype,:tnumber,:tfromto,:taddress,:tprice,:tfeatures,:tdetails,:timage)";
		$query = $dbh->prepare($sql);
		$query->bindParam(':tname', $tname, PDO::PARAM_STR);
		$query->bindParam(':ttype', $ttype, PDO::PARAM_STR);
		$query->bindParam(':tnumber', $tnumber, PDO::PARAM_STR);
		$query->bindParam(':tfromto', $tfromto, PDO::PARAM_STR);
		$query->bindParam(':taddress', $taddress, PDO::PARAM_STR);
		$query->bindParam(':tprice', $tprice, PDO::PARAM_STR);
		$query->bindParam(':tfeatures', $tfeatures, PDO::PARAM_STR);
		$query->bindParam(':tdetails', $tdetails, PDO::PARAM_STR);
		$query->bindParam(':timage', $timage, PDO::PARAM_STR);
		$query->execute();
		$lastInsertId = $dbh->lastInsertId();
		if ($lastInsertId) {
			$msg = "Package Created Successfully";
		} else {
			$error = "Something went wrong. Please try again";
		}
	}

?>
	<!DOCTYPE HTML>
	<html>

	<head>
		<title>T&TMS | Admin Add Travel</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="Pooled Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
		<script type="application/x-javascript">
			addEventListener("load", function() {
				setTimeout(hideURLbar, 0);
			}, false);

			function hideURLbar() {
				window.scrollTo(0, 1);
			}
		</script>
		<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
		<link href="css/style.css" rel='stylesheet' type='text/css' />
		<link rel="stylesheet" href="css/morris.css" type="text/css" />
		<link href="css/font-awesome.css" rel="stylesheet">
		<script src="js/jquery-2.1.4.min.js"></script>
		<link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css' />
		<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
		<style>
			.errorWrap {
				padding: 10px;
				margin: 0 0 20px 0;
				background: #fff;
				border-left: 4px solid #dd3d36;
				-webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
				box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
			}

			.succWrap {
				padding: 10px;
				margin: 0 0 20px 0;
				background: #fff;
				border-left: 4px solid #5cb85c;
				-webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
				box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
			}
		</style>

	</head>

	<body>
		<div class="page-container">
			<!--/content-inner-->
			<div class="left-content">
				<div class="mother-grid-inner">
					<!--header start here-->
					<?php include('includes/header.php'); ?>

					<div class="clearfix"> </div>
				</div>
				<!--heder end here-->
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="index.html">Home</a><i class="fa fa-angle-right"></i>Add Travel</li>
				</ol>
				<!--grid-->
				<div class="grid-form">

					<!---->
					<div class="grid-form1">
						<h3>Add a Travel</h3>
						<?php if ($error) { ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>
						<div class="tab-content">
							<div class="tab-pane active" id="horizontal-form">
								<form class="form-horizontal" name="travel" method="post" enctype="multipart/form-data">
									<div class="form-group">
										<label for="focusedinput" class="col-sm-2 control-label">Travel Name</label>
										<div class="col-sm-8">
											<input type="text" class="form-control1" name="travelname" id="travelname" placeholder="Travel Name" required>
										</div>
									</div>
									<div class="form-group">
										<label for="focusedinput" class="col-sm-2 control-label">Travel Type</label>
										<div class="col-sm-8">
											<input type="text" class="form-control1" name="traveltype" id="traveltype" placeholder="Car - Bus - Aeroplane" required>
										</div>
									</div>
									<div class="form-group">
										<label for="focusedinput" class="col-sm-2 control-label">Travel Number</label>
										<div class="col-sm-8">
											<input type="text" class="form-control1" name="travelnumber" id="travelnumber" placeholder="ABC 1234" required>
										</div>
									</div>

									<div class="form-group">
										<label for="focusedinput" class="col-sm-2 control-label">From - To</label>
										<div class="col-sm-8">
											<input type="text" class="form-control1" name="travelfromto" id="travelfromto" placeholder="From - To" required>
										</div>
									</div>
									<div class="form-group">
										<label for="focusedinput" class="col-sm-2 control-label">Address</label>
										<div class="col-sm-8">
											<input type="text" class="form-control1" name="traveladdress" id="traveladdress" placeholder="this is address" required>
										</div>
									</div>

									<div class="form-group">
										<label for="focusedinput" class="col-sm-2 control-label">Travel Price in USD</label>
										<div class="col-sm-8">
											<input type="text" class="form-control1" name="travelprice" id="travelprice" placeholder=" Travel Price is USD" required>
										</div>
									</div>

									<div class="form-group">
										<label for="focusedinput" class="col-sm-2 control-label">Travel Features</label>
										<div class="col-sm-8">
											<input type="text" class="form-control1" name="travelfeatures" id="travelfeatures" placeholder="Travel Features and facilities" required>
										</div>
									</div>


									<div class="form-group">
										<label for="focusedinput" class="col-sm-2 control-label">Travel Details</label>
										<div class="col-sm-8">
											<textarea class="form-control" rows="5" cols="50" name="traveldetails" id="traveldetails" placeholder="Travel Details" required></textarea>
										</div>
									</div>
									<div class="form-group">
										<label for="focusedinput" class="col-sm-2 control-label">Travel Image</label>
										<div class="col-sm-8">
											<input type="file" name="travelimage" id="travelimage" required>
										</div>
									</div>

									<div class="row">
										<div class="col-sm-8 col-sm-offset-2">
											<button type="submit" name="submit" class="btn-primary btn">Add This Travel</button>

											<button type="reset" class="btn-inverse btn">Reset</button>
										</div>
									</div>





							</div>

							</form>





							<div class="panel-footer">

							</div>
							</form>
						</div>
					</div>
					<!--//grid-->

					<!-- script-for sticky-nav -->
					<script>
						$(document).ready(function() {
							var navoffeset = $(".header-main").offset().top;
							$(window).scroll(function() {
								var scrollpos = $(window).scrollTop();
								if (scrollpos >= navoffeset) {
									$(".header-main").addClass("fixed");
								} else {
									$(".header-main").removeClass("fixed");
								}
							});

						});
					</script>
					<!-- /script-for sticky-nav -->
					<!--inner block start here-->
					<div class="inner-block">

					</div>
					<!--inner block end here-->
					<!--copy rights start here-->
					<?php include('includes/footer.php'); ?>
					<!--COPY rights end here-->
				</div>
			</div>
			<!--//content-inner-->
			<!--/sidebar-menu-->
			<?php include('includes/sidebarmenu.php'); ?>
			<div class="clearfix"></div>
		</div>
		<script>
			var toggle = true;

			$(".sidebar-icon").click(function() {
				if (toggle) {
					$(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
					$("#menu span").css({
						"position": "absolute"
					});
				} else {
					$(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
					setTimeout(function() {
						$("#menu span").css({
							"position": "relative"
						});
					}, 400);
				}

				toggle = !toggle;
			});
		</script>
		<!--js -->
		<script src="js/jquery.nicescroll.js"></script>
		<script src="js/scripts.js"></script>
		<!-- Bootstrap Core JavaScript -->
		<script src="js/bootstrap.min.js"></script>
		<!-- /Bootstrap Core JavaScript -->

	</body>

	</html>
<?php } ?>