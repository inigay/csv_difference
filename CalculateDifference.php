<?php

const FILE1 = "file1.csv";
const FILE2 = "file2.csv";

try{

	if ( move_uploaded_file ( $_FILES["file1"]["tmp_name"] , 
	     "uploads/" . FILE2) && move_uploaded_file ( $_FILES["file2"]["tmp_name"] , 
	     "uploads/" . FILE2)){

	  	$handle1 = fopen("uploads/" . FILE1, "r");
		$handle2 = fopen("uploads/" . FILE2, "r");
	   if( $handle1 != false && $handle2 != false){


	   		//$h = new DiffChecker();
	   		//var_dump($h->checkSubscriber($str1, $str2));
	   		$batch = new CompareBatch($handle1, $handle2);
	   		$result = $batch->getDifference();

	   		if(empty($result)){
	   			echo "All entries are equal";
	   		}else{

	   			echo "Number of different entries: " . count($result) . "<br>";

	   			foreach($result as $item){
	   				echo $item . "<br>";
	   			}
	   		}

	   }else{
	   		throw new InvalidArgumentException("Could Not Process Uploaded Files. They might be corrupted");
	   }
	   		
		



	}else{
			throw new InvalidArgumentException("Could Not Upload Files, please try again. <br> 
				Please make sure both files are present.");
	}

}catch(InvalidArgumentException $e){
	echo $e->getMessage();
}


class CompareBatch{

	private $file1;
	private $file2;
	private $subscribers;
	private $channels;
	private $resultSet;

	public function __construct(&$resource1, &$resource2, $channels = null, $subscribers = null){
		$this->file1 = $resource1;
		$this->file2 = $resource2;
		$this->channels = $channels;
		$this->subscribers = $subscribers;
		$this->resultSet = array();
	}

	public function getDifference(){
		while($data1 = fgetcsv($this->file1,1024,",")){
			$data2 = fgetcsv($this->file2, 1024,",");

			if(!DiffChecker::compareChannels($data1[1], $data2[1]) || 
				!DiffChecker::compareSubscribers($data1[2], $data2[2])){
				array_push($this->resultSet, $data1[0]);
			}
		}

		return $this->resultSet;
	}
}

class DiffChecker
{
	public static function compareSubscribers($str1, $str2){
		//cast to integers
		$str1 = trim(str_replace(",", "", $str1), "\"");
		$str2 = trim(str_replace(",", "", $str2), "\"");
		$sub1 = (int)$str1;
		$sub2 = (int)$str2;

		return $sub1 == $sub2;
	}

	public static function compareChannels($str1, $str2){
		$str1 = str_replace("http://www.youtube.com/channel/", "", $str1);
		$str2 = str_replace("http://www.youtube.com/channel/", "", $str2);

		$len1 = strlen($str1);
		$len2 = strlen($str2);

		if(abs($len1 - $len2) > 2){
			//Strings even with UC are not equal because length difference is too much
			return false;
		}else{
			if($len1 >= $len2){
				//str1 is bigger or they are equal either way we can look for occurance
				return strpos($str1, $str2) !== false ? true : false;
			}

			//str2 is bigger and might have UC in front of it
			return strpos($str2, $str1) !== false ? true : false;
		}

		
	}
}

?>