<?php

class CampaignController
{
    function __construct()
    {
    }

    //    for start button
    function startAction()
    {
        include 'config.php';
        $campaign_id = $_GET['id'];

        //phone_number form numbers table
        $phone_numbers = mysqli_query($connect,
            "select number,sms_text
                      from campaigns c inner join numbers n
                        on c.id=n.campaign_id
                          where campaign_id='$campaign_id'");

        $phoneGroupNum = 0;
		 
		$dataArr=array();
		$i=0;
        while ($data = mysqli_fetch_array($phone_numbers,true)) {
          
			$dataArr[$i]['phonenum']=$data['number'];
			$dataArr[$i]['message']=urlencode($data['sms_text']);
			
			$i++;
        }

        
        return json_encode($dataArr);
    }

    //get response from server
    public function smsResponse()
    {
        $url = $_GET['url'];
        $file = file_get_contents($url);
        return $file;
    }

    //after clicking start button update status==1 :(1 means start)
    public function startStatusUpdate()
    {
        include 'config.php';
        $campaign_id = $_GET['campaign_id'];
        mysqli_query($connect, "update campaigns set status=1 where id=$campaign_id");
        return "status is sending";

    }

    //after getting response form server update response message
    public function responseUpdate()
    {
        include 'config.php';
        $campaign_id = $_GET['campaign_id'];
        $response = $_GET['response'];
        mysqli_query($connect, "update campaigns set response='$response' where id=$campaign_id");
        return "response is sending";
    }

    //status ==2 means stop
    public function stopAction()
    {
        include 'config.php';
        $campaign_id = $_GET['campaign_id'];
        mysqli_query($connect, "update campaigns set status=2 where id=$campaign_id");
        return "status is stopping";

    }

    //    is_delete==1 means not to display in index page but data will be in database
    public function deleteAction()
    {
        include 'config.php';
        $campaign_id = $_GET['campaign_id'];
        mysqli_query($connect, "update campaigns set is_delete=1 where id=$campaign_id");
        return "status is deleting";

    }

    //    status==3 means pause
    public function pauseAction()
    {
        include 'config.php';
        $campaign_id = $_GET['campaign_id'];
        mysqli_query($connect, "update campaigns set status=3 where id=$campaign_id");
        return "status is deleting";
    }

}

?>