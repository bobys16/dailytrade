<?php

$wd = mysqli_query($connect, "SELECT * FROM request WHERE type='Withdraw'");
$dp = mysqli_query($connect, "SELECT a.*, b.img_path, c.username FROM request a LEFT JOIN trx_proof b ON a.id=b.req_id INNER JOIN users c ON a.userid=c.id WHERE a.type='Deposit'");
$buy = mysqli_query($connect, "SELECT * FROM request WHERE type='Buy'");
$sell = mysqli_query($connect, "SELECT * FROM request WHERE type='Sell'");

?>
<div class="row">
	<div class="col-lg-12">
	    <h6 class="mb-0 text-uppercase">Withdraw History</h6>
				<hr/>
		<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example2" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>ID</th>
										<th>USER ID</th>
										<th>TYPE</th>
										<th>AMOUNT</th>
										<th>STATUS</th>
										<th>DESCRIPTION</th>
										<th>DATE</th>
										<th>ACTION</th>
									</tr>
								</thead>
								<tbody>
								<?php while($w = mysqli_fetch_assoc($wd)) { $wid = $w['id'];?>
									<tr>
										<td><?= $w['id'];?></td>
										<td><?= $w['userid'];?></td>
										<td><?= $w['type'];?></td>
										<td><?= $w['amount'];?></td>
										<td><?= $w['status'];?></td>
										<td><?= $w['description'];?></td>
										<td><?= date('Y-m-d H:i:s', $w['date']);?></td>
										<td><?php if($w['status'] == 'Pending'){
											echo '<div class="col">
										<button type="button" onclick="cancel_wd(\''.$wid.'\');;" class="btn btn-danger px-5 radius-30">Cancel</button>
										<button type="button" onclick="confirm_wd(\''.$wid.'\');;" class="btn btn-success px-5 radius-30">Confirm</button>
									</div>';
										}?></td>
									</tr>
								<?php } ?>
								
								</tbody>
							
							</table>
						</div>
					</div>
				</div>
			
	</div>
	<div class="col-lg-12">
	     <h6 class="mb-0 text-uppercase">Deposit History</h6>
				<hr/>
		<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example1" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>ID</th>
										<th>USER ID</th>
										<th>TYPE</th>
										<th>AMOUNT</th>
										<th>STATUS</th>
										<th>DATE</th>
										<th>PROOF</th>
										<th>ACTION</th>
									</tr>
								</thead>
								<tbody>
								<?php while($d = mysqli_fetch_assoc($dp)) {
									$dep= $d['id'];
									?>
									<tr>
										<td><?= $d['id'];?></td>
										<td><?= $d['userid'];?></td>
										<td><?= $d['type'];?></td>
										<td><?= $d['amount'];?></td>
										<td><?= $d['status'];?></td>
										<td><?= date('Y-m-d H:i:s', $d['date']);?></td>
										<td><img style="width: 40%;" src="/dashboard/uploads/proof/<?=$d['username']?>/<?= $d['img_path']?>"></td>
										<td><?php if($d['status'] == 'Pending'){
											echo '<div class="col">
										<button type="button" onclick="process_depo(\''.$dep.'\',\'cancel\');;" class="btn btn-danger px-5 radius-30">Cancel</button>
										<button type="button" onclick="process_depo(\''.$dep.'\',\'confirm\');;" class="btn btn-success px-5 radius-30">Confirm</button>
									</div>'; 
										} ?></td>
									</tr>
								<?php } ?>
								
								</tbody>
							
							</table>
						</div>
					</div>
				</div>
		</div>
	
	<div class="col-lg-12">
	     <h6 class="mb-0 text-uppercase">Buy History</h6>
				<hr/>
		<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example3" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>ID</th>
										<th>USER ID</th>
										<th>TYPE</th>
										<th>AMOUNT</th>
										<th>STATUS</th>
										<th>DESCRIPTION</th>
										<th>DATE</th>
										
									</tr>
								</thead>
								<tbody>
								<?php while($b = mysqli_fetch_assoc($buy)) { ?>
									<tr>
										<td><?= $b['id'];?></td>
										<td><?= $b['userid'];?></td>
										<td><?= $b['type'];?></td>
										<td><?= $b['amount'];?></td>
										<td><?= $b['status'];?></td>
										<td><?= $b['description'];?></td>
										<td><?= date('Y-m-d H:i:s', $b['date']);?></td>
										
									</tr>
								<?php } ?>
								
								</tbody>
							
							</table>
						</div>
					</div>
				</div>
		</div>
	
	<div class="col-lg-12">
	     <h6 class="mb-0 text-uppercase">Sell History</h6>
				<hr/>
		<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example4" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>ID</th>
										<th>USER ID</th>
										<th>TYPE</th>
										<th>AMOUNT</th>
										<th>STATUS</th>
										<th>DESCRIPTION</th>
										<th>DATE</th>
										
									</tr>
								</thead>
								<tbody>
								<?php while($s = mysqli_fetch_assoc($sell)) { ?>
									<tr>
										<td><?= $s['id'];?></td>
										<td><?= $s['userid'];?></td>
										<td><?= $s['type'];?></td>
										<td><?= $s['amount'];?></td>
										<td><?= $s['status'];?></td>
										<td><?= $s['description'];?></td>
										<td><?= date('Y-m-d H:i:s', $s['date']);?></td>
										
									</tr>
								<?php } ?>
								
								</tbody>
							
							</table>
						</div>
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
			
			var table = $('#example1').DataTable( {
				lengthChange: false,
				buttons: [ 'copy', 'excel', 'pdf', 'print']
			} );
		 
			table.buttons().container()
				.appendTo( '#example1_wrapper .col-md-6:eq(0)' );
			
			var table = $('#example3').DataTable( {
				lengthChange: false,
				buttons: [ 'copy', 'excel', 'pdf', 'print']
			} );
		 
			table.buttons().container()
				.appendTo( '#example3_wrapper .col-md-6:eq(0)' );
			
			var table = $('#example4').DataTable( {
				lengthChange: false,
				buttons: [ 'copy', 'excel', 'pdf', 'print']
			} );
		 
			table.buttons().container()
				.appendTo( '#example4_wrapper .col-md-6:eq(0)' );
	
		} );
	</script>
