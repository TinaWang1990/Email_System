<?php 
class send{
	// function __construct(){
	// 	echo "send obj is created";
	// }

	/*
	*Request:
	*Method:POST
	*URL:SEND
	*Data:
	*{
	*	"id":"3",
	*	"rcpt":"info@gmail.com"
	*}
	*will return:
	*/
	
	public function indexMethod(){
		$tid=$_POST['id'];
		$recipient=$_POST['rcpt'];
		$conn=new DBConnection();
		$result=$conn->getTemplateById($tid);

		try {
			$mandrill=new Mandrill('aSznWSiyxJ8Kv-JemSNvgQ');
			$message=array(
				'html'=>$result['content'],
				'subject'=>$result['name'],
				'from_email'=>'postman@sunnyfuture.ca',
				'from_name'=>'Tina',
				'to'=>array(
					array(
						'email'=>$recipient,
						'type'=>'to'
					),
				),
				'headers'=>array(
					'Reply-To'=>'shihuiwang1990@gmail.com'
				),
				'important'=>true,
				'track_opens'=>true,
				'track_clicks'=>true
			);
			$async=false;
			$ip_pool='Main Pool';
			$result=$mandrill->messages->send($message,$async,$ip_pool);
			return json_encode(array(
				'code'=>200,
				'message'=>'success'
			));
		}catch(Mandrill_Error $e){
			return json_encode(array(
				'code'=>400,
				'message'=>'failed'
			));
		}
}
}



 ?>