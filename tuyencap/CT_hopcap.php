<?php
    require('../admins/dbcon.inc');
    $id_hopcap = $_GET[id_hopcap];
    $chi_tiet = array();
    $result = mysql_query("SELECT * FROM hopcap WHERE ID_HOPCAP = '$id_hopcap'");
    $row = mysql_fetch_array($result);
    //echo $row[ID_HOPCAP];
    $ct_hop_cap = mysql_query("SELECT * FROM  chi_tiet_hop_cap WHERE ID_HOPCAP = '$row[ID_HOPCAP]' ORDER BY VI_TRI ASC");
    while ($row_cthc = mysql_fetch_array($ct_hop_cap)) {
        $ct_sodt = mysql_query("SELECT * FROM danhba WHERE SODT = '$row_cthc[SO_DT]'");
        //echo $row_cthc[SO_DT];
        $row_sodt = mysql_fetch_array($ct_sodt);
        //$chi_tiet [$row_cthc[VI_TRI]][1] = $row_cthc[VI_TRI];
        $chi_tiet [$row_cthc[VI_TRI]][2] = $row_cthc[SO_DT];
        $chi_tiet [$row_cthc[VI_TRI]][3] = $row_sodt[TENTB];
        $chi_tiet [$row_cthc[VI_TRI]][4] = $row_sodt[TENDV];
        mysql_free_result($ct_sodt);
    }
    $k=0;
    // $i=1;
    $so_box=$row[SO_CARD];
    echo "<h1>".$row[TEN_HOP_CAP]."</h1>";
    echo $row[SO_CARD];
    $j=1;
    $box=1;$vitri=1;
    while ($box <= $so_box) {
    echo "<div class='bang'>";
        while ($j <= 10){
        echo "
            <div vitri = ".$vitri." class = 'cot'>
                <div class='dong' >".$j."</div>
                <div class='dong' id = 'so_dt".$vitri."'>".$chi_tiet[$vitri][2]."</div>
                <div class='dong'>".$chi_tiet[$vitri][3]."</div>
                <div class='dong'>".$chi_tiet[$vitri][4]."</div>
            </div>";
        $j+=1;
        $vitri+=1;
        }
        echo "</div>";
    $box+=1; $j=1;
    }
    echo "<button id = 'boqua'>Bỏ qua</button><p></P>";
    mysql_free_result($result);
?>
<body>
</html>