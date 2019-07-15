

<?php

	$languageID = $_POST['language'];
        error_reporting(0);
	$code = $_POST["code"];

	if($_FILES["file"]["name"]!="")
	{
		include "compilers/make.php";
	}
	else
	{
		switch($languageID)
			{
				case "C":
				{
					include("compilers/c.php");
					break;
				}
				case "c_cpp":
				{
					include("compilers/cpp.php");
					break;
				}

				case "cpp11":
				{
					include("compilers/cpp11.php");
					break;
				}
				case "java":
				{	
					include("compilers/java.php");
					break;
				}
				case "python2.7":
				{
					include("compilers/python27.php");
					break;
				}
				case "python":
				{
					include("compilers/python32.php");
					break;
				}
			}
	}
?>


