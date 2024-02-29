<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Twitter -->
  <meta name="twitter:site" content="@themepixels">
  <meta name="twitter:creator" content="@themepixels">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="Bracket Plus">
  <meta name="twitter:description" content="Premium Quality and Responsive UI for Dashboard.">
  <meta name="twitter:image" content="http://themepixels.me/bracketplus/img/bracketplus-social.png">

  <!-- Facebook -->
  <meta property="og:url" content="http://themepixels.me/bracketplus">
  <meta property="og:title" content="Bracket Plus">
  <meta property="og:description" content="Premium Quality and Responsive UI for Dashboard.">

  <meta property="og:image" content="http://themepixels.me/bracketplus/img/bracketplus-social.png">
  <meta property="og:image:secure_url" content="http://themepixels.me/bracketplus/img/bracketplus-social.png">
  <meta property="og:image:type" content="image/png">
  <meta property="og:image:width" content="1200">
  <meta property="og:image:height" content="600">

  <!-- Meta -->
  <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
  <meta name="author" content="ThemePixels">

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
<body>

  <!-- ########## START: LEFT PANEL ########## -->
  <div class="br-logo"><a href=""><span>[</span>daily <i>trade</i><span>]</span></a></div>
  <div class="br-sideleft sideleft-scrollbar">
    <label class="sidebar-label">Navigation</label>
    <ul class="br-sideleft-menu">
      <li class="br-menu-item">
        <a href="index.html" class="br-menu-link active">
          <i class="menu-item-icon icon ion-ios-home-outline tx-24"></i>
          <span class="menu-item-label">Dashboard</span>
        </a><!-- br-menu-link -->
      </li><!-- br-menu-item -->
	  <li class="br-menu-item">
        <a href="mailbox.html" class="br-menu-link">
          <i class="menu-item-icon icon ion-flag tx-24"></i>
          <span class="menu-item-label">CopyTrade</span>
        </a><!-- br-menu-link -->
      </li><!-- br-menu-item -->
	  <li class="br-menu-item">
        <a href="mailbox.html" class="br-menu-link">
          <i class="menu-item-icon icon ion-filing tx-24"></i>
          <span class="menu-item-label">Exchanger</span>
        </a><!-- br-menu-link -->
      </li><!-- br-menu-item -->
	  <li class="br-menu-item">
        <a href="mailbox.html" class="br-menu-link">
          <i class="menu-item-icon icon ion-settings tx-24"></i>
          <span class="menu-item-label">Setting</span>
        </a><!-- br-menu-link -->
      </li><!-- br-menu-item -->
     <li class="br-menu-item">
        <a href="mailbox.html" class="br-menu-link">
          <i class="menu-item-icon icon ion-close tx-24"></i>
          <span class="menu-item-label">Log-out</span>
        </a><!-- br-menu-link -->
      </li><!-- br-menu-item -->

      <br>
  </div><!-- br-sideleft -->
  <!-- ########## END: LEFT PANEL ########## -->

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
            <span class="logged-name hidden-md-down">Katherine</span>
            <img src="https://via.placeholder.com/500" class="wd-32 rounded-circle" alt="">
            <span class="square-10 bg-success"></span>
          </a>
          <div class="dropdown-menu dropdown-menu-header wd-250">
            <div class="tx-center">
              <a href=""><img src="https://via.placeholder.com/500" class="wd-80 rounded-circle" alt=""></a>
              <h6 class="logged-fullname">Katherine P. Lumaad</h6>
              <p>youremail@domain.com</p>
            </div>
            <hr>
            <div class="tx-center">
              <span class="profile-earning-label">Earnings After Taxes</span>
              <h3 class="profile-earning-amount">$13,230 <i class="icon ion-ios-arrow-thin-up tx-success"></i></h3>
              <span class="profile-earning-text">Based on list price.</span>
            </div>
            <hr>
            <ul class="list-unstyled user-profile-nav">
              <li><a href=""><i class="icon ion-ios-person"></i> Edit Profile</a></li>
              <li><a href=""><i class="icon ion-power"></i> Sign Out</a></li>
            </ul>
          </div><!-- dropdown-menu -->
        </div><!-- dropdown -->
      </nav>
    </div><!-- br-header-right -->
  </div><!-- br-header -->
  <!-- ########## END: HEAD PANEL ########## -->

  <!-- ########## START: MAIN PANEL ########## -->
  <div class="br-mainpanel">
    <div class="br-pagetitle">
      <i class="icon ion-ios-home-outline tx-70 lh-0"></i>
      <div>
        <h4>Dashboard</h4>
        <p class="mg-b-0">Live copy trade platform.</p>
      </div>
    </div><!-- d-flex -->

    <div class="br-pagebody pb-5">
      <div class="row row-sm widget-1">
        <div class="col-sm-6 col-lg-3 pb-2">
          <div class="card">
            <div class="card-header">
              <h6 class="card-title">USD Balance</h6>
            </div><!-- card-header -->
            <div class="card-body">
              <span class="fa fa-hand-holding-usd tx-40 tx-white"></span>
              <span>$1,850</span>
            </div><!-- card-body -->
            <div class="card-footer row no-gutters p-0 tx-white">
              <div class="col-4">
                <a class="btn w-100">Buy</a>
              </div>
              <div class="col-4">
                <a class="btn w-100">Transfer</a>
              </div>
              <div class="col-4">
                <a class="btn w-100">Sell</a>
              </div>
            </div>
          </div><!-- card -->
        </div>

        <div class="col-sm-6 col-lg-3 pb-2">
          <div class="card">
            <div class="card-header">
              <h6 class="card-title">Sponsor</h6>
            </div><!-- card-header -->
            <div class="card-body">
              <span class="fa fa-network-wired tx-40 tx-white"></span>
              <span>100k</span>
            </div><!-- card-body -->
            <div class="card-footer row no-gutters p-0 tx-white">
              <div class="col-12">
                <a class="btn w-100">View List</a>
              </div>
            </div>
          </div><!-- card -->
        </div>

        <div class="col-sm-6 col-lg-3 pb-2">
          <div class="card">
            <div class="card-header">
              <h6 class="card-title">Profit Sharing</h6>
            </div><!-- card-header -->
            <div class="card-body">
              <span class="fa fa-hand-holding-usd tx-40 tx-white"></span>
              <span>$1,850</span>
            </div><!-- card-body -->
            <div class="card-footer row no-gutters p-0 tx-white">
              <div class="col-4">
                <a class="btn w-100">Buy</a>
              </div>
              <div class="col-4">
                <a class="btn w-100">Transfer</a>
              </div>
              <div class="col-4">
                <a class="btn w-100">Sell</a>
              </div>
            </div>
          </div><!-- card -->
        </div>
		
		<div class="col-sm-6 col-lg-3 pb-2">
          <div class="card">
            <div class="card-header">
              <h6 class="card-title">Total Gain</h6>
            </div><!-- card-header -->
            <div class="card-body">
              <span class="fa fa-hand-holding-usd tx-40 tx-white"></span>
              <span>$1,850</span>
            </div><!-- card-body -->
            <div class="card-footer row no-gutters p-0 tx-white">
              <div class="col-4">
                <a class="btn w-100">Buy</a>
              </div>
              <div class="col-4">
                <a class="btn w-100">Transfer</a>
              </div>
              <div class="col-4">
                <a class="btn w-100">Sell</a>
              </div>
            </div>
          </div><!-- card -->
        </div>

      </div>
		<div class="dropdown show">
            <div class="dropdown-menu bd-2 bd-white-1 pd-0 w-100 pos-static ft-none show">
              <ul class="nav nav-tabs nav-tabs-style-1 nav-justified tx-13" role="tablist">
                <li class="nav-item">
                  <a class="nav-link pd-y-10 active show tx-14" data-toggle="tab" href="#tabLowRisk" role="tab" aria-selected="true">Low Risk</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link pd-y-10 tx-14" data-toggle="tab" href="#tabHighRisk" role="tab" aria-selected="false">High Risk</a>
                </li>
              </ul>
              <!-- Tab panes -->
              <div class="tab-content pd-30">
                <div class="tab-pane active show" id="tabLowRisk" role="tabpanel">
				  <div class="row row-sm">
					<div class="col-sm-6 col-lg-6 mb-2">
						<div class="card ">
							<div class="card-body bd-white-1 pos-relative">
							  <div class="ribbon ribbon-top-right"><span class="bg-success">Low Risk</span></div>
							  <div class="row">
								<div class="col-3 col-sm-6 col-lg-3 col-md-3">
								<a href=""><img src="https://via.placeholder.com/100" style="max-width:100%;"class="rounded-circle" alt=""></a>
								</div>
								<div class="col-9 col-sm-6 col-lg-9 col-md-9">
									<p class="tx-16 m-0 tx-roboto tx-white">Katherine Lumaad</p>
									<p class="tx-14 ">High achiever</p>
									<p class="mg-b-25"><a href="" class="btn btn-info pd-x-50">Start Copying</a></p>
								</div>
							  </div>
							</div>
							<div class="card-footer bg-transparent pd-0 mg-t-auto">
							  <div class="row no-gutters tx-center bd-y bd-white-1">
								<div class="col pd-y-15">
								  <a href="" class="tx-18 tx-bold tx-lato d-block tx-success hover-info">30%</a>
								  <small class="tx-10 tx-mont tx-uppercase tx-semibold">Gain</small>
								</div>
								<div class="col pd-y-15 ">
								  <a href="" class="tx-18 tx-bold tx-lato d-block tx-white hover-info">100</a>
								  <small class="tx-10 tx-mont tx-uppercase tx-semibold">Copiers</small>
								</div>
								<div class="col pd-y-15">
								  <a href="" class="tx-18 tx-bold tx-lato d-block tx-white hover-info">26%</a>
								  <small class="tx-10 tx-mont tx-uppercase tx-semibold">Comission</small>
								</div>
							  </div>
							  <div class="p-2">
								<small class="tx-10 tx-mont tx-uppercase tx-white tx-semibold">Profit and Loss</small>
								<div class="row row-sm wt-duration">
								  <div class="col tx-left tx-success">$ 9832.0</div>
								  <div class="col tx-right tx-danger">$ 510.58</div>
								  <div class="col-12 col-sm-12 col-md-12 col-xl-12">
									<div class="progress ht-5 mg-b-0">
									  <div class="progress-bar progress-bar-xs wd-25p" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
								  </div>
								</div>
							  </div>
							  
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-lg-6 mb-2">
						<div class="card ">
							<div class="card-body bd-white-1 pos-relative">
							  <div class="ribbon ribbon-top-right"><span class="bg-success">Low Risk</span></div>
							  <div class="row">
								<div class="col-3 col-sm-6 col-lg-3 col-md-3">
								<a href=""><img src="https://via.placeholder.com/100" style="max-width:100%;"class="rounded-circle" alt=""></a>
								</div>
								<div class="col-9 col-sm-6 col-lg-9 col-md-9">
									<p class="tx-16 m-0 tx-roboto tx-white">Katherine Lumaad</p>
									<p class="tx-14 ">High achiever</p>
									<p class="mg-b-25"><a href="" class="btn btn-info pd-x-50">Start Copying</a></p>
								</div>
							  </div>
							</div>
							<div class="card-footer bg-transparent pd-0 mg-t-auto">
							  <div class="row no-gutters tx-center bd-y bd-white-1">
								<div class="col pd-y-15">
								  <a href="" class="tx-18 tx-bold tx-lato d-block tx-success hover-info">30%</a>
								  <small class="tx-10 tx-mont tx-uppercase tx-semibold">Gain</small>
								</div>
								<div class="col pd-y-15 ">
								  <a href="" class="tx-18 tx-bold tx-lato d-block tx-white hover-info">100</a>
								  <small class="tx-10 tx-mont tx-uppercase tx-semibold">Copiers</small>
								</div>
								<div class="col pd-y-15">
								  <a href="" class="tx-18 tx-bold tx-lato d-block tx-white hover-info">26%</a>
								  <small class="tx-10 tx-mont tx-uppercase tx-semibold">Comission</small>
								</div>
							  </div>
							  <div class="p-2">
								<small class="tx-10 tx-mont tx-uppercase tx-white tx-semibold">Profit and Loss</small>
								<div class="row row-sm wt-duration">
								  <div class="col tx-left tx-success">$ 9832.0</div>
								  <div class="col tx-right tx-danger">$ 510.58</div>
								  <div class="col-12 col-sm-12 col-md-12 col-xl-12">
									<div class="progress ht-5 mg-b-0">
									  <div class="progress-bar progress-bar-xs wd-25p" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
								  </div>
								</div>
							  </div>
							  
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-lg-6 mb-2">
						<div class="card ">
							<div class="card-body bd-white-1 pos-relative">
							  <div class="ribbon ribbon-top-right"><span class="bg-success">Low Risk</span></div>
							  <div class="row">
								<div class="col-3 col-sm-6 col-lg-3 col-md-3">
								<a href=""><img src="https://via.placeholder.com/100" style="max-width:100%;"class="rounded-circle" alt=""></a>
								</div>
								<div class="col-9 col-sm-6 col-lg-9 col-md-9">
									<p class="tx-16 m-0 tx-roboto tx-white">Katherine Lumaad</p>
									<p class="tx-14 ">High achiever</p>
									<p class="mg-b-25"><a href="" class="btn btn-info pd-x-50">Start Copying</a></p>
								</div>
							  </div>
							</div>
							<div class="card-footer bg-transparent pd-0 mg-t-auto">
							  <div class="row no-gutters tx-center bd-y bd-white-1">
								<div class="col pd-y-15">
								  <a href="" class="tx-18 tx-bold tx-lato d-block tx-success hover-info">30%</a>
								  <small class="tx-10 tx-mont tx-uppercase tx-semibold">Gain</small>
								</div>
								<div class="col pd-y-15 ">
								  <a href="" class="tx-18 tx-bold tx-lato d-block tx-white hover-info">100</a>
								  <small class="tx-10 tx-mont tx-uppercase tx-semibold">Copiers</small>
								</div>
								<div class="col pd-y-15">
								  <a href="" class="tx-18 tx-bold tx-lato d-block tx-white hover-info">26%</a>
								  <small class="tx-10 tx-mont tx-uppercase tx-semibold">Comission</small>
								</div>
							  </div>
							  <div class="p-2">
								<small class="tx-10 tx-mont tx-uppercase tx-white tx-semibold">Profit and Loss</small>
								<div class="row row-sm wt-duration">
								  <div class="col tx-left tx-success">$ 9832.0</div>
								  <div class="col tx-right tx-danger">$ 510.58</div>
								  <div class="col-12 col-sm-12 col-md-12 col-xl-12">
									<div class="progress ht-5 mg-b-0">
									  <div class="progress-bar progress-bar-xs wd-25p" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
								  </div>
								</div>
							  </div>
							  
							</div>
						</div>
					</div>
				  </div>
                </div>
                <div class="tab-pane" id="tabHighRisk" role="tabpanel">
				  <div class="row row-sm">
					<div class="col-sm-6 col-lg-6 mb-2">
						<div class="card ">
							<div class="card-body bd-white-1 pos-relative">
							  <div class="ribbon ribbon-top-right"><span class="bg-danger">High Risk</span></div>
							  <div class="row">
								<div class="col-3 col-sm-6 col-lg-3 col-md-3">
								<a href=""><img src="https://via.placeholder.com/100" style="max-width:100%;"class="rounded-circle" alt=""></a>
								</div>
								<div class="col-9 col-sm-6 col-lg-9 col-md-9">
									<p class="tx-16 m-0 tx-roboto tx-white">Katherine Lumaad</p>
									<p class="tx-14 ">High achiever</p>
									<p class="mg-b-25"><a href="" class="btn btn-info pd-x-50">Start Copying</a></p>
								</div>
							  </div>
							</div>
							<div class="card-footer bg-transparent pd-0 mg-t-auto">
							  <div class="row no-gutters tx-center bd-y bd-white-1">
								<div class="col pd-y-15">
								  <a href="" class="tx-18 tx-bold tx-lato d-block tx-success hover-info">30%</a>
								  <small class="tx-10 tx-mont tx-uppercase tx-semibold">Gain</small>
								</div>
								<div class="col pd-y-15 ">
								  <a href="" class="tx-18 tx-bold tx-lato d-block tx-white hover-info">100</a>
								  <small class="tx-10 tx-mont tx-uppercase tx-semibold">Copiers</small>
								</div>
								<div class="col pd-y-15">
								  <a href="" class="tx-18 tx-bold tx-lato d-block tx-white hover-info">26%</a>
								  <small class="tx-10 tx-mont tx-uppercase tx-semibold">Comission</small>
								</div>
							  </div>
							  <div class="p-2">
								<small class="tx-10 tx-mont tx-uppercase tx-white tx-semibold">Profit and Loss</small>
								<div class="row row-sm wt-duration">
								  <div class="col tx-left tx-success">$ 9832.0</div>
								  <div class="col tx-right tx-danger">$ 510.58</div>
								  <div class="col-12 col-sm-12 col-md-12 col-xl-12">
									<div class="progress ht-5 mg-b-0">
									  <div class="progress-bar progress-bar-xs wd-25p" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
								  </div>
								</div>
							  </div>
							  
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-lg-6 mb-2">
						<div class="card ">
							<div class="card-body bd-white-1 pos-relative">
							  <div class="ribbon ribbon-top-right"><span class="bg-danger">High Risk</span></div>
							  <div class="row">
								<div class="col-3 col-sm-6 col-lg-3 col-md-3">
								<a href=""><img src="https://via.placeholder.com/100" style="max-width:100%;"class="rounded-circle" alt=""></a>
								</div>
								<div class="col-9 col-sm-6 col-lg-9 col-md-9">
									<p class="tx-16 m-0 tx-roboto tx-white">Katherine Lumaad</p>
									<p class="tx-14 ">High achiever</p>
									<p class="mg-b-25"><a href="" class="btn btn-info pd-x-50">Start Copying</a></p>
								</div>
							  </div>
							</div>
							<div class="card-footer bg-transparent pd-0 mg-t-auto">
							  <div class="row no-gutters tx-center bd-y bd-white-1">
								<div class="col pd-y-15">
								  <a href="" class="tx-18 tx-bold tx-lato d-block tx-success hover-info">30%</a>
								  <small class="tx-10 tx-mont tx-uppercase tx-semibold">Gain</small>
								</div>
								<div class="col pd-y-15 ">
								  <a href="" class="tx-18 tx-bold tx-lato d-block tx-white hover-info">100</a>
								  <small class="tx-10 tx-mont tx-uppercase tx-semibold">Copiers</small>
								</div>
								<div class="col pd-y-15">
								  <a href="" class="tx-18 tx-bold tx-lato d-block tx-white hover-info">26%</a>
								  <small class="tx-10 tx-mont tx-uppercase tx-semibold">Comission</small>
								</div>
							  </div>
							  <div class="p-2">
								<small class="tx-10 tx-mont tx-uppercase tx-white tx-semibold">Profit and Loss</small>
								<div class="row row-sm wt-duration">
								  <div class="col tx-left tx-success">$ 9832.0</div>
								  <div class="col tx-right tx-danger">$ 510.58</div>
								  <div class="col-12 col-sm-12 col-md-12 col-xl-12">
									<div class="progress ht-5 mg-b-0">
									  <div class="progress-bar progress-bar-xs wd-25p" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
								  </div>
								</div>
							  </div>
							  
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-lg-6 mb-2">
						<div class="card ">
							<div class="card-body bd-white-1 pos-relative">
							  <div class="ribbon ribbon-top-right"><span class="bg-danger">High Risk</span></div>
							  <div class="row">
								<div class="col-3 col-sm-6 col-lg-3 col-md-3">
								<a href=""><img src="https://via.placeholder.com/100" style="max-width:100%;"class="rounded-circle" alt=""></a>
								</div>
								<div class="col-9 col-sm-6 col-lg-9 col-md-9">
									<p class="tx-16 m-0 tx-roboto tx-white">Katherine Lumaad</p>
									<p class="tx-14 ">High achiever</p>
									<p class="mg-b-25"><a href="" class="btn btn-info pd-x-50">Start Copying</a></p>
								</div>
							  </div>
							</div>
							<div class="card-footer bg-transparent pd-0 mg-t-auto">
							  <div class="row no-gutters tx-center bd-y bd-white-1">
								<div class="col pd-y-15">
								  <a href="" class="tx-18 tx-bold tx-lato d-block tx-success hover-info">30%</a>
								  <small class="tx-10 tx-mont tx-uppercase tx-semibold">Gain</small>
								</div>
								<div class="col pd-y-15 ">
								  <a href="" class="tx-18 tx-bold tx-lato d-block tx-white hover-info">100</a>
								  <small class="tx-10 tx-mont tx-uppercase tx-semibold">Copiers</small>
								</div>
								<div class="col pd-y-15">
								  <a href="" class="tx-18 tx-bold tx-lato d-block tx-white hover-info">26%</a>
								  <small class="tx-10 tx-mont tx-uppercase tx-semibold">Comission</small>
								</div>
							  </div>
							  <div class="p-2">
								<small class="tx-10 tx-mont tx-uppercase tx-white tx-semibold">Profit and Loss</small>
								<div class="row row-sm wt-duration">
								  <div class="col tx-left tx-success">$ 9832.0</div>
								  <div class="col tx-right tx-danger">$ 510.58</div>
								  <div class="col-12 col-sm-12 col-md-12 col-xl-12">
									<div class="progress ht-5 mg-b-0">
									  <div class="progress-bar progress-bar-xs wd-25p" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
								  </div>
								</div>
							  </div>
							  
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-lg-6 mb-2">
						<div class="card ">
							<div class="card-body bd-white-1 pos-relative">
							  <div class="ribbon ribbon-top-right"><span class="bg-danger">High Risk</span></div>
							  <div class="row">
								<div class="col-3 col-sm-6 col-lg-3 col-md-3">
								<a href=""><img src="https://via.placeholder.com/100" style="max-width:100%;"class="rounded-circle" alt=""></a>
								</div>
								<div class="col-9 col-sm-6 col-lg-9 col-md-9">
									<p class="tx-16 m-0 tx-roboto tx-white">Katherine Lumaad</p>
									<p class="tx-14 ">High achiever</p>
									<p class="mg-b-25"><a href="" class="btn btn-info pd-x-50">Start Copying</a></p>
								</div>
							  </div>
							</div>
							<div class="card-footer bg-transparent pd-0 mg-t-auto">
							  <div class="row no-gutters tx-center bd-y bd-white-1">
								<div class="col pd-y-15">
								  <a href="" class="tx-18 tx-bold tx-lato d-block tx-success hover-info">30%</a>
								  <small class="tx-10 tx-mont tx-uppercase tx-semibold">Gain</small>
								</div>
								<div class="col pd-y-15 ">
								  <a href="" class="tx-18 tx-bold tx-lato d-block tx-white hover-info">100</a>
								  <small class="tx-10 tx-mont tx-uppercase tx-semibold">Copiers</small>
								</div>
								<div class="col pd-y-15">
								  <a href="" class="tx-18 tx-bold tx-lato d-block tx-white hover-info">26%</a>
								  <small class="tx-10 tx-mont tx-uppercase tx-semibold">Comission</small>
								</div>
							  </div>
							  <div class="p-2">
								<small class="tx-10 tx-mont tx-uppercase tx-white tx-semibold">Profit and Loss</small>
								<div class="row row-sm wt-duration">
								  <div class="col tx-left tx-success">$ 9832.0</div>
								  <div class="col tx-right tx-danger">$ 510.58</div>
								  <div class="col-12 col-sm-12 col-md-12 col-xl-12">
									<div class="progress ht-5 mg-b-0">
									  <div class="progress-bar progress-bar-xs wd-25p" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
								  </div>
								</div>
							  </div>
							  
							</div>
						</div>
					</div>
				  </div>
                </div>
              </div>
            </div><!-- dropdown-menu -->
          </div>
		  <!--
	  <div class="row row-sm">
		
		<div class="col-sm-6 col-lg-6">
            <div class="card ">
                <div class="card-body bd-white-1 pos-relative">
				  <div class="ribbon ribbon-top-right"><span class="bg-success">Low Risk</span></div>
                  <div class="row">
                    <div class="col-3 col-sm-6 col-lg-3 col-md-3">
					<a href=""><img src="https://via.placeholder.com/100" style="max-width:100%;"class="rounded-circle" alt=""></a>
					</div>
					<div class="col-9 col-sm-6 col-lg-9 col-md-9">
						<p class="tx-16 m-0 tx-roboto tx-white">Katherine Lumaad</p>
						<p class="tx-14 ">High achiever</p>
						<p class="mg-b-25"><a href="" class="btn btn-info pd-x-50">Start Copying</a></p>
					</div>
                  </div>
                </div>
                <div class="card-footer bg-transparent pd-0 mg-t-auto">
                  <div class="row no-gutters tx-center bd-y bd-white-1">
                    <div class="col pd-y-15">
                      <a href="" class="tx-18 tx-bold tx-lato d-block tx-success hover-info">30%</a>
                      <small class="tx-10 tx-mont tx-uppercase tx-semibold">Gain</small>
                    </div>
                    <div class="col pd-y-15 ">
                      <a href="" class="tx-18 tx-bold tx-lato d-block tx-white hover-info">100</a>
                      <small class="tx-10 tx-mont tx-uppercase tx-semibold">Copiers</small>
                    </div>
                    <div class="col pd-y-15">
                      <a href="" class="tx-18 tx-bold tx-lato d-block tx-white hover-info">26%</a>
                      <small class="tx-10 tx-mont tx-uppercase tx-semibold">Comission</small>
                    </div>
                  </div>
				  <div class="p-2">
					<small class="tx-10 tx-mont tx-uppercase tx-white tx-semibold">Profit and Loss</small>
					<div class="row row-sm wt-duration">
					  <div class="col tx-left tx-success">$ 9832.0</div>
					  <div class="col tx-right tx-danger">$ 510.58</div>
					  <div class="col-12 col-sm-12 col-md-12 col-xl-12">
						<div class="progress ht-5 mg-b-0">
						  <div class="progress-bar progress-bar-xs wd-25p" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
					  </div>
					</div>
				  </div>
				  
                </div>
            </div>
        </div>
		<div class="col-sm-6 col-lg-6">
            <div class="card ">
                <div class="card-body bd-white-1 pos-relative">
				  <div class="ribbon ribbon-top-right"><span class="bg-danger">High Risk</span></div>
                  <div class="row">
                    <div class="col-3 col-sm-6 col-lg-3 col-md-3">
					<a href=""><img src="https://via.placeholder.com/100" style="max-width:100%;"class="rounded-circle" alt=""></a>
					</div>
					<div class="col-9 col-sm-6 col-lg-9 col-md-9">
						<p class="tx-16 m-0 tx-roboto tx-white">Katherine Lumaad</p>
						<p class="tx-14 ">High achiever</p>
						<p class="mg-b-25"><a href="" class="btn btn-info pd-x-50">Start Copying</a></p>
					</div>
                  </div>
                </div>
                <div class="card-footer bg-transparent pd-0 mg-t-auto">
                  <div class="row no-gutters tx-center bd-y bd-white-1">
                    <div class="col pd-y-15">
                      <a href="" class="tx-18 tx-bold tx-lato d-block tx-success hover-info">30%</a>
                      <small class="tx-10 tx-mont tx-uppercase tx-semibold">Gain</small>
                    </div>
                    <div class="col pd-y-15 ">
                      <a href="" class="tx-18 tx-bold tx-lato d-block tx-white hover-info">100</a>
                      <small class="tx-10 tx-mont tx-uppercase tx-semibold">Copiers</small>
                    </div>
                    <div class="col pd-y-15">
                      <a href="" class="tx-18 tx-bold tx-lato d-block tx-white hover-info">26%</a>
                      <small class="tx-10 tx-mont tx-uppercase tx-semibold">Comission</small>
                    </div>
                  </div>
				  <div class="p-2">
					<small class="tx-10 tx-mont tx-uppercase tx-white tx-semibold">Profit and Loss</small>
					<div class="row row-sm wt-duration">
					  <div class="col tx-left tx-success">$ 9832.0</div>
					  <div class="col tx-right tx-danger">$ 510.58</div>
					  <div class="col-12 col-sm-12 col-md-12 col-xl-12">
						<div class="progress ht-5 mg-b-0">
						  <div class="progress-bar progress-bar-xs wd-25p" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
					  </div>
					</div>
				  </div>
                </div>
              </div>
            </div>
		
		</div>
				  -->
	</div>

  </div><!-- br-pagebody -->
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

  <script src="js/bracket.js?q=1111"></script>
  <script src="js/ResizeSensor.js"></script>
  <script src="index.js"></script>

</body>
<script>
  let x1 = $('#ex1').html();;
  let x2 = $('#ex2').html();
  let x3 = $('#ex3').html();


  $('#ex3').html(kFormatter(x3, x3.length));
  $('#ex2').html(kFormatter(x2, x2.length));
  $('#ex1').html(kFormatter(x1, x1.length));

  function kFormatter(num, digits) {
    const lookup = [
      { value: 1, symbol: "" },
      { value: 1e3, symbol: "k" },
      { value: 1e6, symbol: "M" },
      { value: 1e9, symbol: "B" },
      { value: 1e12, symbol: "T" }
    ];
    const rx = /\.0+$|(\.[0-9]*[1-9])0+$/;
    var item = lookup.slice().reverse().find(function (item) {
      return num >= item.value;
    });
    return item ? (num / item.value).toFixed(digits).replace(rx, "$1") + item.symbol : "0";
  }
</script>



</html>