<script>

function process_depo(id, type){
	$.ajax({
		url: 'router',
		dataType: 'JSON',
		type: 'POST',
		data: "t_id="+id+"&type="+type+"&method=control&path=deposit",
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
				setTimeout(function(){ $('[view="true"][path="wddp"]').click() },1000);
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

function cancel_wd(id){
	$.ajax({
		url: 'router',
		dataType: 'JSON',
		type: 'POST',
		data: "t_id="+id+"&type=cancel&method=control&path=withdraw",
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
				setTimeout(function(){ $('[view="true"][path="wddp"]').click() },1000);
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

function confirm_wd(id){
	$.ajax({
		url: 'router',
		dataType: 'JSON',
		type: 'POST',
		data: "t_id="+id+"&type=confirm&method=control&path=withdraw",
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
				setTimeout(function(){ $('[view="true"][path="wddp"]').click() },1000);
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


    $('#kyc').on('submit', function (e) {
        e.preventDefault();
        var form_data = new FormData();
        form_data.append('idcard', $('#idcard')[0].files[0]); 
        form_data.append('selfie', $('#selfie')[0].files[0]);
        form_data.append('full_name', $('#full_name').val());
        form_data.append('address', $('#address').val());
        form_data.append('h_name', $('#h_name').val());
        form_data.append('method','control');
        form_data.append('path','kyc');
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
                
            	Lobibox.notify(res.success == "true" ? "success":"warning", {
            		pauseDelayOnHover: true,
            		size: 'mini',
            		rounded: true,
            		icon: res.success == "true" ? 'bx bx-check-circle':'bx bx-info-circle',
            		delayIndicator: false,
            		continueDelayOnInactiveTab: false,
            		position: 'top right',
            		msg: res.msg
            	});
                setTimeout(function(){
                    javascript:location.replace('');
                },2000);
            },
            error: function (res) {
            	Lobibox.notify('error', {
            		pauseDelayOnHover: true,
            		size: 'mini',
            		rounded: true,
            		delayIndicator: false,
            		icon: 'bx bx-x-circle',
            		continueDelayOnInactiveTab: false,
            		position: 'top right',
            		msg: res.msg
            	});
            }
        });
    });
</script>

