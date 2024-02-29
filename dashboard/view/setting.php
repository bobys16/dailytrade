		<div class="br-pagetitle">
		  <i class="icon ion-settings tx-70 lh-0"></i>
		  <div>
			<h4>Setting</h4>
			<p class="mg-b-0">Your rest data was here.</p>
		  </div>
		</div>
		<div class="row no-gutters px-4">
			<div class="col-12">
			  <h6 class="br-section-label mg-t-25 mg-b-10">Account Information</h6>
			  <p class="br-section-text mg-b-10">Your Profile Informations</p>
			  <div class="form-layout form-layout-1">
				<div class="row mg-b-25">
				  <div class="col-lg-4">
					<div class="form-group">
					  <label class="form-control-label">Full Name: </label>
					  <input class="form-control form-control-dark" type="text" value="<?= $user['full_name'];?>" disabled>
					</div>
				  </div><!-- col-4 -->
				  <div class="col-lg-4">
					<div class="form-group">
					  <label class="form-control-label">Email address: </label>
					  <input class="form-control form-control-dark" type="text" value="<?= $user['email'];?>" disabled>
					</div>
				  </div><!-- col-4 -->
				  <div class="col-lg-4">
					<div class="form-group">
					  <label class="form-control-label">Username: </label>
					  <input class="form-control form-control-dark" type="text" value="<?= $user['username'];?>" disabled>
					</div>
				  </div><!-- col-4 -->
				  <div class="col-lg-12">
					<div class="form-group mg-b-10-force">
					  <label class="form-control-label">Phone: </label>
					  <input class="form-control form-control-dark" type="text" value="<?= $user['phone'];?>" disabled>
					</div>
				  </div><!-- col-8 -->
			   
				</div><!-- row -->
				<form callrouter="true" action="reset_pass">
				<div class="form-layout-footer">
				
					<input type="hidden" name="uid" value="<?= $user['id'];?>">
					<input type="hidden" name="token" value="<?= md5(rand(10000,1000000 ));?>">
					<button class="btn btn-danger" type="submit">Reset Password</button>
				
				</div><!-- form-layout-footer -->
				</form>
			  </div><!-- form-layout -->
			</div>
			
			<div class="col-12">
			  <h6 class="br-section-label mg-t-25 mg-b-10">Profile Picture</h6>
			  <p class="br-section-text mg-b-10">You can change your profile picture here</p>
			  <form id="change_pp">
			  <div class="form-layout form-layout-1">
				<div class="row mg-b-25">
				  <div class="col-lg-12">
					<div class="form-group mb-b-10-force">
					<label class="form-control-label">Please upload transfer Proof as image</label>
					<input type="file" class="form-control form-control-dark" name="trx_proof" id="trx_proof">
					<i>Please upload .jpg .png .jpeg image only!</i>
					</div>
				  </div>
				</div><!-- row -->

				<div class="form-layout-footer">
				  <button class="btn btn-primary">Change Detail</button>
				</div><!-- form-layout-footer -->
			  </div><!-- form-layout -->
			  </form>
			</div>
			
			
			


		</div>
		
<script>
 $('form#change_pp').on('submit',function(e) {
e.preventDefault();
var form_data = new FormData(this);
form_data.append('method', 'control');
form_data.append('path', 'change_pp');
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
			  //setTimeout(function(){ $('[view="true"][path="setting"]').click() }, 1000);			
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
</script>