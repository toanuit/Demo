<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="TRAN THANH TOAN" content="" />
    <script type="text/javascript" src="../admins/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var wid = $("body").width();
            var hei=$("body").height();
            $(".input_sodt").keyup(function(){ // kiem tra so dien thoai nhap vao
                var sodt = $(".input_sodt").val();
                if (sodt.length >7){ // kiem tra so nay da nhap hay chua
                    $.get('xuly_tb.php',{'dk':'check_sodt','sodt':sodt},function(data){
                        $("#lightbox .check").html(data);
                        $alert = $(".alert").attr("alert");
                        //alert($alert);
                            if ($alert == "đã có"){
                            $(".input_sodt").css("background-color","rgba(250, 95, 95, 0.56)");
                            }
                            else $(".input_sodt").css("background-color","rgba(61, 255, 53, 0.560784)");
                    return  False;
                    });
                    $.get('xuly_tb.php',{'dk':'result_tentb','sodt':sodt},function(data){
                        $(".input_tentb").val(data);
                    return  False;
                    });
                    $.get('xuly_tb.php',{'dk':'result_tendv','sodt':sodt},function(data){
                        $(".input_tendv").val(data);
                    return  False;
                    });
                }
            return  False;
            });
            $(".input_shell").keyup(function(){ // kiem tra sell se tranh truong hop nhap trung
                var shell = $(".input_shell").val();
                if(shell.length >7){
                    $.get('xuly_tb.php',{'dk':'result_shell','shell':shell},function(data){
                        $("#lightbox .check").html(data);
                        if (data.length >24){
                            $(".input_shell").css("background-color","rgba(250, 95, 95, 0.56)");  // khi nhap trung se hien thi mau do de nguoi dung biet
                            } // neu nhap trung se xoa shell cu
                        else $(".input_shell").css("background-color","rgba(61, 255, 53, 0.560784)"); // chua co se hien thi mau trang
                    return False;
                    });
                }
            return  False;
            });
                      $(".xacnhan").click(function(){  // khi xac nhan se cap nhat vao co so du lieu
                            var shell = $(".input_shell").val();
                            var sodt = $(".input_sodt").val();
                            var tentb = $(".input_tentb").val();
                            var tendv = $(".input_tendv").val();
                            id=$(".xacnhan").attr("vitri");
                            $.get('xuly_tb.php',{'dk':'update_tb','shell':shell,'sodt':sodt,'tentb':tentb,'tendv':tendv,'id':id},function(data){
                                if(data != sodt){
                                    $("#sodt"+data).html('');
                                    $("#tentb"+data).html('');
                                    $("#tendv"+data).html('');
                                };
                                if (sodt != '')
                                {
                                    $("#sodt"+id).html(sodt);
                                    $("#tentb"+id).html(tentb);
                                    $("#tendv"+id).html(tendv);
                                }
                                else {
                                    $("#sodt"+id).html(sodt);
                                    $("#tentb"+id).html('');
                                    $("#tendv"+id).html('');
                                };
                            });
                            $("#shell"+id).html(shell);
                            $("#lightbox").hide();
                            $("#gray").hide();
                            //alert( shell + sodt + tentb + tendv + id);
                            return  False;
                            });
            $(".boqua").click(function(){ // tat form khi khong muon nhap
                $("#lightbox").html("");
                $("#lightbox").hide();
                $("#gray").hide();
                return  False;
            });
        return False;
        });
    </script>
    <title>Tong dai</title>
</head>
<body>
<?php
    require('../admins/dbcon.inc');
    $id=$_GET[id];
    $query = "SELECT * FROM thuebao WHERE VITRI_ANALOG = $id";
    $result = mysql_query($query) or die(mysql_errno);
    $row = mysql_fetch_array($result);
    $row_tb = mysql_fetch_array( mysql_query("SELECT * FROM danhba WHERE SODT = '$row[SODT]'"));
    echo'<h2>Cập nhật thuê bao</h2>
        <table cellspacing="0" width="500px">
            <tr><td colspan="2">'.$id.'</td></tr>';
    if($row[SHELL] =='' or $row[SHELL] == null){
        echo '  <tr><td align="right">SHELL</td><td align="left"><input class="input_shell" placeholder="ví dụ 0-1-0"></input></td></tr>';
    }
    else {
        echo '  <tr><td align="right">SHELL</td><td align="left"><input class="input_shell" value="'.$row[SHELL].'"></input></td></tr>';
    }
    if ($row[SODT]=='' or $row[SODT] ==null){
        echo '
        <tr><td align="right">Số điện thoại</td><td align="left"><input class="input_sodt" placeholder="ví dụ 3890 200"></input></td></tr>
        <tr><td align="right">Tên thuê bao</td><td align="left"><input class="input_tentb" placeholder="nhập tên thuê bao"></input></td></tr>
        <tr><td align="right">Tên Đơn vị</td><td align="left"><input class="input_tendv" placeholder="nhập tên đơn vị"></input></td></tr>';
            }
    else {
        echo '
        <tr><td align="right">Số điện thoại</td><td align="left"><input class="input_sodt" value="'.$row[SODT].'"></input></td></tr>
        <tr><td align="right">Tên thuê bao</td><td align="left"><input class="input_tentb" value="'.$row_tb[TENTB].'"></input></td></tr>
        <tr><td align="right">Tên Đơn vị</td><td align="left"><input class="input_tendv" value="'.$row_tb[TENDV].'"></input></td></tr>';
            }
        echo '
        <tr><td colspan="2"><p> </p></td></tr>
        <tr><td colspan="2"></td></tr>
        </table>
        <p align="center"><button vitri="'.$id.'" class="xacnhan" >Xác nhận</button><button class="boqua">Bỏ qua</button></p>';
    mysql_free_result($result);
?>
</body>
</html>