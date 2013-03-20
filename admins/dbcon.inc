<?php
$SERVER = "";
		$USERNAME = "root";
		$PASSWORD = "";
		$DBNAME = "tong_dai";
		$db=mysql_connect($SERVER, $USERNAME, $PASSWORD);
		mysql_select_db($DBNAME);
		if (mysqli_connect_errno()) {
			echo "<p> khong the ket noi".mysql_connect_errno()."</p>";
		}
?>