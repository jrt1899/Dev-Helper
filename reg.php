<?php

$bulk = new MongoDB\Driver\Bulkwrite;

$username = $_POST['username'];
$email = $_POST['email'];
$pass = $_POST['pass'];
$code = "";

$dir = "users";
$dir = $dir."/".$username;

if(  is_dir($dir)===true ){
	echo "<script>alert('USER WITH THIS USERNAME ALREADY EXIST');location.href='editor.php';</script>";
}
else{
	mkdir($dir);
	$user = [
		'username' => $username,
		'email' => $email,
		'password' => $pass,
		'codes' => $code
	];

	try{
		$bulk->insert($user);
		$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
		$result = $manager->executeBulkWrite('dev_helper.user',$bulk);
		session_start();
		$_SESSION['username'] = $username;

		echo "<script>alert('User Added!');location.href='home.php'</script>";
	}catch(MongoDB\Driver\Exception\Exception $e){
		die("Error Encountered :".$e);
	}
}
?>
