<?php
session_start();
if (!isset($_SESSION['sess_user_id'])) {
    header('location:index.php');
}
include('config.php');

require_once 'controller.php';
require('header.php'); 
 
?>
		<div class="main-wrapper content-body-mod">
			 <div class='container'>
			 <div class="row justify-content-center">
					<div class="col-sm-12">
						<div class="section-title">
								<h3>Dashboard <a  class="btn btn-primary pull-right" data-toggle="modal" data-target="#add_campaign"><i class='fa fa-plus'></i></a></h3>
								 
							</div>
					</div>
				</div>
				
					
				<div class="row justify-content-center">
						 <?php
							if(isset($_SESSION['msg'])){
								if($_SESSION['show']==1)
								{
									
									?>

									<div onclick='$(this).hide()' class='col-sm-12 alert <?= ($_SESSION['msg']=='error')?'alert-danger':'alert-success' ?> '>
												 
											  <?= $_SESSION['msg']; ?>
										</div>
									<?php
									$_SESSION['show']=0;
								}
								
								
							}
							 
						 
						 ?>
					
				 </div>
				
					<div class="row justify-content-center">
						<div class="col-lg-12">
						<table class='table table-bordered table-striped'>
							<tr>
								<th>Campaign Name</th>
								<th>SMS Text</th>
								<th>Schedule Date</th>
								<th>Created Date</th>
								<th>Status</th>
								<th colspan="4">Action</th>
								<th colspan="2">Reports</th>
							</tr>
							<?php
							$query = "select * from campaigns";
							$result = mysqli_query($connect, $query);
							while ($data = mysqli_fetch_array($result)) {
							if ($data['is_delete'] <> 1) {
								?>
								<tr>
									<td><?php echo $data['campaign_name']; ?></td>
									<td><a data-toggle="popover" href=""
										   data-content="<?php echo $data['sms_text']; ?>"><?php echo substr($data['sms_text'], 0, 10); ?>
										</a></td>
									<td><?php echo $data['created_at']; ?></td>
									<td><?php echo $data['schedule_date']; ?></td>
									<td id="<?php echo $data['id']; ?>">
										<?php
										if ($data['status'] == 1) { ?>
											Completed...
										<?php } else if ($data['status'] == 2) {
											?>
											Stopped..
											<?php
										} else if ($data['status'] == 3) {
											?>
											Paused..
											 
											<?php
										} else if ($data['status'] == 4) {
											?>
											Started..
											<?php
										 
										} else {
											?>
											Pending...
											<?php
										} ?>
									</td>
									<td>
										<button <?=($data['status'] == 1)?'disabled':'' ?> onclick="start(<?php echo $data['id']; ?>)" id="start<?php echo $data['id']; ?>" class='btn btn-sm btn-primary'
												href=""><i class='fa fa-play'></i>
										</button>
									</td>
									<td>
										<button <?=($data['status'] == 1)?'disabled':'' ?>  onclick="stop(<?php echo $data['id']; ?>)" id="stop<?php echo $data['id']; ?>" class='btn btn-sm btn-primary'
												href=""><i class='fa fa-stop'></i>
										</button>
									</td>
									<td>
										<button <?=($data['status'] == 1)?'disabled':'' ?>  onclick="pause(<?php echo $data['id']; ?>)" id="pause<?php echo $data['id']; ?>" class='btn btn-sm btn-primary'
												href=""><i class='fa fa-pause'></i>
										</button>
									</td>
									<td>
										<button  onclick="deleteMark(<?php echo $data['id']; ?>)" class='btn  btn-sm btn-danger'
												id="delete<?php echo $data['id']; ?>"
												href=""><i class='fa fa-trash'></i>
										</button>
									</td>
									<td><a class='btn btn-sm btn-primary' href="detail.php?id=<?php echo $data['id']; ?>"><i class='fa fa-clipboard'></i></a></td>

									<?php
									?>
								</tr>
							<?php }
							if ($data['status'] == 1) {
							?>
								<script>
									$("#start" + <?php  echo $data['id'];?>).prop('disabled', true);
								</script>
							<?php
							} else if ($data['status'] == 2) {
							?>
								<script>
									$("#start" + <?php  echo $data['id'];?>).prop('disabled', true);
									$("#stop" + <?php  echo $data['id'];?>).prop('disabled', true);
									$("#pause" + <?php  echo $data['id'];?>).prop('disabled', true);
									$("#delete" + <?php  echo $data['id'];?>).prop('disabled', true);
								</script>
								<?php
							}
							}
							?>

						</table>

						</div>
					</div>
			 </div>
				
				 
				
				
		 
		</div>
		
 <div class="modal fade" id="add_campaign" tabindex="-1" role="dialog" aria-labelledby="add_campaign_modal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add New Campaign</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  <form action='campaign_create.php' method='post' enctype="multipart/form-data">
		  <div class="modal-body">
			 <div class='row' style='margin-bottom:20px'>
				<div class='col-sm-12'>
					<label class='label' for='Email'>Campaign Name</label>
					<input required="required" type="text"  class="form-control"  name="campaign_name"/>
				</div>
			 </div>
			 <div class='row' style='margin-bottom:20px'>
				<div class='col-sm-12'>
					<label class='label' for='sms_text'>SMS Message</label>
				  <textarea required="required" id="sms_text" class="form-control" name="sms_text"></textarea>
				</div>
			 </div>
			 <div class='row' style='margin-bottom:20px'>
				<div class='col-sm-12'>
				<label class='label' for='schedule_date'>Schedule Date</label>
					<input required="required" id="schedule_date" type="date" class="form-control" name="schedule_date"/>
				</div>
			 </div>
			 <div class='row' style='margin-bottom:20px' >
			 
				<div class='col-sm-12'>
				<label class='label' for='file'>Phone Number File</label>
					<input required="required" id="csv_file" type="file"  placeholder="csv_file" class="form-control" name="file"/>
				</div>
			 </div>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			<button type="submit" class="btn btn-primary">Add Campaign</button>
		  </div>
	  </form>
    </div>
  </div>
