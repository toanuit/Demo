
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="toan112" />
    <link rel="stylesheet" type="text/css" href="../admins/menu.css"/>
    <script type="text/javascript" src="../admins/jquery.min.js"></script>
</head>
<?php  require('../admins/dbcon.inc');
    echo '
        <ul id="menu">
            <a href="../thuebao/"><li class="table"><p>THUÊ BAO</p></li></a>
            <li class="nav"></li>
            <a href="../mdf/"><li class="table"><p>MDF</p></li></a>
            <li class="nav"></li>
            <a href="../tuyencap/"><li class="table"><p>TUYẾN CÁP</p></li></a>
            <li class="nav"></li>
            <li id="seach"><p>TÌM KIẾM :<input id="seach_value" results="10" type="search" placeholder="nhập số điện thoại" maxlength="8" /></p>
                <ul id="seach_result">
                </ul>
            </li>
        </ul>';
        /*
    <div id="menu">
            <a><div class="table" id="li1"><p>THUÊ BAO</p></div></a>
            <div class="nav"></div>
            <div class="table" id="li2"><p>MDF</p></div>
            <div class="nav"></div>
            <div class="table" id="li3"><p>TUYẾN CÁP</p></div>
            <div class="nav"></div>
            <div id="seach"><p>TÌM KIẾM :<input id="seach_value" results="10" type="search" placeholder="nhập số điện thoại" maxlength="8" /></p>
            </div>
        </div>
        <div id="seach_result">
        </div>
         ';*/
?>
