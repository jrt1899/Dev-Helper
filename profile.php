<?php
session_start();

echo "<html><head></head><body>";
$username = $_SESSION['username'];
echo "<center>$username</center><br><br>";

$manager = new MongoDB\Driver\manager("mongodb://localhost:27017");

$filter = [
	'username' => $username
];

$query = new MongoDB\Driver\Query($filter);
$codes = "";
try{
	$rows = $manager->executeQuery("dev_helper.user",$query);
	foreach($rows as $row){
		$codes = $row->codes;
	}
	if(empty($codes)){
		echo "NO CODES AVAILABLE";
	}
	else{
		echo "<center><table>";
		echo "<tr><th>CODENAME</th><th>LANGUAGE</th><th>EDIT|DELETE</th></tr>";
		foreach($codes as $code){
			echo "<tr>
				<td>$code->codename</td>
				<td>$code->language</td>
				<td><a href='edit.php?codename=$code->codename&language=$code->language'>EDIT</a> | 
				<a href='delete.php?codename=$code->codename&language=$code->language'>DELETE</a></td>
			</tr>";
		}
		echo "</table></center>";
	}

}catch(MongoDB\Driver\Exception\Exception $e){
	die("error : ".$e);
}
?>