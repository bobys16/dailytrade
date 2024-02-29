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
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@5/dark.css">
    <link href="lib/datatables.net-responsive-dt/css/responsive.dataTables.min.css" rel="stylesheet">
	<link rel="icon" href="/favicon.png" type="image/png" sizes="16x16">
  <!-- Meta -->
  <meta name="description" content="HQ CopyTrading Platform">
  <meta name="author" content="LastEvo LTD">

  <title>DailyTrade</title>

  <!-- vendor css -->
  <link href="lib/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="lib/rickshaw/rickshaw.min.css" rel="stylesheet">
  <link href="lib/select2/css/select2.min.css" rel="stylesheet">

  <!-- Bracket CSS -->
  <link rel="stylesheet" href="css/bracket.css?q=1221">
  <link rel="stylesheet" href="css/bracket.dark.css">
</head>
<style>
.ribbon {
  width: 100px;
  height: 100px;
  overflow: hidden;
  position: absolute;
}
.ribbon::before,
.ribbon::after {
  position: absolute;
  z-index: -1;
  content: '';
  display: block;
  border: 5px solid #178204;
}
.ribbon span {
  position: absolute;
  display: block;
  width: 150px;
  padding: 5px 0;
  background-color: #3498db;
  box-shadow: 0 5px 10px rgba(0,0,0,.5);
  color: #fff;
  font: 700 12px/1 'Lato', sans-serif;
  text-shadow: 0 1px 1px rgba(0,0,0,.2);
  text-transform: uppercase;
  text-align: center;
}
.ribbon-top-right {
  top: -5px;
  right: -5px;
}
.ribbon-top-right::before,
.ribbon-top-right::after {
  border-top-color: transparent;
  border-right-color: transparent;
}
.ribbon-top-right::before {
  top: 0;
  left: 0;
}
.ribbon-top-right::after {
  bottom: 0;
  right: 0;
}
.ribbon-top-right span {
  left: -18px;
  top: 30px;
  transform: rotate(45deg);
}

