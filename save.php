<?php
session_start();
$username = $_SESSION['username'];
$code_ = $_POST['code'];
$language = $_POST['language'];
$code_name = $_POST['code_name'];

$bulk = new MongoDB\Driver\BulkWrite;
$manager = new MongoDB\Driver\manager("mongodb://localhost:27017");

$filter = [
		'username' => $username,
	];

$query = new MongoDB\Driver\Query($filter);

try{
	$rows = $manager->executeQuery("dev_helper.user",$query);
	foreach($rows as $row){
		$codes = $row->codes;
	}
	$flag = 0;
	$code = (object)(array('codename'=>$code_name,'language'=>$language));
	if($codes == ""){
		$codes = array($code);
	}
	else{
		foreach($codes as $qq){
			//echo "$qq->codename,$qq->language";
			if($qq->codename==$code_name and $qq->language==$language){
				$flag = 1;
			}
		}
		if($flag==0)	$codes = (object)array_merge((array)$codes,array($code));
	}

	$path = "users/".$username."/";
	if($language == "C")	$filename = $path.$code_name.".c";
	if($language == "c_cpp")	$filename = $path.$code_name.".cpp";
	if($language == "java")	$filename = $path.$code_name.".java";
	if($language == "python")	$filename = $path.$code_name.".py";


	if($flag == 0){
		$bulk->update(['username'=>$username],['$set'=>['codes'=>$codes]]);
		$result = $manager->executeBulkWrite('dev_helper.user',$bulk);

		// save code into file
		$file_code = fopen($filename,"w+");
		fwrite($file_code,$code_);
		fclose($file_code);
		echo "<script>alert('Code Saved!');location.href='edit.php?codename=$code_name&language=$language'</script>";
	}
	else{
		echo "<script>var uu = confirm('code_name already exists..!<br>You still want to continue?');
			if(uu = true){";
				$file_code = fopen($filename,"w+");
				fwrite($file_code,$code_);
				fclose($file_code);
				echo "location.href='edit.php?codename=$code_name&language=$language';
			}
			else{
				location.href='home.php';
			}
		</script>";
	}

}catch(MongoDB\Driver\Exception\Exception $e){
	die("error : ".$e);
}

?>