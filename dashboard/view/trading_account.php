<?php 
$check = mysqli_query($connect, "SELECT a.*, b.name, b.status as m_status FROM trading_account a LEFT JOIN manager b ON a.copy = b.id WHERE a.uid='".$uid."'");

while($row = mysqli_fetch_assoc($check)) if($row['type'] == "High") $high_acc=$row; else $low_acc=$row;

$account_history = mysqli_query($connect,"SELECT * FROM history WHERE uid='".$uid."' AND type IN('add','deduct') ORDER BY id DESC LIMIT 15");

$low_history = mysqli_query($connect, "SELECT * FROM trading_history WHERE status='Close' AND account_id = '".$low_acc['account_id']."' ORDER BY id DESC LIMIT 15");
$high_history = mysqli_query($connect, "SELECT * FROM trading_history WHERE status='Close' AND account_id = '".$high_acc['account_id']."' ORDER BY id DESC LIMIT 15");

$low_active = false;
$high_active = false;
if(array_key_exists('m_status',$low_acc) && $low_acc['m_status'] == 'Active') {
	$low_active = true;
}
if(array_key_exists('m_status',$high_acc) && $high_acc['m_status'] == 'Active') {
	$high_active = true;
}
?>
<style>
.hidden {
	display: none;
}
.show {
	display: block;
}
.blink_me {
  animation: blinker .7s linear infinite;
}

@keyframes blinker {
  50% {
    opacity: 0.1;
  }
}
</style>
<div class="row m-4 py-4">
  <div class="col-sm-12 col-lg-6 col-md-6 col-xl-6">
	  <div class="card bg-success tx-white bd-0 mb-4 <?=$low_active == true ? 'blink_me':' '?>" onclick="change_history('low');">
		<div class="card-body">
		  <p style="float: right;" class="tx-18"><strong><?=$low_active == true ? 'Active':'Closed'?> Trade</strong></p>
		  <h5 class="card-title tx-white tx-medium mg-b-10"><?=$low_acc['account_id']?></h5>
		  <p class="card-subtitle tx-normal mg-b-15 tx-white-8">Low Risk Account</p>
		  <p class="card-text">You have $<?=$low_acc['balance']?> at this account that following <strong><?= $low_acc['copy'] == 0 ? 'None':$low_acc['name']?></strong></p>
		  <button href="#" class="btn btn-primary btn-sm card-link tx-white-7 hover-white mx-0" style="color:white;" data-toggle="modal" data-target="#transfer_account"  >Add Balance</button>
		  <button href="#" class="btn btn-primary btn-sm card-link tx-white-7 hover-white mx-0" style="color:white;" data-toggle="modal" data-target="#wd_account">Take Balance</button>
		  <button href="#" class="btn btn-primary btn-sm card-link tx-white-7 hover-white mx-0" style="color:white;" onclick="unfollow('<?=$low_acc['account_id'];?>');"<?=$low_active == true ? 'hidden':' '?>>Unfollow</button>
		</div>
	  </div>
  </div>
  <div class="col-sm-12 col-lg-6 col-md-6 col-xl-6">
	  <div class="card bg-danger tx-white bd-0 mb-4 <?=$high_active == true ? 'blink_me':' '?>" onclick="change_history('high');">
		<div class="card-body">
		  <p style="float: right;" class="tx-18"><strong><?=$high_active == true ? 'Active':'Closed'?> Trade</strong></p>
		  <h5 class="card-title tx-white tx-medium mg-b-10"><?=$high_acc['account_id']?></h5>
		  <p class="card-subtitle tx-normal mg-b-15 tx-white-8">High Risk Account</p>
		  <p class="card-text">You have $<?=$high_acc['balance']?> at this account that following <strong><?= $high_acc['copy'] == 0 ? 'None':$high_acc['name']?></strong></p>
		  <button href="#" class="btn btn-primary btn-sm card-link tx-white-7 hover-white mx-0" style="color:white;" data-toggle="modal" data-target="#transfer_account"  >Add Balance</button>
		  <button href="#" class="btn btn-primary btn-sm card-link tx-white-7 hover-white mx-0" style="color:white;" data-toggle="modal" data-target="#wd_account">Take Balance</button>
		  <button href="#" class="btn btn-primary btn-sm card-link tx-white-7 hover-white mx-0" style="color:white;" onclick="unfollow('<?=$high_acc['account_id'];?>');"<?=$high_active == true ? 'hidden':' '?>>Unfollow</button>
		</div>
	  </div>
  </div>
  <div class="col-12 show" id="history">
	<div class="wd-100p" style="overflow-x: auto;">
	  <table class="table table-bordered bd-2 bd-white-1">
		<thead class="thead-colored thead-primary">
			<th>#ID</th>
			<th>Type</th>
			<th>Description</th>
			<th>Amount</th>
			<th>Account</th>
			<th>Date</th>
		</thead>
		<tbody>
			<?php if(mysqli_num_rows($account_history) == 0) { ?>
			<td colspan="7" class="tx-center">No Data yet..</td>
			<?php } 
			else {
				while($row = mysqli_fetch_assoc($account_history)) {
			?>
			<tr>
				<td><?=$row['id']?></td>
				<td><?=strtoupper($row['type'])?></td>
				<td><?=$row['description']?></td>
				<td><?=$row['amount']?></td>
				<td><?=$row['from']?></td>
				<td><?=date('d-m-Y H:i:s', $row['date'])?></td>
			</tr>
			<?php }
			} ?>
		</tbody>
	  </table>
	</div>
  </div>
  <div class="col-12 hidden" id="low">
	<div class="wd-100p" style="overflow-x: auto;">
	  <table class="table table-bordered bd-2 bd-white-1">
		<thead class="thead-colored thead-primary">
			<th>Account ID</th>
			<th>Market</th>
			<th>Type</th>
			<th>Open Price</th>
			<th>Close Price</th>
			<th>Value</th>
			<th>Gain</th>
			<th>Shared</th>
			<th>Date</th>
		</thead>
		<tbody>
			<?php if(mysqli_num_rows($low_history) == 0) { ?>
			<td colspan="7" class="tx-center">No Data yet..</td>
			<?php } 
			else {
				while($row = mysqli_fetch_assoc($low_history)) {
			?>
			<tr>
				<td><?=$row['account_id']?></td>
				<td><?=$row['market']?></td>
				<td><?=$row['type']?></td>
				<td><?=$row['open_position']?></td>
				<td><?=$row['close_position']?></td>
				<td><?=$row['value']?></td>
				
				<td style="color:<?=$row['gain'] > 0 ? '#23BF08':'#DC3545'?>;"><?=$row['gain'] * 70/100;?></td>
				<td><?php if($row['gain'] > 0){
					echo $row['gain'] * 30/100;
				}else{
					echo 0;
				}?></td>
				<td><?=date('d-m-Y H:i:s', $row['date'])?></td>
			</tr>
			<?php }
			} ?>
		</tbody>
	  </table>
	</div>
  </div>
  <div class="col-12 hidden" id="high">
	<div class="wd-100p" style="overflow-x: auto;">
	  <table class="table table-bordered bd-2 bd-white-1">
		<thead class="thead-colored thead-primary">
			<th>Account ID</th>
			<th>Market</th>
			<th>Type</th>
			<th>Open Price</th>
			<th>Close Price</th>
			<th>Value</th>
			<th>Gain</th>
			<th>Shared</th>
			<th>Date</th>
		</thead>
		<tbody>
			<?php if(mysqli_num_rows($high_history) == 0) { ?>
			<td colspan="7" class="tx-center">No Data yet..</td>
			<?php } 
			else {
				while($row = mysqli_fetch_assoc($high_history)) {
			?>
			<tr>
				<td><?=$row['account_id']?></td>
				<td><?=$row['market']?></td>
				<td><?=$row['type']?></td>
				<td><?=$row['open_position']?></td>
				<td><?=$row['close_position']?></td>
				<td><?=$row['value']?></td>
				<td style="color:<?=$row['gain'] > 0 ? '#23BF08':'#DC3545'?>;"><?=$row['gain'] * 80/100?></td>
				<td><?php if($row['gain'] > 0){
					echo $row['gain'] * 20/100;
				}else{
					echo 0;
				}?></td>
				<td><?=date('d-m-Y H:i:s', $row['date'])?></td>
			</tr>
			<?php }
			} ?>
		</tbody>
	  </table>
	</div>
  </div>
