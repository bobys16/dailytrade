<?php
include "config/db.php";
if(!isset($_GET['token'])){
	header("Location: /dashboard");
}else{
	$token = $_GET['token'];
	$cek = mysqli_query($connect, "SELECT * FROM reset WHERE token='".$token."'");
	$fetch = mysqli_fetch_array($cek);
	if(!empty($fetch['date_verify'])){
		header("Location: /dashboard/signin?idasda");
	}else{
		$us = mysqli_query($connect, "SELECT * FROM users WHERE id='".$fetch['uid']."'");
		if(!empty($fetch['date_verify'])){
			header("Location: /dashboard/signin?id=1");
		}else{
			$f_us = mysqli_fetch_array($us);
		}
	}
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

  <title>Daily Trade | Copy Trading Platform</title>

  <!-- vendor css -->
  <link href="lib/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">

  <!-- Bracket CSS -->
  <link rel="stylesheet" href="css/bracket.css">
  <link rel="stylesheet" href="css/bracket.dark.css">
</head>

<body>

  <div class="row no-gutters flex-row-reverse ht-100v">
    <div class="col-md-6 d-flex align-items-center justify-content-center">
      <div class="login-wrapper wd-250 wd-xl-350 mg-y-30">
        <h4 class="tx-white tx-center">Reset Password</h4>
        <p class="tx-center mg-b-20">Hello <?= $f_us['full_name'];?>, Please insert your new password</p>
		<div class="notify"></div>
		
		<form id="reset">
			<div class="form-group">
			  <input type="password" name="npassword" class="form-control form-control-dark" placeholder="Enter your password">
			</div><!-- form-group -->
			<div class="form-group">
			  <input type="password" class="form-control form-control-dark" name="password" placeholder="Enter your new password again">
			  <input type="hidden" name="token" value="<?= $_GET['token'];?>">
			</div><!-- form-group -->
			<button type="submit" class="btn btn-info btn-block">Reset Password</button>
		</form>

       </div><!-- login-wrapper -->
    </div><!-- col -->
    <div class="col-md-6 bg-br-primary d-flex align-items-center justify-content-center">
      <div class="wd-250 wd-xl-450 mg-y-30">
        <div class="signin-logo tx-28 tx-bold tx-white"><span class="tx-normal">[</span> daily <span
            class="tx-white-8">trade</span> <span class="tx-normal">]</span></div>
        <div class="tx-white-8 mg-b-60">Platform for beginner trader</div>

        <h5 class="tx-white">Why dailytrade?</h5>
        <p class="tx-white-6">When it comes to websites or apps, one of the first impression you consider is the design.
          It needs to be high quality enough otherwise you will lose potential users due to bad design.</p>
        <p class="tx-white-6 mg-b-60">When your website or app is attractive to use, your users will not simply be using
          it, they’ll look forward to using it. This means that you should fashion the look and feel of your interface
          for your users.</p>
      </div><!-- wd-500 -->
    </div>
  </div><!-- row -->

  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/jquery-ui/ui/widgets/datepicker.js"></script>
  <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script>
	
	$('#reset').on('submit',function(e) {
		e.preventDefault();
		$.ajax({
			url: 'router',
			dataType: 'JSON',
			type: 'POST',
			data: $(this).serialize()+"&method=control&path=reset",
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
					$('.notify').html('<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong class="d-block d-sm-inline-block-force">'+r.msg+' </strong> Redirecting...</div>');
					setTimeout(function() { javascript:location.replace('/dashboard') }, 2000);
				} else {
					$('.notify').html('<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong class="d-block d-sm-inline-block-force">Failed!</strong> '+r.msg+'.</div>');
				}
			}
		});
	});
   </script>
</body>

</html>