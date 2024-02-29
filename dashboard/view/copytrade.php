<?php 
$getManager = mysqli_query($connect, "SELECT * FROM manager");
$low = array();
$high = array();
while($row = mysqli_fetch_assoc($getManager)) {
	if($row['type'] == "Low") $low[]=$row; else $high[] = $row;
}
?>
 
	<div class="p-4">
		<div class="dropdown show">
            <div class="dropdown-menu bd-2 bd-white-1 pd-0 w-100 pos-static ft-none show">
              <ul class="nav nav-tabs nav-tabs-style-1 nav-justified tx-13" role="tablist">
                <li class="nav-item">
                  <a class="nav-link pd-y-10 active show open tx-14" data-toggle="tab" href="#tabLowRisk" role="tab" aria-selected="true">Low Risk</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link pd-y-10 tx-14" data-toggle="tab" href="#tabHighRisk" role="tab" aria-selected="false">High Risk</a>
                </li>
              </ul>
              <!-- Tab panes -->
              <div class="tab-content pd-30">
                <div class="tab-pane" id="tabLowRisk" role="tabpanel">
				  <div class="row row-sm">
					<?php foreach($low as $i => $low_data) { ?>
					<div class="col-sm-6 col-lg-6 mb-4">
						<div class="card ">
							<div class="card-body bd-white-1 pos-relative">
							  <div class="ribbon ribbon-top-right"><span class="bg-success">Low Risk</span></div>
							  <div class="row">
								<div class="col-3 col-sm-6 col-lg-3 col-md-3">
								<a href=""><img src="<?=$low_data['img']?>" style="max-width:100%;"class="rounded-circle" alt=""></a>
								</div>
								<div class="col-9 col-sm-6 col-lg-9 col-md-9">
								  <form callrouter="true" action="follow" method="POST">
									<p class="tx-16 m-0 tx-roboto tx-white"><?=$low_data['name']?></p>
									<p class="tx-14 "><?=$low_data['title']?></p>
									<input hidden name="manager_id" value="<?=$low_data['id']?>">
									<p class="mg-b-25"><button type="submit" class="btn btn-info pd-x-50">Start Copying</button></p>
								  </form>
								</div>
							  </div> 
							</div>
							<div class="card-footer bg-transparent pd-0 mg-t-auto">
							  <div class="row no-gutters tx-center bd-y bd-white-1">
								<div class="col pd-y-15">
								  <a href="" class="tx-18 tx-bold tx-lato d-block tx-success hover-info"><?=$low_data['manager_balance']?>$</a>
								  <small class="tx-10 tx-mont tx-uppercase tx-semibold">Balance</small>
								</div>
								<div class="col pd-y-15 ">
								  <a href="" class="tx-18 tx-bold tx-lato d-block tx-white hover-info"><?= mysqli_num_rows(mysqli_query($connect, "SELECT * FROM trading_account WHERE copy='".$low_data['id']."'"));?></a>
								  <small class="tx-10 tx-mont tx-uppercase tx-semibold">Copiers</small>
								</div>
								<div class="col pd-y-15">
								  <a href="" class="tx-18 tx-bold tx-lato d-block tx-white hover-info">30%</a>
								  <small class="tx-10 tx-mont tx-uppercase tx-semibold">Comission</small>
								</div>
							  </div>
							  <div class="p-4">
								<small class="tx-10 tx-mont tx-uppercase tx-white tx-semibold">Gain and loses</small>
								<div class="row row-sm wt-duration">
								  <div class="col tx-left tx-success">$ <?=number_format($low_data['win'], 2, '.', '')?></div>
								  <div class="col tx-right tx-danger">$ <?=number_format($low_data['lose'], 2, '.', '')?></div>
								  <div class="col-12 col-sm-12 col-md-12 col-xl-12">
									<div class="progress ht-5 mg-b-0">
									  <div class="progress-bar progress-bar-xs wd-100p bg-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
								  </div>
								</div>
							  </div>
							  
							</div>
						</div>
					</div>
					<?php } ?>
				  </div>
                </div>
                <div class="tab-pane" id="tabHighRisk" role="tabpanel">
				  <div class="row row-sm">
					<?php foreach($high as $i => $high_data) { ?>
					<div class="col-sm-6 col-lg-6 mb-4">
						<div class="card ">
							<div class="card-body bd-white-1 pos-relative">
							  <div class="ribbon ribbon-top-right"><span class="bg-danger">High Risk</span></div>
							  <div class="row">
								<div class="col-3 col-sm-6 col-lg-3 col-md-3">
								<a href=""><img src="<?=$high_data['img']?>" style="max-width:100%;"class="rounded-circle" alt=""></a>
								</div>
								<div class="col-9 col-sm-6 col-lg-9 col-md-9">
								  <form callrouter="true" action="follow">
									<p class="tx-16 m-0 tx-roboto tx-white"><?=$high_data['name']?></p>
									<p class="tx-14 "><?=$high_data['title']?></p>
									<input hidden name="manager_id" value="<?=$high_data['id']?>">
									<p class="mg-b-25"><button type="submit" class="btn btn-info pd-x-50">Start Copying</button></p>
								  </form>
								</div>
							  </div>
							</div>
							<div class="card-footer bg-transparent pd-0 mg-t-auto">
							  <div class="row no-gutters tx-center bd-y bd-white-1">
								<div class="col pd-y-15">
								  <a href="" class="tx-18 tx-bold tx-lato d-block tx-success hover-info"><?=$high_data['manager_balance']?>$</a>
								  <small class="tx-10 tx-mont tx-uppercase tx-semibold">Balance</small>
								</div>
								<div class="col pd-y-15 ">
								  <a href="" class="tx-18 tx-bold tx-lato d-block tx-white hover-info"><?= mysqli_num_rows(mysqli_query($connect, "SELECT * FROM trading_account WHERE copy='".$high_data['id']."'"));?></a>
								  <small class="tx-10 tx-mont tx-uppercase tx-semibold">Copiers</small>
								</div>
								<div class="col pd-y-15">
								  <a href="" class="tx-18 tx-bold tx-lato d-block tx-white hover-info">20%</a>
								  <small class="tx-10 tx-mont tx-uppercase tx-semibold">Comission</small>
								</div>
							  </div>
							  <div class="p-4">
								<small class="tx-10 tx-mont tx-uppercase tx-white tx-semibold">Gain and Loses</small>
								<div class="row row-sm wt-duration">
								  <div class="col tx-left tx-success">$ <?=number_format($high_data['win'], 2, '.', '')?></div>
								  <div class="col tx-right tx-danger">$ <?=number_format($high_data['lose'], 2, '.', '')?></div>
								  <div class="col-12 col-sm-12 col-md-12 col-xl-12">
									<div class="progress ht-5 mg-b-0">
									  <div class="progress-bar progress-bar-xs wd-100p bg-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
								  </div>
								</div>
							  </div>
							  
							</div>
						</div>
					</div>
					<?php } ?>
				  </div>
                </div>
				
              </div>
			  
            </div><!-- dropdown-menu -->
          </div>
	</div>
	<div class="col-lg-12">
		   <div class="col-md mg-t-20 mg-md-t-0">
              <div class="card card-body bg-primary tx-white bd-0">
			  <center><h4 class="card-text">Warning Please Consider!</h4></center>
                <p class="card-text"><center>By subscribing to the Copy Trading Service, you acknowledge that you understand all aspects of the risk associated with the copied account and the copied trader’s trading objectives. You understand and agree that the automated trading execution pursuant to Copy Trading Service means trades are opened and closed in your account without your manual intervention and that all activity relating to the Copy Trading Service is subject to the provisions of the Terms of Services. Should a copied trader cash-out and withdraw, you may also generate a materially different result than the trader, account, portfolio andor strategy that you copied as it may affect the Copy Trading Service proportions. </center></p>
              </div><!-- card -->
            </div>
		   </div>
	<script>
	$(function(){
        $(document).ready(function() {
			$('.open').click();
		});
      });
	</script>