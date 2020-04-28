<?php
require_once '../controller.php';

$campaignController = new CampaignController();
$result = $campaignController->smsResponse();
echo $result;
?>