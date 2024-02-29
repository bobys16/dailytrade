<?php
$msg_id = $_COOKIE['msg'];
$message = mysqli_query($connect, "SELECT * FROM support_msg WHERE id='".$msg_id."'");
?>
<div class="row no-gutters">
            <div class="col-lg-8">
              <div class="media-list bg-br-primary rounded bd bd-white-1">
                <?php while($r = mysqli_fetch_assoc($message)) { ?>
				<div class="media pd-20 pd-xs-30">
                  <img src="profile.png?q=12" alt="" class="wd-40 rounded-circle">
                  <div class="media-body mg-l-20">
                    <div class="d-flex justify-content-between mg-b-10">
                      <div>
                        <h6 class="mg-b-2 tx-white tx-14"><?php if($r['send'] == 'Admin')
						{
							echo '<span style="color:red;">ADMIN</span>';
						}else{
							echo 'YOU';
						}?></h6>
                      </div>
                      <span class="tx-12"><?= date('d-m-Y H:i:s', $r['date']);?></span>
                    </div><!-- d-flex -->
                    <p class="mg-b-20"><?= $r['text'];?></p>
                   
                  </div><!-- media-body -->
                </div><!-- media -->
				<?php } ?>
              </div><!-- card -->

              <div class="bg-black-1 pd-y-12 tx-center mg-t-15 mg-xs-t-30 bd bd-white-1 rounded">
                <div class="col-lg">
				<form callrouter="true" action="send_message">
			  <input type="hidden" name="msg_id" value="<?= $msg_id;?>">
              <textarea rows="3" name="text" class="form-control form-control-dark" placeholder="Please input your message here!"></textarea>
			  <button type="submit" class="btn-success btn form-control">Send Message</button>
			  </form>
            </div>
              </div>
            </div><!-- col-lg-8 -->
            <div class="col-lg-4 mg-t-30 mg-lg-t-0">
              <div class="card pd-20 pd-xs-30 bd-gray-400">
                <h6 class="tx-white tx-uppercase tx-13 mg-b-25">Support Information</h6>

                <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Support ID</label>
                <p class="tx-info mg-b-25">#<?= $msg_id;?></p>

               

              
              </div><!-- card -->

              </div><!-- col-lg-4 -->
          </div><!-- row -->
		  
		   
		   