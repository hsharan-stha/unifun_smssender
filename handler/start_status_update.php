<?php
require_once '../controller.php';

$campaignController = new CampaignController();
$result = $campaignController->startStatusUpdate();
echo $result;
?>