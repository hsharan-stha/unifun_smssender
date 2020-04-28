<?php


include('config.php');

if(!empty($_GET)){
    include 'config.php';
    $cId = $_GET['camp_id'];
    $phone = $_GET['phone'];
    $resp = $_GET['resp'];   
    $date = date('y-m-d h:i:s');
	$query = "insert into delivery (campaign_id,phone,response,delivery_date) values('$cId','$phone','$resp','$date')";
	 
	mysqli_query($connect, $query);
}
else{
	
	echo 'Error!!!!!!!!!!!!!!!!!!';
}