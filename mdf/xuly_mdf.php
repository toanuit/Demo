<?php
 require('../admins/dbcon.inc');
/**
 * @author tran thanh toan vtth
 * @copyright 2012
 */

$dk = $_GET[dk];
if ($dk=="load_lightbox"){
    $id = $_GET[id];
    echo '<h2>Nhập MDF</h2>';
    $result = mysql_query("SELECT * FROM mdf WHERE id = '$id'");
    $row =  mysql_fetch_array($result);
    echo '<h3>Hộp '.$row[HOP].' vị trí '.$row[VITRI].'</h3>';
    if($row[SODT]== null or $row[SODT]==''){
        echo '
            <table cellspacing="0" width="500px">
                 <tr><td colspan="2">'.$id.'</td></tr>
                 <tr><td align="right">Số điện thoại</td><td align="left"><input class="sodt_input" placeholder="nhập vào số điện thoại"  id="sdt_input'.$row[id].'"></input></td></tr>
                 <tr><td align="right">Tên thuê bao</td><td align="left"><input class="ten_input" placeholder="nhập vào tên thuê bao"   id="ten_input'.$row[id].'"></input></td></tr>
                 <tr><td align="right">Tên Đơn vị</td><td align="left"><input class="tendv_input" placeholder="nhập vào tên đơn vị" id="tendv_input'.$row[id].'"></input></td></tr>
                 <tr><td colspan="2"></td></tr>
            </table>';

    }
    else{
         $rowdb =  mysql_fetch_array(mysql_query("SELECT * FROM danhba WHERE SODT = '$row[SODT]'"));
         echo '
            <table cellspacing="0" width="500px">
                 <tr><td colspan="2">'.$id.'</td></tr>
                 <tr><td align="right">Số điện thoại</td><td align="left"><input class="sodt_input" value ="'.$row[SODT].'" id="sdt_input'.$row[id].'"></input></td></tr>
                 <tr><td align="right">Tên thuê bao</td><td align="left"><input class="ten_input" value ="'.$rowdb[TENTB].'"   id="ten_input'.$row[id].'"></input></td></tr>
                 <tr><td align="right">Tên Đơn vị</td><td align="left"><input class="tendv_input" value ="'.$rowdb[TENDV].'" id="tendv_input'.$row[id].'"></input></td></tr>
                 <tr><td colspan="2"></td></tr>
            </table>';
    }
    echo '<p align="center
    "><button vitri="'.$id.'" class="xacnhan" >Xác nhận</button><button class="boqua">Bỏ qua</button></p></div>';
    mysql_free_result($result);
}
//--------------------------------------------------------->

if($dk=="up_mdf"){
    $sodt= $_GET["sodt"];
    $tentb=$_GET['tentb'];
    $tendv=$_GET['tendv'];
    $id = $_GET['id'];
    $result = mysql_query("SELECT * FROM danhba WHERE SODT='$sodt'");
    if (mysql_num_rows($result) == 0 and $sodt != ''){
        mysql_query("INSERT INTO danhba (SODT,TENTB,TENDV) VALUES ('$sodt','$tentb','$tendv')");
    }
    else {
      $row = mysql_fetch_array($result);
      if($row[TENTB] != $tentb)  mysql_query("UPDATE danhba SET TENTB='$tentb' WHERE SODT='$sodt'");
      if($row[TENDV] != $tendv)  mysql_query("UPDATE danhba SET TENDV='$tendv' WHERE SODT='$sodt'");
    }
    $check_mdf = mysql_query("SELECT id FROM mdf WHERE SODT='$sodt'");
    if(mysql_num_rows($check_mdf)==1){ // trong hop da co so -> xoa o vi tri chu
        $row_mdf = mysql_fetch_array($check_mdf);
        mysql_query("UPDATE mdf SET SODT='' WHERE SODT='$sodt'");
        echo $row_mdf[id];
        }
    else echo $sodt;
    mysql_query("UPDATE mdf SET SODT='$sodt' WHERE id='$id'");
    mysql_free_result($result);
}
//------------ check so dt------------------------------------->
if($dk=="check_sodt"){
    $sodt = $_GET[sodt];
    $sodt = trim($sodt);
    $result = mysql_query("SELECT SODT FROM mdf WHERE SODT='$sodt'");
    if(mysql_num_rows($result)==1){
        echo 'số này đã có nếu xác nhận thì vị trí cũ sẽ mất';
        }
    else echo 'số nầy chưa có bạ có thể nhập số này';
    mysql_free_result($result);
    }
//------------------------------------------------------------->
if($dk=="input_ten"){
    $sodt=$_GET['sodt'];
    $sodt = trim($sodt);
    $result = mysql_query("SELECT * FROM danhba WHERE SODT='$sodt'");
    if(mysql_num_rows($result)>=1){
        $row=mysql_fetch_array($result);
        echo $row[TENTB];
    }
    mysql_free_result($result);
}
if($dk=="input_tendv"){
    $sodt=$_GET[sodt];
    $sodt = trim($sodt);
    $result = mysql_query("SELECT * FROM danhba WHERE SODT='$sodt'");
    if(mysql_num_rows($result)>=1){
        $row=mysql_fetch_array($result);
        echo $row[TENDV];
    }
    mysql_free_result($result);
}
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
      $result=mysql_query("SELECT SODT FROM mdf WHERE SODT like '%$value%' LIMIT 0 , 10");
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
        //$query = $query." ORDER BY SODT ASC";
        $result = mysql_query($query);
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
                    <div class ='limit'><p></p><p>".$l."</p></div>
                ";
            $j =1;
            while ($row = mysql_fetch_array($result)){
            $row_tb = mysql_fetch_array(mysql_query("SELECT * FROM danhba WHERE SODT = '$row[SODT]'"));
            $id = $row[VITRI_ANALOG];
            echo "  <div class ='cot' vitri = '".$row[VITRI_ANALOG]."'>
                        <div class ='dong'>".$j."</div>
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
        $query = "SELECT * FROM mdf WHERE SODT like '%$value%'";
        if(mysql_num_rows(mysql_query($query))>0){
            echo '<h3>TÌM THEO SỐ ĐIỆN THOẠI</h3>';
            xuatbang($query,"xuat_sodt");
            };
        $query_dv="SELECT * FROM donvi WHERE TENDV like '%$value%'";
        if(mysql_num_rows(mysql_query($query_dv))>0){
            echo '<h3>TÌM THEO TÊN ĐƠN VỊ</h3>';
            xuatbang($query_dv,"xuat_sodt");
            };

}
?>
