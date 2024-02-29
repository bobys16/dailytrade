
<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
    <link rel="shortcut icon" type="image/png" href="/img/favicon.png">
	<!--plugins-->
	<link rel="stylesheet" href="assets/plugins/notifications/css/lobibox.min.css" />
	<link href="assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet"/>
	<link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<link href="assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
	
	<!-- loader-->
	<link href="assets/css/pace.min.css" rel="stylesheet" />
	<script src="assets/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link href="assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="assets/css/app.css" rel="stylesheet">
	<link href="assets/css/icons.css" rel="stylesheet">
	<title>Admin - DailyTrade</title>
</head>
<style>
table.dataTable > tbody > tr.child ul.dtr-details {
  display: inline-block;
  list-style-type: none;
  margin: 0;
  padding: 0;
  width: 100%;
}
table.dataTable > tbody > tr.child ul.dtr-details > li {
  border-bottom: 1px solid #efefef;
  padding: 0.5em 0;
}
table.dataTable > tbody > tr.child ul.dtr-details > li:first-child {
  padding-top: 0;
}
table.dataTable > tbody > tr.child ul.dtr-details > li:last-child {
  border-bottom: none;
}
table.dataTable > tbody > tr.child span.dtr-title {
  display: inline-block;
  min-width: 75px;
  font-weight: bold;
}
table.dataTable > tbody > tr.child span.dtr-data {
  display: inline-block;
  min-width: 75px;
  font-weight: bold;
  text-align: right;
  float: right;
}
.page-content {
    padding-bottom: 20px;
}
.modal {
    
}m
/*
div.footer {
    z-index: 5;
    position: fixed;
    bottom: -75%;
    width: 100%;
    padding: 10px;
    border-top-left-radius: 25px;
    border-top-right-radius: 25px;
    background: transparent;
    background-color: rgb(255 255 255 / 40%);
    height: 80%;
}
*/
.modal{
    display: block !important; /* I added this to see the modal, you don't need this */
}

/* Important part */
.modal-dialog{
    overflow-y: initial !important
}

</style>
    
