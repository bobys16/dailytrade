		<div class="br-pagetitle">
		  <i class="icon ion-settings tx-70 lh-0"></i>
		  <div>
			<h4>Support</h4>
			<p class="mg-b-0">You can create or reply to the support you've created here.</p>
		  </div>
		</div>
		<div class="row no-gutters px-4">
			<div class="col-12">
			        <center><button data-toggle="modal" data-target="#create_msg" class="btn btn-success btn-lg">Open New Support</button><br><br></center>
                 <div class="table-responsive">
							<table id="datatable2" class="table table-bordered" style="width: 98% !important;">
								<thead>
									<tr>
										<th>Support ID</th>
										<th>Status</th>
										<th>Date</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
								<?php while($r = mysqli_fetch_assoc($ticket)) { ?>
									<tr>
										<td>#<?= $r['id'];?></td>
										<td><button class="btn btn-warning"><?= $r['status'];?></button></td>
										<td><?= date('d-m-Y H:i:s',$r['date']);?></td>
										<td><?php if($r['status'] == 'Open'){
											echo '<a class="btn btn-success" view="true" path="message" onclick="open_msg(\''.$r['id'].'\');" href="javascript:void(0);">Check Support</a>';
										}else{
											echo "<a class='btn btn-danger' href='javascript:void(0);'>Support Close</a>";
										}?></td>
										
									</tr>
								<?php } ?>
								
								</tbody>
								
							</table>
						</div>
			</div>
			

		</div>
		
		<div id="create_msg" class="modal fade effect-flip-vertical" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
              <div class="modal-content bd-0 tx-14" style="background-color: #1a2432;">
                <div class="modal-header pd-y-20 pd-x-25">
                  <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-white tx-bold" style="color:white;">Create New Support Ticket</h6>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body pd-25">
				<form callrouter="true" action="create_message">
                  <h4 class="lh-3 mg-b-20"><a href="" class="tx-inverse tx-white hover-primary" style="color:white;">Please enter your message detail and click create support message to send your message to the admin</a></h4>
				   <div class="form-layout form-layout-1">
				<div class="row mg-b-25">
				  <div class="col-lg-12">
					<div class="form-group">
					  <label class="form-control-label">Enter your message: </label>
					 <textarea rows="3" name="text" class="form-control form-control-dark" placeholder="Please input your message here!"></textarea>
					</div>
				  </div><!-- col-4 -->
				</div><!-- row -->

				<div class="form-layout-footer">
					<button class="btn btn-primary" type="submit">Create Support Message</button>
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
function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}
function open_msg(id){
	setCookie('msg', id, '10000');
	setTimeout(function(){ $('[view="true"][path="msg"]').click() }, 1000);			
}
      $(function(){
        'use strict';

        

        $('#datatable2').DataTable({
          bLengthChange: false,
          searching: false,
          responsive: true,
		  ordering: false
        });

        // Select2
        $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });

      });
    </script>