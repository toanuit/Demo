<?php
/**
 * @author toan112
 * @copyright 2012
 */
    require('dbcon.inc');
    $dk=$_GET[dk];
    $dk1=$_POST[dk];
//------------- kiem tra thue bao khi nhap ---------------------------------->
    if($dk=='check_sodt'){
        $sodt=$_GET[sodt];
        $sodt = trim($sodt);
        $query = "SELECT * FROM thuebao WHERE SODT='$sodt'";
        $check_tb = mysql_query($query);
        if(mysql_num_rows($check_tb)>=1) echo '<div alert = "đã có" class ="alert">số thuê bao đã có nếu đồng ý vị trí cũ sẽ mất</div>';
        else echo '<div alert = "không có" class ="alert">số thuê bao có thể sử dụng</div>';
        mysql_free_result($check_tb);
    }
//----------------- result tentb khi nhap so dt------------------------>
    if($dk=='result_tentb'){
        $sodt=$_GET[sodt];
        $check_db = mysql_query("SELECT TENTB FROM danhba WHERE SODT='$sodt'");
        if(mysql_num_rows($check_db)==1){
            $row_db=mysql_fetch_array($check_db);
            echo $row_db[TENTB];
            }
        mysql_free_result($check_db);
    }
//----------------- result tendv khi nhap so dt------------------------>
    if($dk=='result_tendv'){
        $sodt=$_GET[sodt];
        $check_db = mysql_query("SELECT TENDV FROM danhba WHERE SODT='$sodt'");
        if(mysql_num_rows($check_db)==1){
            $row_db=mysql_fetch_array($check_db);
            echo $row_db[TENDV];
            }
        mysql_free_result($check_db);
    }
//----------------- result shell khi nhap shell------------------------>
    if($dk=='result_shell'){
        $shell=$_GET[shell];
        $check_tb = mysql_query("SELECT SHELL FROM thuebao WHERE SHELL='$shell'");
        if(mysql_num_rows($check_tb)==1){
            $row_tb=mysql_fetch_array($check_tb);
            echo 'shell đã có đề nghị xem lại';
            }
        else echo 'có thể nhập';
        mysql_free_result($check_tb);
    }
//-------------update danhba----------------------->
    if($dk=='update_tb'){
        $id=$_GET[id];
        $shell=$_GET[shell];
        $sodt=$_GET[sodt];
        $tentb=$_GET[tentb];
        $tendv=$_GET[tendv];
        $check_tb = mysql_query("SELECT * FROM thuebao WHERE VITRI_ANALOG = $id");
             $row_tb=mysql_fetch_array($check_tb);
             if($sodt != '' and $sodt != null){
                $check_db = mysql_query("SELECT * FROM danhba WHERE SODT='$sodt'");
                $row_db=mysql_fetch_array($check_db);
                if(mysql_num_rows($check_db)==0)
                 {
                    mysql_query("INSERT INTO danhba (SODT,TENTB,TENDV) VALUES ('$sodt','$tentb','$tendv')");
                    }
                else{
                    if($row_db[SODT] != $sodt or $row_db[TENTB] != $tentb or $row_db[TENDV] != $tendv)
                    {
                         mysql_query("UPDATE danhba SET TENTB = '$tentb' , TENDV = '$tendv', SODT = '$sodt' WHERE SODT = '$sodt'");
                    }
                }
                mysql_free_result($check_db);
             }
        $check_dv = mysql_query("SELECT TENDV FROM donvi WHERE TENDV='$tendv'");
            if(mysql_num_rows($check_dv)==0){ //kiem tra donvi da ton tai hay chua, neu da ton tai-> cap nhat lai
                mysql_query("INSERT INTO donvi (TENDV) VALUES ('$tendv')");
                };
        $check_tb_number = mysql_query("SELECT * FROM thuebao WHERE SODT='$sodt'");
        if(mysql_num_rows($check_tb_number)>=1){ //kiem tra so dien thoai da ton tai hay chua, neu da ton tai-> cap nhat lai
            mysql_query("UPDATE thuebao SET SODT = '', TENDV = '' WHERE SODT = '$sodt'");
            $row_old_number = mysql_fetch_array($check_tb_number);
            echo $row_old_number[VITRI_ANALOG];
            }
            else echo $sodt;
        mysql_query("UPDATE thuebao SET SHELL='$shell', SODT='$sodt', TENDV='$tendv' WHERE VITRI_ANALOG = $id");
        mysql_free_result($check_dv);
        mysql_free_result($check_tb);
        mysql_free_result($check_tb_number);
        };

