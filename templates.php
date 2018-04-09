<?php 
class templates {
	// function __construct(){
	// 	echo "list obj is created";
	// }

	// public function addMethod(){
	// 	echo'using add method';
	// }

	
	// *@Method otherMethod
	// *@input int id input id to delete
	// *@Output boolen if true delete

	
	// public function deleteMethod($id){
	// 	echo'using delete method'.$id;
	// }
	// public function indexMethod(){
	// 	echo'using default method';
	// }

	public function indexMethod(){
		return 'template index action is working';
	}
	/*
	*method: post
	*url: templates/save
	*request body formate
	*req-post:
	*
	*{
	*"content":"<h1>html content </h1>",
	*"name":    "template 1",
	*"var":     "var1,var2"
	*}
	*
	*will  return format;
	*json:
	*{
	*"code":200,
	*"message":"success"
	*}
	*/
	public function saveMethod(){
		$content=$_POST['content'];
		$name=$_POST['name'];
		$var=$_POST['var'];

		$conn= new DBConnection();
		$result=$conn->addTemplate($content,$name,$var);
		if($result){
			return json_encode(array(
				"code"=>200,
				"message"=>"Template add successfully"
			));
		}else{
			return json_encode(array(
				"code"=>500,
				"message"=>"Template add failed"
			));
		}
	}
	/*
	*request body formate
	*Method :GET
	*URL: templates/get
	*will return:
	*json:
	*{
	*  {
	*	"id":1,
	*	'content': 'hello',
	*	"name":    "template 1",
	*	"var":     "var1,var2"	
	*	}
	*  {
	*	"id":2,
	*	'content': 'hello2',
	*	"name":    "template 2",
	*	"var":     "var1,var2"	
	*	}

	*}
	*/
	public function getMethod(){
		$conn= new DBConnection();
		$results=$conn->getAllTemplates();

		if ($results){
			return json_encode($results);
		}else{
			return json_encode(array(
				'code'=>400,
				'message'=>'No Template exists'
			));
		}
	} 
	
}



 ?>