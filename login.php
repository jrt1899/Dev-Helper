<?php
try{
	$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
	$query = new MongoDB\Driver\Query([]);

	$rows = $manager->executeQuery("dev_helper.user",$query);
	$username = $_POST["username"];
	$password = $_POST["pass"];
	foreach($rows as $row){
		if($row->username==$username){
			if($row->password==$password){
				session_start();
				$_SESSION["username"] = $username;
				echo "<script>location.href='home.php';</script>";
			}
			else{
				echo "<script>alert('wrong password or username here1');location.href='editor.php';</script>";	
			}
		}
	}
	echo "<script>alert('wrong password or username here2');location.href='editor.php';</script>";	
}catch(MongoDB\Driver\Exception\Exception $e){
	die("error : ".$e);
}
?>