<?php

/**
 * @author toan112
 * @copyright 2012
 */
$SERVER = "localhost";
		$USERNAME = "root";
		$PASSWORD = "";
		$DBNAME = "tong_dai";	
		$db=mysql_connect($SERVER, $USERNAME, $PASSWORD);
		mysql_select_db("tong_dai"); 

$i=1;
while ($i<400)
{
    $result = mysql_query ("INSERT INTO THUEBAO (`VITRI_ANALOG`) VALUES ($i)"); 
    $i=$i+1;
};
 echo($i);
?>