</style>
<body style="background-color:black;">

  <!-- ########## START: LEFT PANEL ########## -->
  <div class="br-logo"><a href=""><img src="logo.png" width="100%" height="100%"></a></div>
  <div class="br-sideleft sideleft-scrollbar">
    <label class="sidebar-label">Navigation</label>
    <ul class="br-sideleft-menu">
      <li class="br-menu-item">
        <a href="" class="br-menu-link active">
          <i class="menu-item-icon icon ion-ios-home-outline tx-24"></i>
          <span class="menu-item-label">Dashboard</span>
        </a><!-- br-menu-link -->
      </li><!-- br-menu-item -->
	  <li class="br-menu-item">
        <a href="javascript:void(0);" class="br-menu-link" view="true" path="trading_account">
          <i class="menu-item-icon fa fa-user-circle tx-20"></i>
          <span class="menu-item-label">Trading Account</span>
        </a><!-- br-menu-link -->
      </li><!-- br-menu-item -->
	   <li class="br-menu-item">
        <a href="javascript:void(0);" class="br-menu-link" view="true" path="finalization">
          <i class="menu-item-icon fa fa-passport tx-20"></i>
          <span class="menu-item-label">Trading View</span>
        </a><!-- br-menu-link -->
      </li><!-- br-menu-item -->
	  <li class="br-menu-item">
        <a href="javascript:void(0);" class="br-menu-link" view="true" path="copytrade">
          <i class="menu-item-icon icon ion-flag tx-24"></i>
          <span class="menu-item-label">CopyTrade</span>
        </a><!-- br-menu-link -->
      </li><!-- br-menu-item -->
	  <li class="br-menu-item">
        <a href="javascript:void(0);" class="br-menu-link" view="true" path="exchanger">
          <i class="menu-item-icon icon ion-filing tx-24"></i>
          <span class="menu-item-label">Wallet</span>
        </a><!-- br-menu-link -->
      </li><!-- br-menu-item -->
	  <li class="br-menu-item">
        <a href="javascript:void(0);" class="br-menu-link" view="true" path="setting">
          <i class="menu-item-icon icon ion-settings tx-24"></i>
          <span class="menu-item-label">Setting</span>
        </a><!-- br-menu-link -->
      </li><!-- br-menu-item -->
	   <li class="br-menu-item">
        <a href="javascript:void(0);" class="br-menu-link" view="true" path="support">
          <i class="menu-item-icon icon ion-ios-briefcase-outline tx-22"></i>
          <span class="menu-item-label">Support Ticket</span>
        </a><!-- br-menu-link -->
      </li><!-- br-menu-item -->
	   <li class="br-menu-item" style="display:none;">
        <a href="javascript:void(0);" class="br-menu-link" view="true" path="msg">
          <i class="menu-item-icon icon ion-ios-briefcase-outline tx-22"></i>
          <span class="menu-item-label">MSG</span>
        </a><!-- br-menu-link -->
      </li><!-- br-menu-item -->
     <li class="br-menu-item">
        <a href="logout" class="br-menu-link">
          <i class="menu-item-icon icon ion-close tx-24"></i>
          <span class="menu-item-label">Log-out</span>
        </a><!-- br-menu-link -->
      </li><!-- br-menu-item -->

      <br>
  </div><!-- br-sideleft -->
  <!-- ########## END: LEFT PANEL ########## -->
 <div id="transaction" class="modal fade effect-flip-vertical" style="display: none; background-color: #1a2432;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
              <div class="modal-content bd-0 tx-14" style="background-color: #1a2432;">
                <div class="modal-header pd-y-20 pd-x-25">
                  <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold" style="color:white;">Transaction History</h6>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body pd-25">
                  <h4 class="lh-3 mg-b-20"><a href="" class="tx-inverse hover-primary" style="color:white;">Here are the list of all your transactions</a></h4>
                 <div class="table-responsive">
              <table id="datatable2" class="table table-bordered" style="width: 98% !important;">
                <thead>
                  <tr>
                    <th>Transaction ID</th>
                    <th>Type</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Description</th>
                    <th>Date</th>
                  </tr>
                </thead>
                <tbody>
                <?php while($r = mysqli_fetch_assoc($request)) { ?>
                  <tr>
                    <td>#<?= $r['id'];?></td>
                    <td><?= $r['type'];?></td>
                    <td><?= $r['amount'];?></td>
                    <td><?= $r['status'];?></td>
                    <td><?= $r['description'];?></td>
                    <td><?= date('d-m-Y H:i:s',$r['date']);?></td>
                  </tr>
                <?php } ?>
                
                </tbody>
                
              </table>
            </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-semibold" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div><!-- modal-dialog -->
          </div>
  <!-- ########## START: HEAD PANEL ########## -->
  <div class="br-header">
    <div class="br-header-left">
      <div class="navicon-left hidden-md-down"><a id="btnLeftMenu" href=""><i class="icon ion-navicon-round"></i></a>
      </div>
      <div class="navicon-left hidden-lg-up">
        <a id="btnLeftMenuMobile" href="">
          <i class="icon ion-navicon-round"></i>
        </a>
      </div>
    </div><!-- br-header-left -->
    <div class="br-header-right">
      <nav class="nav">
        <div class="dropdown">
          <a href="" class="nav-link nav-link-profile" data-toggle="dropdown">
            <span class="logged-name hidden-md-down"><?=$user['username']?></span>
            <img src="<?= $user['pic'];?>" class="wd-32 rounded-circle" alt="">
            <span class="square-10 bg-success"></span>
          </a>
          <div class="dropdown-menu dropdown-menu-header wd-250">
            <div class="tx-center">
              <a href=""><img src="<?= $user['pic'];?>" class="wd-80 rounded-circle" alt=""></a>
              <h6 class="logged-fullname"><?=$user['full_name'];?></h6>
              <p><?=$user['email']?></p>
            </div>
            <hr>
            <div class="tx-center">
              <span class="profile-earning-label">Earnings</span>
              <h3 class="profile-earning-amount">$0 <i class="icon ion-ios-arrow-thin-up tx-success"></i></h3>
              <span class="profile-earning-text">Based on data.</span>
            </div>
            <hr>
            <ul class="list-unstyled user-profile-nav">
              <li><a href=""><i class="icon ion-ios-person" view="true" path="setting"></i> Edit Profile</a></li>
              <li><a href="logout"><i class="icon ion-power"></i> Sign Out</a></li>
            </ul>
          </div><!-- dropdown-menu -->
        </div><!-- dropdown -->
      </nav>
    </div><!-- br-header-right -->
  </div><!-- br-header -->
  <!-- ########## END: HEAD PANEL ########## -->

  <!-- ########## START: MAIN PANEL ########## -->
  <div class="br-mainpanel" content-loader="true">
    <div class="br-pagetitle">
      <i class="icon ion-ios-home-outline tx-70 lh-0"></i>
      <div>
        <h4>Dashboard</h4>
        <p class="mg-b-0">Live copy trade platform.</p>
      </div>
    </div><!-- d-flex -->

    <div class="br-pagebody pb-5">
      <div class="row row-sm widget-1">
        <div class="col-sm-12 col-lg-12 pb-2">
          <div class="card" style="background-color:#B8860B;">
            <div class="card-header">
              <h6 class="card-title" style="font-size:20px">Master Balance</h6>
            </div><!-- card-header -->
            <div class="card-body">
              <span class="fa fa-hand-holding-usd tx-40 tx-white"></span>
              <span style="font-size:40px" style="font-size:20px">$<?=number_format($user['fund'], 2, '.', ',')?></span>
            </div><!-- card-body -->
            <div class="card-footer row no-gutters p-0 tx-white">
              <div class="col-12">
                <a class="btn w-100" style="font-size:20px" data-toggle="modal" data-target="#transaction">Transactions History</a>
              </div>
          
             
            </div>
          </div><!-- card -->
        </div>

        <div class="col-sm-12 col-lg-12 pb-2">
          <div class="card" style="background-color:#B8860B;">
            <div class="card-header">
              <h6 class="card-title" style="font-size:20px">Network</h6>
            </div><!-- card-header -->
            <div class="card-body">
              <span class="fa fa-network-wired tx-40 tx-white"></span>
              <span style="font-size:40px"><?=$count_network;?></span>
            </div><!-- card-body -->
            <div class="card-footer row no-gutters p-0 tx-white">
              <div class="col-6">
                <a data-toggle="modal" data-target="#network" class="btn w-100" style="font-size:20px">View List</a>
              </div>
			  <div class="col-6" id="copy">
			  <input type="hidden" value="https://dailytrade.one/ref/<?= $user['id'];?>" id="myInput">
                <a class="btn w-100" href="javascript:void(0);" style="color:white; font-size:20px;" onclick="copylink();" >Copy Direct Link</a>
              </div>
            </div>
          </div><!-- card -->
        </div>

        <div class="col-sm-12 col-lg-12 pb-2">
          <div class="card" style="background-color:#B8860B;">
            <div class="card-header">
              <h6 class="card-title" style="font-size:20px">Profit Sharing</h6>
            </div><!-- card-header -->
            <div class="card-body">
              <span class="fa fa-parachute-box tx-40 tx-white"></span>
              <span style="font-size:40px">$<?=number_format($user['sharing'], 2, '.', ',')?></span>
            </div><!-- card-body -->
            <div class="card-footer row no-gutters p-0 tx-white">
              <div class="col-6">
                <a data-toggle="modal" data-target="#history" class="btn w-100" style="font-size:20px" style="font-size:20px">View List</a>
              </div>
			   <div class="col-6">
                <a data-toggle="modal" data-target="#take_profit" class="btn w-100" style="font-size:20px" style="font-size:20px">Take Balance</a>
              </div>
            </div>
          </div><!-- card -->
        </div>
		
		<div class="col-sm-12 col-lg-12 pb-2">
          <div class="card" style="background-color:#B8860B;">
            <div class="card-header">
              <h6 class="card-title" style="font-size:20px">Total Gain</h6>
            </div><!-- card-header -->
            <div class="card-body">
              <span class="fas fa-angle-double-up tx-40 tx-white"></span>
              <span style="font-size:40px">$<?=number_format($total_gain,2,'.',',')?></span>
            </div><!-- card-body -->
            <div class="card-footer row no-gutters p-0 tx-white">
              <div class="col-4">
                
              </div>
              <div class="col-4">
              </div>
              <div class="col-4">
              </div>
            </div>
          </div><!-- card -->
        </div>

      </div>
	</div>
	
	<div id="network" class="modal fade effect-flip-vertical" style="display: none; background-color: #1a2432;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
              <div class="modal-content bd-0 tx-14" style="background-color: #1a2432;">
                <div class="modal-header pd-y-20 pd-x-25">
                  <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold" style="color:white;">Network</h6>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body pd-25">
                  <h4 class="lh-3 mg-b-20"><a href="" class="tx-inverse hover-primary" style="color:white;">Your 1st Generation!</a></h4>
                 <div class="table-responsive">
						<table id="first_gen" class="table table-bordered" style="width: 98% !important;">
							<thead>
								<tr>
									<th>Username</th>
									<th>Name</th>
									<th>Low Account</th>
									<th>High Account</th>
								</tr>
							</thead>
							<tbody>
							<?php 
							$getRef = mysqli_query($connect, "SELECT * FROM users WHERE ref='".$uid."'");
							$get1 = array();
							while($roo = mysqli_fetch_assoc($getRef)) { 
								$get1[]=$roo['id'];
								$getTradeAcc = mysqli_query($connect, "SELECT * FROM trading_account WHERE uid='".$roo['id']."'");
								while($tacc = mysqli_fetch_assoc($getTradeAcc)) if($tacc['type'] == 'Low') $low_acc=$tacc; else $high_acc=$tacc;
							?>
								<tr>
									<td><?= $roo['username'];?></td>
									<td><?= $roo['full_name'];?></td>
									<td><?= $low_acc['account_id'];?></td>
									<td><?= $high_acc['account_id'];?></td>
								</tr>
							<?php } ?>
							
							</tbody>
							
						</table>
					</div>
					<hr style="background-color: #FFF;">
					<h4 class="lh-3 mg-b-20"><a href="" class="tx-inverse hover-primary" style="color:white;">Your 2nd Generation!</a></h4>
                 <div class="table-responsive">
						<table id="second_gen" class="table table-bordered" style="width: 98% !important;">
							<thead>
								<tr>
									<th>Username</th>
									<th>Name</th>
									<th>Low Account</th>
									<th>High Account</th>
								</tr>
							</thead>
							<tbody>
							<?php 
							$get2= array();
							foreach($get1 as $inx => $sid) {
								$sGet = mysqli_query($connect, "SELECT * FROM users WHERE ref='".$sid."'");
								while($sref = mysqli_fetch_assoc($sGet)) {
									$get2[]=$sref['id'];
									$getTradeAcc = mysqli_query($connect, "SELECT * FROM trading_account WHERE uid='".$sref['id']."'");
									while($tacc = mysqli_fetch_assoc($getTradeAcc)) if($tacc['type'] == 'Low') $low_acc=$tacc; else $high_acc=$tacc;
								?>
									<tr>
										<td><?= $sref['username'];?></td>
										<td><?= $sref['full_name'];?></td>
										<td><?= $low_acc['account_id'];?></td>
										<td><?= $high_acc['account_id'];?></td>
									</tr>
							<?php }
							} ?>
							
							</tbody>
							
						</table>
					</div>
					<hr style="background-color: #FFF;">
					<h4 class="lh-3 mg-b-20"><a href="" class="tx-inverse hover-primary" style="color:white;">Your 3rd Generation!</a></h4>
                 <div class="table-responsive">
						<table id="third_gen" class="table table-bordered" style="width: 98% !important;">
							<thead>
								<tr>
									<th>Username</th>
									<th>Name</th>
									<th>Low Account</th>
									<th>High Account</th>
								</tr>
							</thead>
							<tbody>
							<?php 
              $get3= array();
							foreach($get2 as $inx => $sid) {
								$sGet = mysqli_query($connect, "SELECT * FROM users WHERE ref='".$sid."'");
								while($sref = mysqli_fetch_assoc($sGet)) {
                  $get3[]=$sref['id'];
									$getTradeAcc = mysqli_query($connect, "SELECT * FROM trading_account WHERE uid='".$sref['id']."'");
									while($tacc = mysqli_fetch_assoc($getTradeAcc)) if($tacc['type'] == 'Low') $low_acc=$tacc; else $high_acc=$tacc;
								?>
									<tr>
										<td><?= $sref['username'];?></td>
										<td><?= $sref['full_name'];?></td>
										<td><?= $low_acc['account_id'];?></td>
										<td><?= $high_acc['account_id'];?></td>
									</tr>
							<?php }
							} ?>
							
							</tbody>
							
						</table>
					</div>
          <hr style="background-color: #FFF;">
          <h4 class="lh-3 mg-b-20"><a href="" class="tx-inverse hover-primary" style="color:white;">Your 4rd Generation!</a></h4>
                 <div class="table-responsive">
            <table id="forth_gen" class="table table-bordered" style="width: 98% !important;">
              <thead>
                <tr>
                  <th>Username</th>
                  <th>Name</th>
                  <th>Low Account</th>
                  <th>High Account</th>
                </tr>
              </thead>
              <tbody>
              <?php 
              $get4= array();
              foreach($get3 as $inx => $sid) {
                $sGet = mysqli_query($connect, "SELECT * FROM users WHERE ref='".$sid."'");
                while($sref = mysqli_fetch_assoc($sGet)) {
                  $get4[]=$sref['id'];
                  $getTradeAcc = mysqli_query($connect, "SELECT * FROM trading_account WHERE uid='".$sref['id']."'");
                  while($tacc = mysqli_fetch_assoc($getTradeAcc)) if($tacc['type'] == 'Low') $low_acc=$tacc; else $high_acc=$tacc;
                ?>
                  <tr>
                    <td><?= $sref['username'];?></td>
                    <td><?= $sref['full_name'];?></td>
                    <td><?= $low_acc['account_id'];?></td>
                    <td><?= $high_acc['account_id'];?></td>
                  </tr>
              <?php }
              } ?>
              
              </tbody>
              
            </table>
          </div>
          <hr style="background-color: #FFF;">
          <h4 class="lh-3 mg-b-20"><a href="" class="tx-inverse hover-primary" style="color:white;">Your 5rd Generation!</a></h4>
                 <div class="table-responsive">
            <table id="fifth_gen" class="table table-bordered" style="width: 98% !important;">
              <thead>
                <tr>
                  <th>Username</th>
                  <th>Name</th>
                  <th>Low Account</th>
                  <th>High Account</th>
                </tr>
              </thead>
              <tbody>
              <?php 
              
              foreach($get4 as $inx => $sid) {
                $sGet = mysqli_query($connect, "SELECT * FROM users WHERE ref='".$sid."'");
                while($sref = mysqli_fetch_assoc($sGet)) {
                  $getTradeAcc = mysqli_query($connect, "SELECT * FROM trading_account WHERE uid='".$sref['id']."'");
                  while($tacc = mysqli_fetch_assoc($getTradeAcc)) if($tacc['type'] == 'Low') $low_acc=$tacc; else $high_acc=$tacc;
                ?>
                  <tr>
                    <td><?= $sref['username'];?></td>
                    <td><?= $sref['full_name'];?></td>
                    <td><?= $low_acc['account_id'];?></td>
                    <td><?= $high_acc['account_id'];?></td>
                  </tr>
              <?php }
              } ?>
              
              </tbody>
              
            </table>
          </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-semibold" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div><!-- modal-dialog -->
    </div>
	
	<div id="history" class="modal fade effect-flip-vertical" style="display: none; background-color: #1a2432;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
              <div class="modal-content bd-0 tx-14" style="background-color: #1a2432;">
                <div class="modal-header pd-y-20 pd-x-25">
                  <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold" style="color:white;">Profit Sharing History</h6>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body pd-25">
                  <h4 class="lh-3 mg-b-20"><a href="" class="tx-inverse hover-primary" style="color:white;">Here are the history of your Profit Sharing!</a></h4>
                 <div class="table-responsive">
							<table id="datatable2" class="table table-bordered" style="width: 98% !important;">
								<thead>
									<tr>
										<th>Amount</th>
										<th>From</th>
										<th>Description</th>
										<th>Date</th>
									</tr>
								</thead>
								<tbody>
								<?php while($r = mysqli_fetch_assoc($profit_sharing)) { ?>
									<tr>
										<td><?= $r['amount'];?></td>
										<td><?= $r['from'];?></td>
										<td><?= $r['description'];?></td>
										<td><?= date('d-m-Y H:i:s',$r['date']);?></td>
									</tr>
								<?php } ?>
								
								</tbody>
								
							</table>
						</div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-semibold" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div><!-- modal-dialog -->
          </div>
		   
		  
  </div><!-- br-pagebody -->

   <div id="take_profit" class="modal fade effect-flip-vertical" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
              <div class="modal-content bd-0 tx-14" style="background-color: #1a2432;">
                <div class="modal-header pd-y-20 pd-x-25">
                  <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-white tx-bold" style="color:white;">Take Profit Sharing</h6>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body pd-25">
        <form id="transfer_profit">
                  <h4 class="lh-3 mg-b-20"><a href="" class="tx-inverse tx-white hover-primary" style="color:white;">Please choose amount you want to take</a></h4>
           <div class="form-layout form-layout-1">
        <div class="row mg-b-25">
          <div class="col-lg-12">
          <div class="form-group">
            <label class="form-control-label">Amount in USD: </label>
            <input class="form-control form-control-dark" name="amount" id="amount" type="text" placeholder="Please input amount you want to transfer for ex: 100" >
          </div>
          </div><!-- col-4 -->
        </div><!-- row -->

        <div class="form-layout-footer">
          <button class="btn btn-primary" type="submit">Take Balance</button>
        
        </div><!-- form-layout-footer -->
        </div><!-- form-layout -->
                 </div>
                 </form>
                <div class="modal-footer">
                   <button type="button" class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-semibold" data-dismiss="modal">Close</button>
                </div>
              </div>
  <!-- ########## END: MAIN PANEL ########## -->

  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/jquery-ui/ui/widgets/datepicker.js"></script>
  <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="lib/perfect-scrollbar/perfect-scrollbar.min.js"></script>
  <script src="lib/moment/min/moment.min.js"></script>
  <script src="lib/peity/jquery.peity.min.js"></script>
  <script src="lib/rickshaw/vendor/d3.min.js"></script>
  <script src="lib/rickshaw/vendor/d3.layout.min.js"></script>
  <script src="lib/rickshaw/rickshaw.min.js"></script>
  <script src="lib/jquery.flot/jquery.flot.js"></script>
  <script src="lib/jquery.flot/jquery.flot.resize.js"></script>
  <script src="lib/flot-spline/js/jquery.flot.spline.min.js"></script>
  <script src="lib/jquery-sparkline/jquery.sparkline.min.js"></script>
  <script src="lib/echarts/echarts.min.js"></script>
  <script src="lib/select2/js/select2.full.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
  
    <script src="lib/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="lib/datatables.net-dt/js/dataTables.dataTables.min.js"></script>
    <script src="lib/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="lib/datatables.net-responsive-dt/js/responsive.dataTables.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
  
  <script src="js/bracket.js?q=1111"></script>
  <script src="js/ResizeSensor.js"></script>
  <script src="index.js?q=<?=time();?>"></script>
	<script>
