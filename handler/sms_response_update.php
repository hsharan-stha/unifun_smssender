<?php
require_once '../controller.php';

$campaignController = new CampaignController();
$result = $campaignController->responseUpdate();
echo $result;
?>