</div>

 <div id="transfer_account" class="modal fade effect-flip-vertical" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
              <div class="modal-content bd-0 tx-14" style="background-color: #1a2432;">
                <div class="modal-header pd-y-20 pd-x-25">
                  <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-white tx-bold" style="color:white;">Transfer Master Balance</h6>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body pd-25">
				<form id="transfer_usd">
                  <h4 class="lh-3 mg-b-20"><a href="" class="tx-inverse tx-white hover-primary" style="color:white;">Please choose an account and amount you want to transfer</a></h4>
				   <div class="form-layout form-layout-1">
				<div class="row mg-b-25">
				 <div class="col-lg-12">
					<div class="form-group">
					  <label class="form-control-label">Account Destination: </label>
						<select class="form-control select2 form-control-dark" name="account_destination" data-placeholder="Choose Account Destination">
						<?php $tacc = mysqli_query($connect, "SELECT * FROM trading_account WHERE uid='".$uid."'");
						while($ac = mysqli_fetch_assoc($tacc)) {
						?>
						  <option value="<?= $ac['account_id'];?>"><?= $ac['account_id'];?> / (<?= $ac['type'];?> Type)</option>
						<?php } ?>
						</select>
					</div>
				  </div>
				  <div class="col-lg-12">
					<div class="form-group">
					  <label class="form-control-label">Amount in USD: </label>
					  <input class="form-control form-control-dark" name="amount" id="tf_amount" type="text" placeholder="Please input amount you want to transfer for ex: 100" >
					</div>
				  </div><!-- col-4 -->
				</div><!-- row -->

				<div class="form-layout-footer">
					<button class="btn btn-primary" type="submit">Transfer</button>
				</form>
				</div><!-- form-layout-footer -->
			  </div><!-- form-layout -->
                 </div>
                <div class="modal-footer">
                   <button type="button" class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-semibold" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div><!-- modal-dialog -->
          </div>
		  
		  
