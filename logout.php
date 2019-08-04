<?php
	session_start();
	session_destroy();
	echo "<script>alert('LOGGED OUT');location.href='editor.php'</script>"
?>