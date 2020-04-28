<?php
require_once '../controller.php';

$campaignController = new CampaignController();
$result = $campaignController->stopAction();
echo $result;
?>