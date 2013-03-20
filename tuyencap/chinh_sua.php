<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="toan112" />
    <script type="text/javascript" src="../admins/jquery.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        var hei=$(document).height();
        var wid = $(document).width();
        $(".sua").click(function(){
        	var id_hopcap = $(this).attr("id_hopcap");
        	//alert(id_hopcap);
        	$("#gray").css("display","block");
            $("#gray").css("height",hei+20);
            //$("#gray").css("width",wid);
            $("#lightbox").css("display","block");
            $("#lightbox").css("width","45%");
            $("#lightbox").css("left",(wid-480)/2);
        	$.get('xuly_tuyencap.php',{'dk':'sua_hc','id_hopcap': id_hopcap},function(data){
        		$("#lightbox").html(data);
        		var loi = 0;
        		$("#ten_hc").keyup(function(){
        			var ten_hc = $("#ten_hc").val();
        			$.get('xuly_tuyencap.php',{'dk':'check_ten_hc','ten_hc':ten_hc},function(data){
                        //alert(ten_hc);
                        $("#alert").html(data);
                        $("#alert").css("display","block");
                        loi = $("#xac_nhan_loi").attr("loi");
                    return False;
        			})
        			return False;
        		})
                $("#xacnhan").click(function(){
                    var ten_hc = $("#ten_hc").val();
                    var dia_chi = $("#dia_chi").val();
                    var so_card = $("#so_card").val();
                        if (ten_hc =='' || ten_hc == null || loi == 1){
                            alert("Kiểm tra lại tên hộp cáp");
                                }
                        else {
                            $.get('xuly_tuyencap.php',{'dk':'update_hc','ten_hc':ten_hc,'dia_chi':dia_chi,'so_card':so_card,'id_hopcap':id_hopcap},function(data){
                                $("#gray").css("display","none");
                                $("#lightbox").css("display","none");
                                $("#section").html(data);
                                return False;
                            });    // KET THUC XU LY THEM HOP CAP MOI VAO CSDL
                        }
                                    //alert(ten_hc + dia_chi + so_card);
                        return False;
                    }); // KET THUC XU LY KHI CLICK VAO XAC NHAN
        		$("#boqua").click(function(){
                    $("#gray").css("display","none");
                    $("#lightbox").css("display","none");
                    $("#lightbox").html("");
                return False;
                })
/*                 $("#xacnhan").click(function(){
                    var ten_hc = $("#ten_hc").val();
                    var dia_chi = $("#dia_chi").val();
                    var so_card = $("#so_card").val();
                    if (ten_hc =='' || ten_hc == null || loi == 1){
                    alert("Kiểm tra lại tên hộp cáp");
                    }
                    else {
                       $.get('xuly_tuyencap.php',{'dk':'them_hc','ten_hc':ten_hc,'dia_chi':dia_chi,'so_card':so_card},function(data){
                                $("#section").html(data);
                                return False;
                            });    // KET THUC XU LY THEM HOP CAP MOI VAO CSDL
                        }
                            //alert(ten_hc + dia_chi + so_card);
                    return False;
                    }); // KET THUC XU LY KHI CLICK VAO XAC NHAN */
        	/*	$.get('chinh_sua.php',{},function(data){
        			$("#section").html(data);
        		return False;
        		}) */
        	return False;
        	})
        return False;
        })
        return False;
        }); // END JQUERY
    </script>
</head>
<body>
<?php
    require('../admins/dbcon.inc');
    $query = "SELECT * FROM hopcap";
    $result = mysql_query($query);
    echo '<h1>Danh sách các hộp cáp</h1>
    <div id="chinh_sua">
    	<table cellspacing="4">';
    while ($row = mysql_fetch_array($result)) {
echo '
	<tr class="dong_">
		<td class="ten_hc"><div id_hopcap="'.$row[ID_HOPCAP].'">'.$row[TEN_HOP_CAP].'</div></td>
		<td id_hopcap="'.$row[ID_HOPCAP].'" class="sua">Sửa</td>
		<td id_hopcap="'.$row[ID_HOPCAP].'" class="xoa">Xóa</td>
	</tr>
    ';
    }
    echo '</table></div>';
    mysql_free_result($result);
?>
<body>
</html>