//-----------------END----------------->
// -------------- SEACH------------------------->
if ($dk=='seach'){
	function get_tokens($content) {
		$token = strtok($content, " \n\t\r");
		$numtoken = 0;
		while ($token != false) {
			$tokenlist[$numtoken] = $token;
			$numtoken++;
			$token = strtok(" \n\t\r");
		}
		return $tokenlist;
	}
    $value=$_GET[value];
	$value = trim($value);
	$tokens = get_tokens($value);
	for($i = 0; $i < count($tokens); $i++)
		{
			$token = $tokens[$i];
			$result_dv=mysql_query("SELECT TENDV FROM donvi WHERE TENDV like '%$value%' LIMIT 0 , 10");
			$result=mysql_query("SELECT SODT FROM thuebao WHERE SODT like '%$value%' LIMIT 0 , 10");
			//$query = $query . "tensp like '%$token%' and hienthi=0 and ";
		}
    //$result=mysql_query("SELECT SODT FROM thuebao WHERE SODT like '%$value%' LIMIT 0 , 10");
    $numrow = 1;
    if(mysql_num_rows($result)>0){echo '<li id="text">TÌM THEO SỐ ĐIỆN THOẠI</li>';};
    while($row=mysql_fetch_array($result)){
        echo '<li id="result">'.$row[SODT].'</;i>';
        $numrow +=1;
    }
    //$result_dv=mysql_query("SELECT TENDV FROM donvi WHERE TENDV like '%$value%' LIMIT 0 , 10");
    if(mysql_num_rows($result_dv)>0){echo '<div id="text">TÌM THEO TÊN DV</div>';};
    while($row=mysql_fetch_array($result_dv)){
        echo '<li id="result">'.$row[TENDV].'</li>';
        $numrow +=1;
    }
    if ($numrow>9){ echo '<li id="show_all"><img height="30px" src="../images/Export to CSV & Excel.png" /></li>';}
    mysql_free_result($result);
    mysql_free_result($result_dv);
}

if ($dk=='seach_all'){
    $value=$_GET[value];
    $result=mysql_query("SELECT * FROM thuebao WHERE SODT like '%$value%'");
    if(mysql_num_rows($result)>0){echo '<li id="text">TÌM THEO SỐ ĐIỆN THOẠI</li>';};
    while($row=mysql_fetch_array($result)){
        echo '<li id="result">'.$row[SODT].'</li>';
    }
    $result_dv=mysql_query("SELECT TENDV FROM donvi WHERE TENDV like '%$value%'");
    if(mysql_num_rows($result_dv)>0){echo '<li id="text">TÌM THEO TÊN DV</li>';};
    while($row=mysql_fetch_array($result_dv)){
        echo '<li id="result">'.$row[TENDV].'</li>';
        $numrow +=1;
    }
   mysql_free_result($result);
}
if ($dk=='seach_result'){
    $value=$_GET[value];
    function xuatbang($query,$tacvu){
        $query = $query." ORDER BY VITRI_ANALOG ASC";
        $result = mysql_query($query) or die(mysql_error);
        $sotb = mysql_num_rows($result);
        if ($sotb%8 != 0) {
            $sodu = $sotb%8;
            $sodu = 8-$sodu;
            $sotb += $sodu;
        }
        $limit = 0;
        $l=1;
        mysql_free_result($result);
        while ($limit < $sotb) {
            $addquery = $query." LIMIT $limit , 8";
            $result = mysql_query($addquery);
            echo "<div class='bang'>
                    <div class ='limit'><p></p><p></p></div>
                ";
            $j =1;
            while ($row = mysql_fetch_array($result)){
            $row_tb = mysql_fetch_array( mysql_query("SELECT * FROM danhba WHERE SODT = '$row[SODT]'"));
            $id = $row[VITRI_ANALOG];
            $card = ($id/8)+1;
            $vitri = $id%8;
            if ($id%8==0){
                $vitri = 8;
                $card -=1;
            }
            $card = strtok($card,".");
            echo "  <div class ='cot' vitri = '".$row[VITRI_ANALOG]."'>
                        <div class ='dong'>".$card."/".$vitri."</div>
                        <div id = 'shell".$id."' class ='dong'>".$row[SHELL]."</div>
                        <div id = 'sodt".$id."' class ='dong'>".$row[SODT]."</div>
                        <div id = 'tentb".$id."' class ='dong'>".$row_tb[TENTB]."</div>
                        <div id = 'tendv".$id."' class ='dong'>".$row_tb[TENDV]."</div>
                    </div>
            ";
            $j+=1;
            }
            $limit +=8;
            if ($limit == $sotb){
                $k=1;
                while ($k<=$sodu) {
                    echo "  <div class ='cot''>
                        <div class ='dong'></div>
                        <div class ='dong'></div>
                        <div class ='dong'></div>
                        <div class ='dong'></div>
                        <div class ='dong'></div>
                    </div>
                    ";
                    $k+=1;
                }
            }
            echo "</div>";
            $l+=1;
            mysql_free_result($result);
        }
    }
        $query = "SELECT * FROM thuebao WHERE SODT like '%$value%'";
        if(mysql_num_rows(mysql_query($query))>0){
            echo '<h3>TÌM THEO SỐ ĐIỆN THOẠI</h3>';
            xuatbang($query,"xuat_sodt");
            };
        $query_dv="SELECT * FROM thuebao WHERE TENDV like '%$value%'";
        if(mysql_num_rows(mysql_query($query_dv))>0){
            echo '<h3>TÌM THEO TÊN ĐƠN VỊ</h3>';
            xuatbang($query_dv,"xuat_sodt");
            };

}

?>