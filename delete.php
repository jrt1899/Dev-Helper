<?php
session_start();
$username = $_SESSION['username'];
$code_name = $_GET['codename'];
$language = $_GET['language'];
$ex = "";
if($language=="C")	$ex = ".c";
if($language=="c_cpp")	$ex = ".cpp";
if($language=="python")	$ex = ".py";
if($language=="java")	$ex = ".java";
$path = "c:\\xampp\htdocs\Dev-Helper\users\\".$username."\\".$code_name.$ex;
exec("del $path");

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
	$key=0;
	$n_code="";
	foreach($codes as $qq){
		if($qq->codename==$code_name and $qq->language==$language){
			continue;
		}
		else{
			$code = (object)(array('codename'=>$qq->codename,'language'=>$qq->language));
			if($key == 0){
				$n_code = array($code);
			}
			else{
				$n_code = (object)array_merge((array)$n_code,array($code));
			}
		}
		$key=$key+1;
	}
	$n_code = (object)($n_code);
	if(empty($n_code))	(object)$n_code = "";
	$bulk->update(['username'=>$username],['$set'=>['codes'=>$n_code]]);
	$result = $manager->executeBulkWrite('dev_helper.user',$bulk);
	echo "<script>location.href='profile.php';</script>";
}catch(MongoDB\Driver\Exception\Exception $e){
	die("Error : ".$e);
}

?>