</div>
 
<?php
include('footer.php');
?>


<script type=text/javascript>

    function start(id) {
        $('#' + id).html('');
        $('#' + id).html('running..');
        $.ajax({
            type: "GET",
            data: {id: id},
            url: 'handler/start_handler.php',
            dataType: "html",
            async: false,
            beforeSend: function (jqXHR, options) {
                setTimeout(function () {
                    // null beforeSend to prevent recursive ajax call
                    $.ajax($.extend(options, {beforeSend: $.noop}));
                }, 4000);
                return false;
            },
            success: function (data) {
				 
                var d = JSON.parse(data);
				$.each(d, function(key,val) {
					 //console.log(val.phonenum);
					 //console.log(val.message);
					 sendSMS(val.phonenum, val.message, id);
				});
				
               /* sendSMS(d.phoneNumGroup, d.sms_text, id);*/
                $.ajax({
                    url: 'handler/start_status_update.php', //calling statusUpdate from CampaignController
                    type: "GET",
                    data: {campaign_id: id},
                    success: function (data) {

                        $('#' + id).html('');
                        $('#' + id).html('completed..');
                        $("#start" + id).prop('disabled', true);
                    }
                });

            }
        });
    }

    function sendSMS(phoneNumGroup, sms_text, campaign_id) {
        let uname = 'unifun';
        let pass = 'unifun';
        let host = 'localhost';//change ip to localhost
		let dlr='http://localhost/unifun_smssender/delivery_response.php?camp_id='+campaign_id+'&phone='+phoneNumGroup+'&resp=%d';
        //let url = "http://" + host + ":13013/cgi-bin/sendsms?username=" + uname + "&password=" + pass + "&from=100&to=" + phoneNumGroup + //"&text="+sms_text+"&dlr-mask=19&drl-url=http%3A%2F%2Flocalhost%2Funifun_smssender%2Fdelivery_response.php%3Fcamp_id%3D"+campaign_id+"%26phone%3D" + phoneNumGroup +"%26resp%3D%25d";
		
		let url = "http://" + host + ":13013/cgi-bin/sendsms?username=" + uname + "&password=" + pass + "&from=100&to=" + phoneNumGroup + "&text="+sms_text+"&dlr-mask=19&dlr-url="+encodeURIComponent(dlr);
		 
        $.ajax({
            url: 'handler/sms_handler.php',//calling smsResponse from CampaignController
            type: "GET",
            data: {url: url},
            datatype: 'html',
            async: false,
            success: function (data) {
				 
                $.ajax({
                    url: 'handler/sms_response_update.php',//calling responseUpdate from CampaignController
                    type: "GET",
                    data: {response: data, campaign_id: campaign_id},
                    datatype: 'html',
                    async: false,
                    success: function (data) {
                    }
                });
            }
        });
    }

    //
    function stop(id) {
        $('#' + id).html('');
        $('#' + id).html('stopping..');

        $.ajax({
            url: 'handler/stop_handler.php',//calling stopAction from CampaignController
            type: "GET",
            data: {campaign_id: id},
            datatype: 'json',
            success: function () {
                $('#' + id).html('');
                $('#' + id).html('stopped..');
                $("#start" + id).prop('disabled', true);
                $("#stop" + id).prop('disabled', true);
                $("#pause" + id).prop('disabled', true);
                $("#delete" + id).prop('disabled', true);
                window.location.reload();

            }
        });


    }

    function deleteMark(id) {
        $('#' + id).html('');
        $('#' + id).html('deleting..');
        $.ajax({
            url: 'handler/delete_handler.php',//calling deleteAction from CampaignController
            type: "GET",
            data: {campaign_id: id},
            datatype: 'json',
            success: function (data) {
				location.reload();
            }
        });
    }

    function pause(id) {
        $('#' + id).html('');
        $('#' + id).html('pausing..');
        $.ajax({
            url: 'handler/pause_handler.php',//calling pauseAction from CampaignController
            type: "GET",
            data: {campaign_id: id},
            datatype: 'json',
            success: function (data) {
                $('#' + id).html('');
                $('#' + id).html('paused..');
            }
        });

    }

    $('[data-toggle="popover"]').popover({
        placement: 'bottom',
        trigger: 'hover'
    });
</script>