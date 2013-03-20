<?php

/**
 * @author toan112
 * @copyright 2012
 *
 */

$SERVER = "localhost";
		$USERNAME = "root";
		$PASSWORD = "";
		$DBNAME = "tong_dai";
		$db=mysql_connect($SERVER, $USERNAME, $PASSWORD);
		mysql_select_db("tong_dai");
    $i=1;
    $j=1;
    while($i<=100){
        mysql_query("INSERT INTO mdf (VITRI,HOP) VALUES ($i,$j)");
        $i=$i+1;
        if($i==101){
            $j=$j+1;
            $i=1;
            }
        if($j==4) break;
    }


?>
<script>
    function wait(){
        write("XIN CHO");
    }
</script>
<body onload="wait()"></body>