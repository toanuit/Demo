<?php
 require('../admins/dbcon.inc');
/**
 * @author tran thanh toan vtth
 * @copyright 2012
 */
$dk = $_GET[dk];
/*if($dk=="them"){
    require('themmoi.php');
  } // ket thuc hien thi khi click vao them moi o menu trai */
if ($dk=="them_hc"){
    $ten_hc = $_GET[ten_hc];
    $dia_chi = $_GET[dia_chi];
    $so_card = $_GET[so_card];
    // kiem tra ten hop cap co trung hay khong
    //$check_ten_hc = mysql_query("SELECT TEN_HOP_CAP FROM hopcap WHERE TEN_HOP_CAP = '$ten_hc'");
    mysql_query("INSERT INTO hopcap (TEN_HOP_CAP,DIA_CHI,SO_CARD) VALUES ('$ten_hc','$dia_chi','$so_card')");
    require('themmoi.php');
    mysql_close();
}
if ( $dk == "check_tenhc") {
    $ten_hc = $_GET[ten_hc];
    $ten_hc = trim($ten_hc);
    $query = "SELECT TEN_HOP_CAP FROM hopcap WHERE TEN_HOP_CAP = '$ten_hc'";
    $result = mysql_query($query);
    if (mysql_num_rows($result) >0 or $ten_hc ==" " or $ten_hc == NULL)
        {
        echo "<loi loi = 1 ></loi>";
        }
    else echo "<loi loi = 0 ></loi>";
    mysql_close();
    mysql_free_result($result);
}
if ($dk == "hien_danh_sach"){
     require('danhsach.php');
}
if ($dk == "edit_hc"){
    $id_hopcap = $_GET[id_hopcap];
    $vi_tri = $_GET[vi_tri];
    $ten_hc = $_GET[ten_hc];
    $query = "SELECT * FROM chi_tiet_hop_cap WHERE ID_HOPCAP = '$id_hopcap' and VI_TRI = '$vi_tri'";
    $result = mysql_query($query);
    if (mysql_num_rows($result) == 1)
        {
        $row=mysql_fetch_array($result);
        $query = "SELECT * FROM danhba WHERE SODT = '$row[SO_DT]'";
        $result = mysql_query($query);
        $row_tb=mysql_fetch_array($result);
        echo "<h2> Cập nhật hộp cáp: ".$ten_hc."</h2>
        <table cellspacing='0' width='500px'>
        <tr><td colspan='2'>vị trí: ".$vi_tri."</td></tr>
        <tr>
            <td align='right'>Số điện thoại:</td>
            <td align='left'><input class='input_sodt' value='".$row[SO_DT]."'></input></td>
        </tr>
         <tr>
            <td align='right'>Tên thuê bao:</td>
            <td align='left'><div id='ten_tb'>".$row_tb[TENTB]."</div></td></td>
        </tr>
         <tr>
            <td align='right'>Tên đơn vị:</td>
            <td align='left'><div id='ten_dv'>".$row_tb[TENDV]."</div></td></td>
        </tr>
        <tr><td colspan='2'><p></p></td></tr>
        </table>
        ";
        echo "<p></p><button id = 'xacnhan'>Xác nhận</button><button id = 'boqua'>Bỏ qua</button>";
        }
    else {
        echo "<h2> Cập nhật hộp cáp: ".$ten_hc."</h2>
        <table cellspacing='0' width='500px'>
        <tr><td colspan='2'>vị trí: ".$vi_tri."</td></tr>
        <tr>
            <td align='right'>Số điện thoại:</td>
            <td align='left'><input class='input_sodt' placeholder='ví dụ 3890 200'></input></td>
        </tr>
         <tr>
            <td align='right'>Tên thuê bao:</td>
            <td align='left'><div id='ten_tb'></div></td></td>
        </tr>
         <tr>
            <td align='right'>Tên đơn vị:</td>
            <td align='left'><div id='ten_dv'></div></td></td>
        </tr>
        <tr><td colspan='2'><p></p></td></tr>
        </table>
        ";
        echo "<button id = 'xacnhan'>Xác nhận</button><button id = 'boqua'>Bỏ qua</button>";
    }
    echo "<div id='space' style='height: 120px' ></div>";
    mysql_close();
    mysql_free_result($result);
}
if ($dk == "update_thuebao"){
    $id_hopcap = $_GET[id_hopcap];
    $vi_tri = $_GET[vi_tri];
    $so_dt = $_GET[so_dt];
    $query = "SELECT * FROM chi_tiet_hop_cap WHERE ID_HOPCAP = '$id_hopcap' and VI_TRI = '$vi_tri'";
    $result = mysql_query($query);
    if (mysql_num_rows($result)>=1){
        mysql_query("UPDATE chi_tiet_hop_cap SET SO_DT = '$so_dt'  WHERE ID_HOPCAP = '$id_hopcap' and VI_TRI = '$vi_tri'");
    }
    else {
        mysql_query("INSERT INTO chi_tiet_hop_cap (SO_DT,ID_HOPCAP,VI_TRI) VALUES ('$so_dt','$id_hopcap','$vi_tri')");
    }
    mysql_close();
    mysql_free_result($result);
}
if ($dk == "check_sodt"){
    $so_dt = $_GET[so_dt];
    $so_dt = trim($so_dt);
    $query = "SELECT * FROM danhba WHERE SODT='$so_dt'";
    $result = mysql_query($query);
    if (mysql_num_rows($result) >=1){
        $row = mysql_fetch_array($result);
        echo "<div id = 'check_result' ten_tb='".$row[TENTB]."' ten_dv='".$row[TENDV]."'></div>";
    }
    mysql_close();
    mysql_free_result($result);
}
if ($dk == "sua_hc"){
    $id_hopcap = $_GET[id_hopcap];
    $query = "SELECT * FROM hopcap WHERE ID_HOPCAP= '$id_hopcap'";
    $result = mysql_query($query);
    $row=mysql_fetch_array($result);
    echo "<h2> Sửa thông tin hộp cáp: ".$row[TEN_HOP_CAP]."</h2>
        <table cellspacing='0' width='500px'>
        <tr><td colspan='2'><p></p></td></tr>
        <tr>
            <td align='right'>Tên hộp cáp:</td>
            <td align='left'><input id='ten_hc' value='".$row[TEN_HOP_CAP]."'></input></td>
        </tr>
        <tr ><td id='alert' colspan='2'>Tên hộp cáp đã tồn tại hãy xem lại</td></tr>
         <tr>
            <td align='right'>Địa chỉ:</td>
            <td align='left'><input id='dia_chi' value='".$row[DIA_CHI]."'></input></td>
        </tr>
         <tr>
            <td align='right'>Số Box:</td>
            <td align='left'><input id='so_card' value='".$row[SO_CARD]."'></input></td>
        </tr>
        <tr><td colspan='2'><p></p></td></tr>
        </table>
        ";
        echo "<p><button id = 'xacnhan'>Xác nhận</button><button id = 'boqua'>Bỏ qua</button></p>
            <div id='space' style='height: 120px' ></div>
        ";
    mysql_close();
    mysql_free_result($result);
}
if($dk=="check_ten_hc"){
    $ten_hc = $_GET[ten_hc];
    $ten_hc = trim($ten_hc);
    $query =  "SELECT * FROM hopcap WHERE TEN_HOP_CAP = '$ten_hc'";
    $result = mysql_query($query);
    if (mysql_num_rows($result) >= 1 or $ten_hc =='' or $ten_hc == null){
        echo "<p id = 'xac_nhan_loi' loi = '1'>Tên hộp cáp đã tồn tại đề nghị chọn tên khác</p>";
    }
    else {
        echo "<p id = 'xac_nhan_loi' loi = '0'>Có thể dùng tên này</p>";
    }
    mysql_close();
    mysql_free_result($result);
}
if ($dk == "update_hc"){
    $ten_hc = $_GET[ten_hc];
    $ten_hc = trim($ten_hc);
    $dia_chi = $_GET[dia_chi];
    $so_card = $_GET[so_card];
    $id_hopcap = $_GET[id_hopcap];
    $query = "UPDATE hopcap SET TEN_HOP_CAP='$ten_hc', DIA_CHI='$dia_chi', SO_CARD='$so_card' WHERE ID_HOPCAP = '$id_hopcap'";
    mysql_query($query);
    require('chinh_sua.php');
    mysql_close();
}
?>
