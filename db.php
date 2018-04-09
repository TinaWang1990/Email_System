<?php 
class DBConnection {
	protected $connection;

	public function getConnInstant(){
		if(!isset($this->connection)){
			$this->connection=new PDO('mysql:host=localhost;dbname=email;charset=utf8mb4', 'root', 'root');
		}
		return $this->connection;
	}

	public function addTemplate($content,$name,$vars){
		//TODO: Add Check-

		//Add to database
		$stmt=$this->getConnInstant()->prepare("INSERT INTO templates (tcontent,tname,tvar) VALUES (:content,:name,:vars)");
		$result=$stmt->execute(
			array(
				':content'=>$content,
				':name'=>$name,
				':vars'=>$vars
			)
		);

		return $result;
	}

	public function getAllTemplates(){
		$stmt=$this->getConnInstant()->query('SELECT * FROM templates');
		$templates=$stmt->fetchAll(PDO::FETCH_ASSOC);
		//TODO: array to object model

		$result=array();
		foreach ($templates as  $template) {
			$temp=array(
				'content'=>$template['tcontent'],
				'name'=>$template['tname'],
				'vars'=>$template['tvar'],
				'id'=>$template['tid']
			);
			$result[]=$temp;
		}
		return $result; 
	}


	public function getTemplateById($id){
	$stmt=$this->getConnInstant()->prepare("SELECT * FROM templates where tid=:id");
	$stmt->execute(
		array(
			':id'=>$id
		)
	);
	$template=$stmt->fetch();
	$result=array(
		'content'=>$template['tcontent'],
		'name'=>$template['tname'],
		'vars'=>$template['tvar'],
		'id'=>$template['tid']
	);
	return $result;
}

}
// $db=new DBConnection();
// var_dump($db->getTemplateById(1));





 ?>