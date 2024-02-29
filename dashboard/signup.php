<?php
session_start();
include 'config/db.php';
if(isset($_SESSION['ref'])){
	$ref = $_SESSION['ref'];
	$cek = mysqli_query($connect, "SELECT * FROM users WHERE id='".$ref."'");
	$f_cek = mysqli_fetch_array($cek);
	if(mysqli_num_rows($cek) < 1){
		$r_m = 'Not Found!';
	}else{
		$r_m = $f_cek['full_name'];
		$referal = "<div class='form-group'>
				<input type='text' disabled class='form-control form-control-dark' value='Direct From : $r_m'>
			  </div>";
	}
}else{


}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Facebook -->
  <meta property="og:url" content="https://dailytrade.one/">
  <meta property="og:title" content="DailyTrade">
  <meta property="og:description" content="HQ CopyTrading Platform">


    <link href="lib/datatables.net-dt/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="lib/datatables.net-responsive-dt/css/responsive.dataTables.min.css" rel="stylesheet">
	<link rel="icon" href="/favicon.png" type="image/png" sizes="16x16">
  <!-- Meta -->
  <meta name="description" content="HQ CopyTrading Platform">
  <meta name="author" content="LastEvo LTD">

  <title>DailyTrade | Signup</title>


    <!-- vendor css -->
    <link href="lib/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="lib/select2/css/select2.min.css" rel="stylesheet">

    <!-- Bracket CSS -->
    <link rel="stylesheet" href="css/bracket.css">
    <link rel="stylesheet" href="css/bracket.dark.css">
  </head>

  <body>

    <div class="row no-gutters flex-row-reverse ht-100v">
      <div class="col-md-6 d-flex align-items-center justify-content-center" style="background-color:black;">
        <div class="login-wrapper wd-250 wd-xl-350 mg-y-30">
          <h4 class="tx-white tx-center">Sign Up</h4>
          <p class="tx-center mg-b-20">Create your own account today!.</p>
		   <form id="signup">
			   <div class="form-group">
				<input type="text" name="f_name" class="form-control form-control-dark" placeholder="Enter your firstname" required="">
			  </div><!-- form-group -->
			   <div class="form-group">
				<input type="text" name="l_name" class="form-control form-control-dark" placeholder="Enter your lastname" required="">
			  </div><!-- form-group -->
			  <div class="form-group">
				<input type="text" name="username" class="form-control form-control-dark" placeholder="Enter your username" required="">
			  </div>
			  <div class="form-group">
				<input type="email" name="email" class="form-control form-control-dark" placeholder="Enter your email" required="">
			  </div><!-- form-group -->
			  <div class="form-group">
				<input type="number" name="phone" class="form-control form-control-dark" placeholder="Enter your phone number" required="">
			  </div>
			  <div class="form-group">
				<input type="password" name="password" class="form-control form-control-dark" placeholder="Enter your password" required="">
			  </div>
			   <div class="form-group">
				<input type="password" name="cpassword" class="form-control form-control-dark" placeholder="Confirm your password" required="">
			  </div>
			  <?= $referal;?>
			   <!-- form-group -->
         

          <div class="form-group tx-12">By clicking the Sign Up button below you agreed to our privacy policy and terms of use of our website.</div>
          <button type="submit" class="btn btn-info btn-block">Sign Up</button>
		   </form>
          <div class="mg-t-60 tx-center">Already a member? <a href="signin" class="tx-info">Sign In</a></div>
        </div><!-- login-wrapper -->
      </div><!-- col -->
      <div class="col-md-6 bg-br-primary d-flex align-items-center justify-content-center" style="background-image:url('image.jpg');">
        <div class="wd-250 wd-xl-450 mg-y-30">
           <div class="signin-logo tx-28 tx-bold tx-white"><img src="logo.png" width="80%" height="80%"></div>
        <div class="tx-white-8 mg-b-60"></div>

          <h5 class="tx-white">Why dailytrade?</h5>
        <p class="tx-white-6">Copy Trading is a trading system that allows individuals in the market to automatically copy the position state that is currently opened and managed by a pro trader which is chosen. This method allows traders to copy the exact strategy with their own desired leverage. You can invest much lower or much higher from the recommended allocation which is set by the strategy owner. 

.</p>
        <p class="tx-white-6 mg-b-60">DailyTrade is the gathering place of pro traders and investors who are looking for as much profit as possible. The Daily Trade feature pattern uses a compensation system with a profit sharing scheme. in this matter between traders and investors being preconcerted had the same profit. Traders have extra profit, whilst investors have the easiest way to run the transactions.</p>
        </div><!-- wd-500 -->
      </div>
    </div><!-- row -->

    <script src="lib/jquery/jquery.min.js"></script>
    <script src="lib/jquery-ui/ui/widgets/datepicker.js"></script>
    <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="lib/select2/js/select2.min.js"></script>
    <script>
      $(function(){
        'use strict';

        $('.select2').select2({
          minimumResultsForSearch: Infinity
        });
      });
    </script>
	<script>
	$('#signup').on('submit',function(e) {
		e.preventDefault();
		$.ajax({
			url: 'router',
			dataType: 'JSON',
			type: 'POST',
			data: $(this).serialize()+"&method=control&path=register",
            headers: {
                'Elzgar': 'Its Lord'
            },
			beforeSend: function() {
				$('.btn').attr('disabled');
			},
			complete: function() {
				$('.btn').removeAttr('disabled');
			},
			success: function(r) {
				if(r.success == 'true') {
					alert(r.msg);
				} else {
					alert(r.msg);
				}
			}
		});
	});
   </script>
  </body>
</html>
