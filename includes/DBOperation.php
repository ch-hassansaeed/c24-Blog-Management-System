<?php

/**
* 
*/

include_once(DOMAIN_BASE_PATH."/database/db.php");

class DBOperation
{
	
	private $con;

	function __construct()
	{
		$db = new Database();
		$this->con = $db->connect();
	}

	

	//add post data into db
	public function addPost($title,$content,$photo,$author){
		$pre_stmt = $this->con->prepare("INSERT INTO `posts`
			(`title`, `content`, `photo`,
			 `author`)
			 VALUES (?,?,?,?)");
		$status = 1;
		$pre_stmt->bind_param("ssss",$title,$content,$photo,$author);
		$result = $pre_stmt->execute() or die($this->con->error);
		if ($result) {
			return "POST_ADDED";
		}else{
			return 0;
		}

	}

	//get any table data form db by Table Name
	public function getAllRecord($table){
		$pre_stmt = $this->con->prepare("SELECT * FROM ".$table);
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
		$rows = array();
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()){
				$rows[] = $row;
			}
			return $rows;
		}
		return "NO_DATA";
	}
	
}	
?>