function copylink() {
  /* Get the text field */
  var copyText = document.getElementById("myInput");


  /* Copy the text inside the text field */
  navigator.clipboard.writeText(copyText.value);
  
  /* Alert the copied text */
  Swal.fire({
						title: "Success!",
						text: "Your direct link copied succesfully!",
						icon: 'success',
						showCancelButton: false,
					})
}

$('#transfer_profit').on('submit',function(e) {
  e.preventDefault();   
  var min = 10;
  var v1 = $('#amount').val();
  if(v1 < min){
  Swal.fire({
    title: "Requirement Doesn't Meet",
    text: 'You must transfer at least 10 USD profit sharing!',
    icon: 'error',
    showCancelButton: false,
    })
  }else{
    Swal.fire({
      title: 'Are you sure want to transfer '+v1+' USD?',
      text: 'You will get '+v1+' USD to your master balance!',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#79E249',
      cancelButtonColor: '#d33',
      confirmButtonText: "Yes, do it!",
      }).then(function(result) {
      if (result.isConfirmed) {
        $.ajax({
          url: 'router',
          dataType: 'JSON',
          type: 'POST',
          data: $('#transfer_profit').serialize()+"&method=control&path=transfer_profit",
          headers: {
            'Elzgar': 'Its Lord'
          },
          beforeSend: function() {
            Swal.fire({
              title: "Please wait",
              text: 'We are processing your request',
              icon: 'info',
              showCancelButton: false,
              })
          },
          success: function(r) {
            if(r.success == 'true') {
              Swal.fire({
              title: "Succes!",
              text: r.msg,
              icon: 'success',
              showCancelButton: false,
              })
            } else {
              Swal.fire({
              title: "Failed!",
              text: r.msg,
              icon: 'error',
              showCancelButton: false,
         });
            }
          }
      
        })
      }
    })
  }
})
	</script>
	<script>
      $(function(){
        'use strict';


        $('#datatable2').DataTable({
          bLengthChange: false,
          searching: false,
          responsive: true,
		  ordering: false
        });

			$('#first_gen').DataTable({
			  bLengthChange: false,
			  searching: false,
			  responsive: true,
			  ordering: false
			});
			$('#second_gen').DataTable({
			  bLengthChange: false,
			  searching: false,
			  responsive: true,
			  ordering: false
			});
			$('#third_gen').DataTable({
			  bLengthChange: false,
			  searching: false,
			  responsive: true,
			  ordering: false
			});
      $('#forth_gen').DataTable({
        bLengthChange: false,
        searching: false,
        responsive: true,
        ordering: false
      });
      $('#fifth_gen').DataTable({
        bLengthChange: false,
        searching: false,
        responsive: true,
        ordering: false
      });
        // Select2
        $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });

      });
    </script>
</body>
</html>