<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="toan112" />
    <script type="text/javascript" src="../admins/jquery.min.js"></script>
    <script type="text/javascript" src="xuly_tuyencap.js"></script>
    <title>Tuyến cáp</title>
    <script type="text/javascript">
    $(document).ready(function() {
        var hei=$(document).height();
                $("#section").css('height',hei-100);
                var loi = 1;
                // kiem tra ten hop cap======================================================
                $("#ten_hc").keyup(function(){
                    var ten_hc = $("#ten_hc").val();
                    $.get('xuly_tuyencap.php',{'dk':'check_tenhc','ten_hc':ten_hc},function(data){
                        $(".alert").html(data);
                        var loi = $(".alert loi").attr("loi");
                        if (loi == 1) // da ton tai
                            {
                                $(".alert").html('Kiểm tra lại tên hộp cáp');
                                $(".alert").css('display','block');
                                //$(".alert").delay(2000).slideUp('slow');
                                $("#ten_hc").css('background-color','#C4F1B6');
                            }
                        else {
                            $(".alert").html('Tên hợp lệ');
                            $(".alert").css('display','block');
                            //$(".alert").delay(2000).slideUp('slow');
                            $("#ten_hc").css('background-color','#fff');
                            //alert(123);
                            }
                        return False;
                    });
                    return False;
                })
                //$("button").css('display','none');
// kiem tra ten tuyen cap neu da co ko the xac nhan ------------------------------->
                $("#xacnhan").click(function(){
                    var ten_hc = $("#ten_hc").val();
                    var dia_chi = $("#dia_chi").val();
                    var so_card = $("#so_card").val();
                        if (ten_hc =='' || ten_hc == null || loi == 1){
                            alert("Kiểm tra lại tên hộp cáp");
                        }
                        else {
                            $.get('xuly_tuyencap.php',
                            {'dk':'them_hc','ten_hc':ten_hc,'dia_chi':dia_chi,'so_card':so_card},
                            function(data){
                                $("#section").html(data);
                                return False;
                            });    // KET THUC XU LY THEM HOP CAP MOI VAO CSDL
                        }
                            //alert(ten_hc + dia_chi + so_card);
                    return False;
                    }); // KET THUC XU LY KHI CLICK VAO XAC NHAN
        return False;
        }); // END JQUERY
    </script>
</head>
<body>
<h1>THÊM MỚI</h1>
<div align="right" id="them">
    	<p>
    		<label align="left">Tên hộp cáp</label>
    		<input id="ten_hc" placeholder="nhập vào" ></input>
    	</p>
        <p> <label class="alert" align="center"></label> </p>
        <p>
            <label align="left">Địa chỉ</label>
            <input id="dia_chi" placeholder="nhập vào" ></input>
        </p>
    	<p>
    		<label align="left">Số Box</label>
    		<input id="so_card" placeholder="nhập vào" ></input>
    	</p>
        <div align="center">
            <button id="xacnhan" >Xác nhận</button>
        </div>
</div>
<?php
    require('danhsach.php');
?>
</body>
</html>
