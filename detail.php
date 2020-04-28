<?php

session_start();
if (!isset($_SESSION['sess_user_id'])) {
    header('location:index.php');
}
include('config.php');
include('header.php');
 
?>

 <div class="main-wrapper content-body-mod" >
	<div class='container'>
		<div class="row justify-content-center" style='margin-bottom:20px'
		>
			<div class="col-sm-12">
				<div class="section-title">
				
				<?php
				$campainname='';
				if(!empty($_GET)){
					$query  = "SELECT * FROM  campaigns    WHERE id=" . $_GET['id'];
					$result = mysqli_query($connect, $query);
					$data = mysqli_fetch_assoc($result);
					 
					$campainname=$data['campaign_name'];
					
				}
				?>
					<h3>Delivery Report<?= ($campainname!='')?" For ".$campainname:'' ?></h3>

				</div>
			</div>
		</div>
 
		<div class="row " style='margin-bottom:20px'>
			<div class="col-sm-4">
				<div class="section-title">
					 <form action='' method='get'>
						
						<select class='form-control' name='id' onchange='this.form.submit()'>
							<?php
									$query  = "SELECT * FROM  campaigns WHERE is_delete=0" ;
									
									$result = mysqli_query($connect, $query);
									
								
									 
									while($data = mysqli_fetch_array($result)){
										?>
										<option value='<?=$data['id']?>'><?=$data['campaign_name']?></option>
										<?php
										
									}
								
							?>
						</select>
					 </form>
				</div>
			</div>
		</div>
		
		
		<div class="row justify-content-center" style='margin-bottom:20px;height:460px;overflow-x:auto' >
			<div class="col-sm-12">
				<div class="section-title">
				<?php
				
				if(!empty($_GET)){
					?>
					<table class='table table-bordered table-striped' border="1">
						<thead>
							<tr>
								<th>Phone</th>
								<th>SMS Text</th>
								<th>Response</th>
								<th>Delivery Date</th>
							</tr>
						</thead>
						<?php
						//            $query = "select * from campaigns c inner join numbers n on c.id=n.campaign_id where c.id=" . $_GET['id'];
						$queryForNumber = "SELECT c.`id`,c.`campaign_name`,c.`sms_text`,d.`phone`,d.`response`,d.`delivery_date` FROM delivery d JOIN campaigns c ON c.`id`=d.`campaign_id` WHERE campaign_id=" . $_GET['id'];
						 
						
						$result = mysqli_query($connect, $queryForNumber);
						 
						while ($data = mysqli_fetch_array($result)) {
							 
							?>
							<tr>
								<td><?php echo $data['phone']; ?></td>
								<td><?php echo $data['sms_text']; ?></td>
								<td><?php echo $data['response']; ?></td>
								<td><?php echo $data['delivery_date']; ?></td>
							</tr>
						<?php } ?>
					</table>
					<?php
				}
					?>
				
					 

				</div>
			</div>
		</div>
	</div>
</div>
<script>
 
</script>
<?php
include('footer.php');
?>