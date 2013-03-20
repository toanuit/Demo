
<?php  require('../admins/dbcon.inc');
?>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="toan112" />
	<link rel="stylesheet" type="text/css" href="style_tuyencap.css"/>
	<script type="text/javascript" src="../admins/jquery.min.js"></script>
	<script type="text/javascript" src="xuly_tuyencap.js"></script>
	<script type="text/javascript">
	  $(document).ready(function() {
		var wid = $(document).width();
		var hei=$(document).height();
		//alert($(document).height());
		//alert($(window).height());
		//alert(screen.height);
		//alert(hei);
		var $toado_curr=$(window).scrollTop();
		$(window).scroll(function(){
			var $toado_curr=$(window).scrollTop();
			$("#menu_left").stop().animate({'top':$toado_curr+170},400);//Cách TOP 200px
			$("#ban_left").stop().animate({'top':$toado_curr+570},400);//Cách TOP 200px
			//alert($(document).height());
			//$("#gray").stop().animate({'height':hei},2);
			return  False;
			}); // END SCROLL...........
		$("#ban_left").click(function(){
			 window.open("../admins");
			 return  False;
		}); // END CLICK BAN LEFT
		$("#themmoi").click(function(){
			$.get('themmoi.php',{'dk':'them'},function(data){
				$("#section").css('height',600);
				$("#section").html(data);
				//mouse_move_hopcap();
				return  False;
				}); // KET THUC HAM CLICK VAO THEM MOI O MENU TRAI
			return False;
			//mouse_move_hopcap();
		}) // END THEM MOI
		$("#danhsach").click(function(){ // khi click vao danh sach o menu trai
			$.get('danhsach.php',{'dk':'hien_danh_sach'},function(data){
				$("#section").html(data);
				//mouse_move_hopcap();
				return False;
			});
			return False;
		}); // ket thuc clik vao danh sach
		$("#chinhsua").click(function(){ // khi click vao danh sach o menu trai
			$.get('chinh_sua.php',{'dk':'hien_danh_sach'},function(data){
				$("#section").html(data);
				//mouse_move_hopcap();
				return False;
			});
			return False;
		}); // ket thuc clik vao danh sach
	return False;
	}); // END JQUERY
	</script>
	<title>Tuyến cáp</title>
</head>
<body>
<div align="center" id="lightbox"></div>
<div id="gray" align="center"></div>
   <div id="header">
		<h1>Tuyến cáp</h1>
   </div>
   <div align="center">
		<?php
		require('../admins/menu.php');
		?>
	<p></p>
   </div>
	<div id="menu_left" class="ban_scroll">
			<ul>
				<li id="themmoi">Thêm Mới</li>
				<li id="danhsach">Danh Sách</li>
				<li id="chinhsua">Chỉnh Sửa</li>
			</ul>
	</div>
	<div title="Xuất ra file EXCEL" id="ban_left" class="ban_scroll">
			 <div id="ban_left_1"><img height="70px" src="../images/Export to CSV & Excel.png" /></div>
			 <img height="70px" src="../images/ms-office1.png" />
			 Xuất ra file EXCEL
	</div>
<div id="tuyencap" align="center">
	<div id="section" align="center">
		<?php
		    require('danhsach.php');
		?>
	</div>
</div>
	<footer>

	</footer>
</body>
</html>