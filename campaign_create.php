<?php
//for campaign create-->
session_start();
if (!isset($_SESSION['sess_user_id'])) {
    header('location:index.php');
}
include('config.php');
 
if (!empty($_POST)) {
	
	 
    include 'config.php';
    $cname = $_POST['campaign_name'];
    $sms = $_POST['sms_text'];
    $date = $_POST['schedule_date'];
    $phone = $_POST['file'];
    $created_date = date('y-m-d h:i');

	$error='';
	$mode='';
		
		if ($_FILES["file"]["error"] > 0) {
        $error.= "Return Code: " . $_FILES["file"]["error"] . "<br />";
		$mode='error';
		} else {
			$target_dir = "file/";
			$target_file = $target_dir . basename($_FILES["file"]["name"]);
			$pathinfo = pathinfo($target_file);
            $todays_date = date("mdYHis");
            $new_filename = $pathinfo['dirname'].DIRECTORY_SEPARATOR.$todays_date.'_'.$pathinfo['basename'];
            rename($target_file, $new_filename);
            move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
			//move_uploaded_file($_FILES["file"]["tmp_name"], "file/" . $_FILES["file"]["name"]);

			$query = "insert into campaigns (campaign_name,sms_text,schedule_date,status,is_delete,response,created_at) values('$cname','$sms','$date',0,0,'','$created_date')";


			
			if(mysqli_query($connect, $query))
			{
				$campaignId=mysqli_insert_id($connect);
				 
				//    if ($_POST["file"]["size"] > 0) {
				$file = fopen($new_filename, "r");
			 
				$nos= fgetcsv($file);
				 
				foreach($nos as $n)
				{
					
					//It wiil insert a row to our subject table from our csv file`
					$sql = "INSERT into numbers (number,campaign_id) values($n,$campaignId)";
					//we are using mysqli_query function. it returns a resource on true else False on error
					$result = mysqli_query($connect, $sql);
				}
				 
				fclose($file);
				//throws a message if data successfully imported to mysql database from excel file
				$error.='New Campaign Added';
				$mode='success';
			}
			else{
				$error.= 'Mysql Error Check Connection';
				$mode='error';

			}
					
				//echo "Stored in: " . "file/" . $_FILES["file"]["name"]; //<- This is it
			 
		}
		 
		
		
		$_SESSION['msg']=$error;
		$_SESSION['mode']=$mode;
		
		$_SESSION['show']='1';
		
		header("location:dashboard.php");
	 

}
else{
	echo 'ERROR !!!!!!!!!!!!!!!!!!!!';
	
	
	
}
 