<?php
require_once '../controller.php';
sleep(5);
$campaignController = new CampaignController();
$result = $campaignController->startAction();
echo $result;
?>