
      
    <!-- ########## START: MAIN PANEL ########## -->
   
        
        <div class="card card-body bd-gray-400 p-0">
          <div class="row no-gutters">
			
			  
			  <div class="col-lg-12 p-4 bd-l bd-white-1">
				  <div class="row">
					<div class="col-sm-6">
					  <h6 class="card-title tx-uppercase tx-12 tx-white">Master Balance</h6>
					  <p style="font-size: 1.5rem;font-weight: bold;line-height: 1.2;" class="tx-normal tx-white mg-b-5 tx-lato"><?=number_format($user['fund'],2,'.',',')?> USD</p>
					 
					  <p class="tx-12">You can use this balance to start trading or sell them !</p>

					  <button data-toggle="modal" data-target="#add_usdt" class="btn btn-oblong btn-primary btn-block mg-b-5">Add USD</button>
					  <button data-toggle="modal" data-target="#wd_idr" class="btn btn-oblong btn-success btn-block mg-b-5">Transfer USD</button>
					  <button data-toggle="modal" data-target="#transfer_account" class="btn btn-oblong btn-warning btn-block mg-b-10">Transfer to Account</button>
					  <button data-toggle="modal" data-target="#transaction" class="btn btn-oblong btn-secondary btn-block mg-b-5">Transaction History</button>
					</div><!-- col-6 -->
					<div class="col-sm-6 mg-t-20 mg-sm-t-0 d-flex align-items-end justify-content-center">
					  <span class="peity-bar" data-peity="{ &quot;fill&quot;: [&quot;#17A2B8&quot;,&quot;#6F42C1&quot;,&quot;#1CAF9A&quot;,&quot;#0866C6&quot;], &quot;height&quot;: 150, &quot;width&quot;: 250 }" style="display: none;">8,6,5,9,8,4,9,3,5,9</span><svg class="peity" height="150" width="250"><rect data-value="8" fill="#17A2B8" x="2.5" y="16.666666666666686" width="20" height="133.33333333333331"></rect><rect data-value="6" fill="#6F42C1" x="27.5" y="50" width="20" height="100"></rect><rect data-value="5" fill="#1CAF9A" x="52.5" y="66.66666666666666" width="20" height="83.33333333333334"></rect><rect data-value="9" fill="#0866C6" x="77.5" y="0" width="20" height="150"></rect><rect data-value="8" fill="#17A2B8" x="102.5" y="16.666666666666686" width="20" height="133.33333333333331"></rect><rect data-value="4" fill="#6F42C1" x="127.5" y="83.33333333333334" width="20" height="66.66666666666666"></rect><rect data-value="9" fill="#1CAF9A" x="152.5" y="0" width="20" height="150"></rect><rect data-value="3" fill="#0866C6" x="177.5" y="100" width="20" height="50"></rect><rect data-value="5" fill="#17A2B8" x="202.5" y="66.66666666666666" width="20" height="83.33333333333334"></rect><rect data-value="9" fill="#6F42C1" x="227.5" y="0" width="20" height="150"></rect></svg>
					</div><!-- col-6 -->
				  </div><!-- row -->
			  </div>
		  </div>
        </div><!-- card -->
		  
          
           
                   
           <div class="col-lg-12">
		   <div class="col-md mg-t-20 mg-md-t-0">
              <div class="card card-body bg-primary tx-white bd-0">
			  <center><h4 class="card-text">Warning Please Consider!</h4></center>
                <p class="card-text"><center>One of the risks associated with foreign trade is the uncertainty of future exchange rates. The relative values of the two currencies could change between the time the deal is concluded and the time payment is received. For example, if the buyer has agreed to pay €500,000 for a shipment, and the Euro is valued at $0.85, you would expect to receive $425,000. If the Euro later decreased in value to $0.84, payment under the new rate would be only $420,000, meaning a loss of $5,000 for you. If the foreign currency increased in value, however, you would get a windfall in extra profits. </center></p>
              </div><!-- card -->
            </div>
		   </div>
           </div><!-- row -->
		   
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
		   
		   
		   <div id="add_usdt" class="modal fade effect-flip-vertical" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
              <div class="modal-content bd-0 tx-14" style="background-color: #1a2432;">
                <div class="modal-header pd-y-20 pd-x-25">
                  <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-white tx-bold" style="color:white;">Add USD</h6>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body pd-25">
				<form id="check_usdt">
                  <h4 class="lh-3 mg-b-20"><a href="" class="tx-inverse tx-white hover-primary" style="color:white;">Please Choose one of the following USDT address, and after you've sent it please enter the transaction hash!</a></h4>


				   <div class="form-layout form-layout-1">
				<div class="row mg-b-25">
				 <div class="col-lg-12" >
					<div class="form-group">
					  <label class="form-control-label">Wallet Destination: </label>
						<select class="form-control select2 form-control-dark" id="type" name="type" data-placeholder="Choose Account Destination">
							<option value="Please Choose one address type">--- Please Choose one address type ---</option>
						  <option value="trc20">TRC20</option>
							
						</select>
					</div>
				  </div>
				  <div class="col-lg-12" >
					<div class="form-group" >
					  <label class="form-control-label">Wallet Address: </label>
						<input class="form-control form-control-dark" type="text" readonly id="address" value="Please choose one address type">
					</div>
				  </div>
				  <div class="col-lg-12">
					<div class="form-group">
					  <label class="form-control-label">Transaction HASH: </label>
					  <input class="form-control form-control-dark" name="transaction_hash" type="text" placeholder="Please input transaction HASH and confirm it!" >
					</div>
					 <h4 class="lh-3 mg-b-20"><a href="" class="tx-inverse tx-white hover-primary" style="color:white;">Please make sure you've copied the correct address above, otherwise we're not responsible if you losing USDT in this process!</a></h4>

				  </div><!-- col-4 -->
				</div><!-- row -->

				<div class="form-layout-footer">
				
					<input type="hidden" name="uid" value="<?= $user['id'];?>">
					<button class="btn btn-primary" type="submit">Add USD</button>
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
		   
		   <div id="wd_idr" class="modal fade effect-flip-vertical" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
              <div class="modal-content bd-0 tx-14" style="background-color: #1a2432;">
                <div class="modal-header pd-y-20 pd-x-25">
                  <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-white tx-bold" style="color:white;">Transfer USD</h6>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body pd-25">
				<form id="wd_idr_from" callrouter="true" action="withdraw_idr">
                  <h4 class="lh-3 mg-b-20"><a href="" class="tx-inverse tx-white hover-primary" style="color:white;">Please input your desire amount in USD</a></h4>
				   <div class="form-layout form-layout-1">
				<div class="row mg-b-25">
				  <div class="col-lg-12">
					<div class="form-group">
					  <label class="form-control-label">To Address: </label>
					  <input class="form-control form-control-dark" name="to_address" type="text" placeholder="Please input your usdt balance">
					</div>
				  </div><!-- col-4 -->
				  <div class="col-lg-12">
					<div class="form-group mg-b-10-force">
					  <label class="form-control-label">Amount USD: </label>
					  <input class="form-control form-control-dark" type="number" name="amount" placeholder="Please put your USD amount">
					</div>
				  </div><!-- col-8 -->
				</div><!-- row -->

				<div class="form-layout-footer">
				
					<input type="hidden" name="uid" value="<?= $user['id'];?>">
					<button class="btn btn-primary" type="submit">Transfer USD</button>
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
		   
     <script>
	 
	 $('form#check_usdt').on('submit',function(e) {
		e.preventDefault();
        var form_data = new FormData(this);
		form_data.append('method', 'control');
		form_data.append('path', 'check_usdt');
        $.ajax({
            url: 'router', 
            dataType: 'json', 
            type: 'post',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            headers: {
                'Elzgar': 'Its Lord'
            },
            success: function (res) {
				if(res.success == 'true') {
					Swal.fire({
						title: "Success!",
						text: res.msg,
						icon: 'success',
						showCancelButton: false,
					  });
					  setTimeout(function(){ $('[view="true"][path="exchanger"]').click() }, 1000);			
				} else {
					Swal.fire({
						title: "ERROR!",
						text: res.msg,
						icon: 'error',
						showCancelButton: false,
					  });
				}
            },
            error: function (res) {
					Swal.fire({
						title: "ERROR!",
						text: JSON.stringify(res),
						icon: 'error',
						showCancelButton: false,
					  });
            }
        });
	 });

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
							title: "Succes!",
							text: r.msg,
							icon: 'success',
							showCancelButton: false,
						  })
						  setTimeout(function(){ javascript:location.replace('/dashboard') }, 1000);			
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
var trc20 = "TBSRLKAGGzikS99nvsrJGKysxo2nxW59P9";
$('#type').on('change',function() {
  /* Get the text field */
  if($(this).val() == 'trc20') {
	$('#address').val(trc20);
  }
  
  /* Alert the copied text */
})


	
	 </script>
	<script>
      $(function(){
        'use strict';

        

       

        // Select2
        $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });

      });
    </script>