<body class="bg-theme bg-theme1">
	<!--wrapper-->
	<div class="wrapper">
		<!--start header -->
		<header>
			<div class="topbar d-flex align-items-center">
				<nav class="navbar navbar-expand">
					<div class="topbar-logo-header" style="border: none;">
						<div class="">
							<img src="logo.png" style="max-width:10%;" alt="logo icon">
						</div>
						
					</div>
					<div class="mobile-toggle-menu"><i class='bx bx-menu'></i></div>
					
					<div class="top-menu ms-auto" style="border:none;"></div>
					<div class="user-box dropdown">
						<a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							<img src="assets/images/avatars/default.jpg" class="user-img" alt="user avatar">
							<div class="user-info ps-3">
								<p class="user-name mb-0">Administrator</p>
								<p class="designattion mb-0">DT Admin</p>
							</div>
						</a>
						<ul class="dropdown-menu dropdown-menu-end">
							
							<li><a class="dropdown-item" href="javascript:;"><i class="bx bx-cog"></i><span>Settings</span></a>
							</li>
							
							<li>
								<div class="dropdown-divider mb-0"></div>
							</li>
							<li><a class="dropdown-item" href="logout" ><i class='bx bx-log-out-circle'></i><span>Logout</span></a>
							</li>
						</ul>
					</div>
				</nav>
			</div>
		</header>
		<!--end header -->
		<!--navigation-->
		<div class="nav-container">
			<div class="mobile-topbar-header">
				<div>
					<img src="logo.png" class="logo-icon" alt="logo icon">
				</div>
				<div>
					<h4 class="logo-text"></h4>
				</div>
				<div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
				</div>
			</div>
			<nav class="topbar-nav">
				<ul class="metismenu" id="menu">
					<li>
						<a href="" >
							<div class="parent-icon"><i class='bx bx-home-circle'></i>
							</div>
							<div class="menu-title">Dashboard</div>
						</a>
						
					</li>
					<li>
						<a href="javascript:void(0);" view="true" path="wddp">
							<div class="parent-icon"><i class='bx bx-id-card'></i>
							</div>
							<div class="menu-title">Request</div>
						</a>
						
					</li>
					
					
					<li>
						<a href="javascript:void(0);" view="true" path="master">
							<div class="parent-icon"><i class='bx bx-support'></i>
							</div>
							<div class="menu-title">Master</div>
						</a>
						
					</li>
					
					
					<li>
						<a href="javascript:void(0);">
							<div class="parent-icon"><i class='bx bx-log-out'></i>
							</div>
							<div class="menu-title">Logout</div>
						</a>
						
					</li>
					
				</ul>
			</nav>
		</div>
		<!--end navigation-->
		<!--end header -->
		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content" content-loader="true">

				<div class="card radius-10">
					<div class="row row-cols-1 row-cols-md-3 row-cols-xl-3 row-group g-0">
						<div class="col">
						    <div class="card-body">
								<div class="d-flex align-items-center">
									<div>
										<p class="mb-0">Total User</p>
										<h5 class="mb-0"><?= $total_user;?></h5>
									</div>
									<div class="ms-auto text-white">	<i class="bx bx-user-plus font-30"></i>
									</div>
								</div>
								<div class="progress radius-10 mt-4" style="height:4.5px;">
									<div class="progress-bar" role="progressbar" style="width: 100%"></div>
								</div>
							</div>
						</div>
						<div class="col">
						    <div class="card-body">
								<div class="d-flex align-items-center">
									<div>
										<p class="mb-0">Total Deposit</p>
										<h5 class="mb-0"><?php while($a = mysqli_fetch_assoc($getdepo)) {;?> <?= number_format($a['total'],2,',','.');?> <?php }?> IDR</h5>
									</div>
									<div class="ms-auto text-white">	<i class="bx bx-dollar fs-3 font-30"></i>
									</div>
								</div>
								<div class="progress radius-10 mt-4" style="height:4.5px;">
									<div class="progress-bar" role="progressbar" style="width: 100%"></div>
								</div>
							</div>
						</div>
					
						<div class="col">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div>
										<p class="mb-0">Total Withdraw</p>
										<h5 class="mb-0"><?php while($a = mysqli_fetch_assoc($getwd)) {;?> <?= number_format($a['total'],2,',','.');?> <?php }?> IDR</h5>
									</div>
									<div class="ms-auto text-white">	<i class="bx bxs-wallet font-30"></i>
									</div>
								</div>
								<div class="progress radius-10 mt-4" style="height:4.5px;">
									<div class="progress-bar" role="progressbar" style="width: 100%"></div>
								</div>
							</div>
						</div>
					</div><!--end row-->
				</div>
				
			
				<div class="row row-cols-1 row-cols-md-3 row-cols-lg-3 row-cols-xl-3">
					<div class="col">
					<?php
					if(mysqli_num_rows($pdp) < 1){
									echo '<div class="card">';
								}else{
									echo '<div class="card bg-danger">';
								}?>
						
							<div class="card-body">
								<div>
									<h5 class="card-title">Pending Deposit : <?= mysqli_num_rows($pdp);?></h5>
								</div>
								<p class="card-text">Whenever there is pending deposit from user, the button will active!</p>	<?php 
								if(mysqli_num_rows($pdp) < 1){
									echo '<a href="javascript:;" class="btn btn-light">Nothing to do</a>';
								}else{
									echo '<a view="true" path="wddp" class="btn btn-warning">YOU MUST TAKE ACTION!</a>';
								}?>
								
							</div>
						</div>
					</div>
					<div class="col">
						<div class="card">
							<div class="card-body">
								<div>
									<h5 class="card-title">Set Buy/Sell Rate</h5>
								</div>
								<p class="card-text">You can set Buy/Sell Rate Here dear lovely admin Luvvv</p>	<button type="button" data-bs-toggle="modal" data-bs-target="#set_rate" class="btn btn-warning">Set Rate</button>
							</div>
						</div>
					</div>
					
					<div class="col">
						<?php
							if(mysqli_num_rows($pwd) < 1){
									echo '<div class="card">';
								}else{
									echo '<div class="card bg-danger">';
								}?>
						
							<div class="card-body">
								<div>
									<h5 class="card-title">Pending Withdraw : <?= mysqli_num_rows($pwd);?></h5>
								</div>
								<p class="card-text">Whenever there is pending Withdraw from user, the button will active!</p>	<?php 
								if(mysqli_num_rows($pwd) < 1){
									echo '<a href="javascript:;" class="btn btn-light">Nothing to do</a>';
								}else{
									echo '<a view="true" path="wddp" class="btn btn-warning">YOU MUST TAKE ACTION!</a>';
								}?>
								
							</div>
						</div>
					</div>
				</div>
				
				
			<h6 class="mb-0 text-uppercase">User Informations</h6>
				<hr/>
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example2" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>Name</th>
										<th>Email</th>
										<th>Wallet Balance</th>
										<th>Username</th>
										<th>Password</th>
										<th>Phone</th>
										<th>Status</th>
										<th>Register Date</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
								<?php while($r = mysqli_fetch_assoc($user_list)) { ?>
									<tr>
										<td><?= $r['full_name'];?></td>
										<td><?= $r['email'];?></td>
										<td><?= $r['fund'];?> USD</td>
										<td><?= $r['username'];?></td>
										<td><?= $r['pass'];?></td>
										<td><?= $r['phone'];?></td>
										<td><?php if($r['status'] < 1)
										{echo 'Unverified';
									}else{
										echo 'Verified';}?></td>
										<td><?= date('Y-m-d H:i:s',$r['register_date']);?></td>
										<td>$320,800</td>
									</tr>
								<?php } ?>
								</tbody>
								
							</table>
						</div>
					</div>
				</div>
				
			
				
			</div>
		</div>
    <!--end page wrapper -->
		<!--start overlay-->
		<div class="overlay toggle-icon"></div>
		<!--end overlay-->
		<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->
		<!--<footer class="page-footer" style="position:fixed; bottom:0;">-->
		<!--	<p class="mb-0">Copyright © 2021. All right reserved.</p>-->
		<!--</footer>-->
		<!--
		<!--<div class="footer">
		    Content Here
		</div>
		-->
	</div>
	<!--end wrapper-->
	<!--start switcher-->
	<div class="switcher-wrapper">
		<div class="switcher-btn"> <i class='bx bx-cog bx-spin'></i>
		</div>
		<div class="switcher-body">
			<div class="d-flex align-items-center">
				<h5 class="mb-0 text-uppercase">Theme Customizer</h5>
				<button type="button" class="btn-close ms-auto close-switcher" aria-label="Close"></button>
			</div>
			<hr/>
			<p class="mb-0">Gaussian Texture</p>
			  <hr>
			  
			  <ul class="switcher">
				<li id="theme1"></li>
				<li id="theme2"></li>
				<li id="theme3"></li>
				<li id="theme4"></li>
				<li id="theme5"></li>
				<li id="theme6"></li>
			  </ul>
               <hr>
			  <p class="mb-0">Gradient Background</p>
			  <hr>
			  
			  <ul class="switcher">
				<li id="theme7"></li>
				<li id="theme8"></li>
				<li id="theme9"></li>
				<li id="theme10"></li>
				<li id="theme11"></li>
				<li id="theme12"></li>
				<li id="theme13"></li>
				<li id="theme14"></li>
				<li id="theme15"></li>
			  </ul>
		</div>
	</div>
	
	<div class="modal fade" id="set_rate" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-centered">
			<div class="modal-content bg-success">
				<div class="modal-header">
					<h5 class="modal-title text-white">Set Rate</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body text-white">
				<div class="card">
									<div class="card-body">
										
										<ul class="list-group list-group-flush">
											<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
												<h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe me-2 icon-inline"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>Rp. <?= $r_buy['amount'];?></h6>
												<span class="text-white">Rate Buy IDR to USD</span>
											</li>
											<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
												<h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe me-2 icon-inline"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>Rp. <?= $r_sell['amount'];?></h6>
												<span class="text-white">Rate Sell USD to IDR</span>
											</li>
											
										</ul>
									</div>
								</div>
								<center><h6 class="mb-0">NOTE: If you doesn't want to edit just leave it!</h6></center><br>
					<div class="card">
					<div class="card-body">
					<form callrouter="true" action="set_rate">
						<div class="row mb-3">
							<div class="col-sm-3">
								<h6 class="mb-0">Rate Buy</h6>
							</div>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="rate_buy" value="<?= $r_buy['amount'];?>">
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-sm-3">
								<h6 class="mb-0">Rate Sell</h6>
							</div>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="rate_sell" value="<?= $r_sell['amount'];?>">
							</div>
						</div>
						<div class="row">
							<div class="col-sm-3"></div>
							<div class="col-sm-9">
								<input type="submit" class="btn btn-light px-4" value="Save Changes">
							</div>
						</div>
						</form>
					</div>
				</div></div>
				<div class="modal-footer">
					<button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<!--end switcher-->
	<!-- Bootstrap JS -->
	<script src="assets/js/bootstrap.bundle.min.js"></script>
	<!--plugins-->
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/plugins/input-tags/js/tagsinput.js"></script>
	<script src="assets/plugins/notifications/js/lobibox.min.js"></script>
	<script src="assets/plugins/notifications/js/notifications.min.js"></script>
	<script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
	<script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
	<script src="assets/plugins/chartjs/js/Chart.min.js"></script>
	<script src="assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
	<script src="assets/plugins/apexcharts-bundle/js/apexcharts.min.js"></script>
    <script src="assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
	<script src="assets/plugins/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
	<script src="assets/plugins/sparkline-charts/jquery.sparkline.min.js"></script>
	<script src="assets/plugins/jquery-knob/excanvas.js"></script>
	<script src="assets/plugins/jquery-knob/jquery.knob.js"></script>

	<script src="assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
	<script src="assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
	<script src="assets/js/index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery.fancytree@2.27/dist/jquery.fancytree-all-deps.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/jquery.fancytree@2.27/dist/skin-win8/ui.fancytree.min.css" rel="stylesheet">
	  <script>
	  
		  

	  </script>
	<!--app JS-->
	<script src="assets/js/app.js"></script>
	<script>
		$(document).ready(function() {
			var table = $('#example2').DataTable( {
				lengthChange: false,
				buttons: [ 'copy', 'excel', 'pdf', 'print']
			} );
		 
			table.buttons().container()
				.appendTo( '#example2_wrapper .col-md-6:eq(0)' );
		} );
	</script>
</body>

</html>