<div id="wd_account" class="modal fade effect-flip-vertical" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
              <div class="modal-content bd-0 tx-14" style="background-color: #1a2432;">
                <div class="modal-header pd-y-20 pd-x-25">
                  <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-white tx-bold" style="color:white;">Take Trading Account Balance</h6>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body pd-25">
				<form id="wd_usd">
                  <h4 class="lh-3 mg-b-20"><a href="" class="tx-inverse tx-white hover-primary" style="color:white;">Please choose an account and amount you want to take</a></h4>
				   <div class="form-layout form-layout-1">
				<div class="row mg-b-25">
				 <div class="col-lg-12">
					<div class="form-group">
					  <label class="form-control-label">Account Destination: </label>
						<select class="form-control select2 form-control-dark" name="from_account" data-placeholder="Choose Account">
						<?php $tacc = mysqli_query($connect, "SELECT * FROM trading_account WHERE uid='".$uid."'");
						while($ac = mysqli_fetch_assoc($tacc)) {
						?>
						  <option value="<?= $ac['account_id'];?>"><?= $ac['account_id'];?> / (<?= $ac['type'];?> Type)</option>
						<?php } ?>
						</select>
					</div>
				  </div>
				  <div class="col-lg-12">
					<div class="form-group">
					  <label class="form-control-label">Amount in USD: </label>
					  <input class="form-control form-control-dark" name="amount" id="tk_amount" type="text" placeholder="Please input amount you want to transfer for ex: 100" >
					</div>
				  </div><!-- col-4 -->
				</div><!-- row -->

				<div class="form-layout-footer">
					<button class="btn btn-primary" type="submit">Transfer</button>
				</form>
				</div><!-- form-layout-footer -->
			  </div><!-- form-layout -->
                 </div>
                <div class="modal-footer">
                   <button type="button" class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-semibold" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div><!-- modal-dialog -->
          </div>
		   
		   
		   
<script>
var current = 'history';
function change_history(a) {
	$('#'+current).slideUp('slow', function() {
		$('#'+a).slideDown('slow');
		current = a;
	});
}

function unfollow(aid) {
	
	$.ajax({
		url: 'router',
		dataType: 'JSON',
		type: 'POST',
		data: "account_id="+aid+"&method=control&path=unfollow",
		headers: {
			'Elzgar': 'Its Lord'
		},
		success: function(r) {
			if(r.success == 'true') {
				Swal.fire({
					title: "Success",
					text: r.msg,
					icon: 'success',
					showCancelButton: false,
				  })
				setTimeout(function(){ $('[view="true"][path="trading_account"]').click() }, 1000);				
			} else {
				Swal.fire({
					title: "error",
					text: r.msg,
					icon: 'success',
					showCancelButton: false,
				  })
			}
		},
		error: function(e) {			
			Swal.fire({
				title: "ERROR!",
				text: "There is some problem in our back. Please try again later",
				icon: 'success',
				showCancelButton: false,
			  })
		}
		
	})
	return;
}


$('#transfer_usd').on('submit',function(e) {
	e.preventDefault();	 

	var v1 = $('#tf_amount').val();
	v2 = 14300;
	min = 10;
	v3 = parseFloat(v1 / v2).toFixed(2);
	if(v1 < 10){
		Swal.fire({
            title: "Requirement Doesn't Meet",
            text: 'You must transfer at least '+min+' USD to continue',
            icon: 'error',
            showCancelButton: false,
          })
	} else{
		Swal.fire({
            title: 'Are you sure want to transfer?',
            text: 'You will transfer '+v1+' USD to the selected account!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#79E249',
            cancelButtonColor: '#d33',
            confirmButtonText: "Yes, i'm pretty sure!",
          }).then(function(result) {
			if (result.isConfirmed) {
				$.ajax({
					url: 'router',
					dataType: 'JSON',
					type: 'POST',
					data: $('#transfer_usd').serialize()+"&method=control&path=transfer_account",
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
							title: "Success!",
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


$('#wd_usd').on('submit',function(e) {
	e.preventDefault();	 
	var v1 = $('#tk_amount').val();
	min = 1;
	if(v1 < 10){
		Swal.fire({
            title: "Requirement Doesn't Meet",
            text: 'You must transfer at least '+min+' USD to continue',
            icon: 'error',
            showCancelButton: false,
          })
	} else{
		Swal.fire({
            title: 'Are you sure want to take balance?',
            text: 'You will take '+v1+' USD from the selected account!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#79E249',
            cancelButtonColor: '#d33',
            confirmButtonText: "Yes, i'm pretty sure!",
          }).then(function(result) {
			if (result.isConfirmed) {
				$.ajax({
					url: 'router',
					dataType: 'JSON',
					type: 'POST',
					data: $('#wd_usd').serialize()+"&method=control&path=take_balance",
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
							title: "Success!",
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