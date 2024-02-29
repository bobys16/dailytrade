<?php

$wd = mysqli_query($connect, "SELECT * FROM manager");
?>
<div class="row">
	<div class="col-lg-12">
	    <h6 class="mb-0 text-uppercase">Master Manager</h6>
				<hr/>
		<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example2" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>NAME</th>
										<th>TYPE</th>
										<th>MANAGER BALANCE</th>
										<th>GAIN</th>
										<th>WIN</th>
										<th>LOSE</th>
										<th>STATUS</th>
										<th>ACTION</th>
									</tr>
								</thead>
								<tbody>
								<?php while($w = mysqli_fetch_assoc($wd)) {
									$id = $w['id'];?>
									<tr>
										<td><?= $w['name'];?></td>
										<td><?= $w['type'];?></td>
										<td><?= $w['manager_balance'];?></td>
										<td><?= $w['gain'];?></td>
										<td><?= $w['win'];?></td>
										<td><?= $w['lose'];?></td>
										<td><center>
										<?php if($w['status'] == 'Active'){
											echo '<button onclick="close_o(\''.$id.'\');" class="btn btn-success px-5 radius-30">Active</button>';
										}else{
											echo '<button onclick="open_o(\''.$id.'\');" class="btn btn-danger px-5 radius-30">Close</button>';
										}
										?>
										</center></td>
										<td><center><?php if($w['status'] == 'Active')
										{echo '<div class="col">
										<button type="button" class="btn btn-info px-5 radius-30" onclick="setup_order(\''.$id.'\')">Start Order</button>
										</div>';}
										else{
											echo '<div class="col">
										<button type="button" class="btn btn-danger px-5 radius-30">Nothing to do</button>
										</div>';
										}
										?></center></td>
									</tr>
								<?php } ?>
								
								</tbody>
							
							</table>
						</div>
					</div>
				</div>
			
	</div>
</div>


<div class="modal fade" id="make_order" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered">
		<div class="modal-content bg-success">
			<div class="modal-header">
				<h5 class="modal-title text-white">Make Order</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body text-white">
				<div class="card">
				<div class="card-body">
				<form id="form_make_order">
					<div class="row mb-3">
						<div class="col-sm-3">
							<h6 class="mb-0">Market</h6>
						</div>
						<div class="col-sm-9">
							<input type="text" class="form-control" name="market" value="XAU/USD">
						</div>
					</div>
					<!--
					<div class="row mb-3">
						<div class="col-sm-3">
							<h6 class="mb-0">Value</h6>
						</div>
						<div class="col-sm-9">
							<input type="text" class="form-control" name="value" value="0.1">
						</div>
					</div>
					-->
					<div class="row mb-3">
						<div class="col-sm-3">
							<h6 class="mb-0">Type</h6>
						</div>
						<div class="col-sm-9">
							<select class="form-control" name="type" id="op_type">
								<option value="buy">Buy</option>
								<option value="sell">Sell</option>
							</select>
						</div>
					</div>
					<div class="row mb-3">
						<div class="col-sm-3">
							<h6 class="mb-0">Price Open</h6>
						</div>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="price_open" name="price_open" value="0">
						</div>
					</div>
					<div class="row mb-3">
						<div class="col-sm-3">
							<h6 class="mb-0">Price Close</h6>
						</div>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="price_close" name="price_close" value="0">
						</div>
					</div>
					<div class="row mb-3">
						<div class="col-sm-3">
							<h6 class="mb-0">Changes(%)</h6>
						</div>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="changes" value="0">
						</div>
					</div>
					<input hidden name="m_id" id="manager">
					<div class="row">
						<div class="col-sm-3"></div>
						<div class="col-sm-9">
							<input type="submit" class="btn btn-light px-4" value="Submit">
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


<script>
		$(document).ready(function() {
			
			
			var table = $('#example2').DataTable( {
				lengthChange: false,
				buttons: [ 'copy', 'excel', 'pdf', 'print']
			} );
		 
			table.buttons().container()
				.appendTo( '#example2_wrapper .col-md-6:eq(0)' );
	
		} );
		
			var op_price;
			var cl_price;
			$('#price_open, #price_close, #op_type').on('change', function() {
				
				op_price = $('#price_open').val();
				cl_price = $('#price_close').val();
				var formula = function() {
					var ch;
					switch($('#op_type').val()) {
						case "buy": ch = (op_price/cl_price) 
							break;
						case "sell": ch = (cl_price/op_price) 
							break;
					}
					return ch;
				}
				console.log(op_price,cl_price);
				var changes = ((1 - formula()) * 100).toFixed(2);
				$('#changes').val(changes+"%");
				
			});

function setup_order(m_id) {
	$('#manager').val(m_id);
	$('#make_order').modal('show');
	return;
}
$('#form_make_order').on('submit',function(e) {
	e.preventDefault();
	
	$.ajax({
		url: 'router',
		dataType: 'JSON',
		type: 'POST',
		data: $('#form_make_order').serialize()+"&method=control&path=make_order",
		headers: {
			'Elzgar': 'Its Lord'
		},
		success: function(r) {
			if(r.success == 'true') {
				Lobibox.notify(r.success == "true" ? "success":"warning", {
					pauseDelayOnHover: true,
					size: 'mini',
					rounded: true,
					icon: r.success == "true" ? 'bx bx-check-circle':'bx bx-info-circle',
					delayIndicator: false,
					continueDelayOnInactiveTab: false,
					position: 'top right',
					msg: r.msg
				});
			} else {
				Lobibox.notify('error', {
            		pauseDelayOnHover: true,
            		size: 'mini',
            		rounded: true,
            		delayIndicator: false,
            		icon: 'bx bx-x-circle',
            		continueDelayOnInactiveTab: false,
            		position: 'top right',
            		msg: r.msg
            	});
			}
		}
		
	})
});
	
function close_o(id){
	$.ajax({
		url: 'router',
		dataType: 'JSON',
		type: 'POST',
		data: "m_id="+id+"&method=control&path=close_order",
		headers: {
			'Elzgar': 'Its Lord'
		},
		success: function(r) {
			if(r.success == 'true') {
				Lobibox.notify(r.success == "true" ? "success":"warning", {
					pauseDelayOnHover: true,
					size: 'mini',
					rounded: true,
					icon: r.success == "true" ? 'bx bx-check-circle':'bx bx-info-circle',
					delayIndicator: false,
					continueDelayOnInactiveTab: false,
					position: 'top right',
					msg: r.msg
				});
				setTimeout(function(){ $('[view="true"][path="master"]').click() },1000);
			} else {
				Lobibox.notify('error', {
            		pauseDelayOnHover: true,
            		size: 'mini',
            		rounded: true,
            		delayIndicator: false,
            		icon: 'bx bx-x-circle',
            		continueDelayOnInactiveTab: false,
            		position: 'top right',
            		msg: r.msg
            	});
			}
		}
		
	})
};

function open_o(id){
	$.ajax({
		url: 'router',
		dataType: 'JSON',
		type: 'POST',
		data: "m_id="+id+"&method=control&path=open_master",
		headers: {
			'Elzgar': 'Its Lord'
		},
		success: function(r) {
			if(r.success == 'true') {
				Lobibox.notify(r.success == "true" ? "success":"warning", {
					pauseDelayOnHover: true,
					size: 'mini',
					rounded: true,
					icon: r.success == "true" ? 'bx bx-check-circle':'bx bx-info-circle',
					delayIndicator: false,
					continueDelayOnInactiveTab: false,
					position: 'top right',
					msg: r.msg
				});
				setTimeout(function(){ $('[view="true"][path="master"]').click() },1000);
			} else {
				Lobibox.notify('error', {
            		pauseDelayOnHover: true,
            		size: 'mini',
            		rounded: true,
            		delayIndicator: false,
            		icon: 'bx bx-x-circle',
            		continueDelayOnInactiveTab: false,
            		position: 'top right',
            		msg: r.msg
            	});
			}
		}
		
	})
};

   </script>

