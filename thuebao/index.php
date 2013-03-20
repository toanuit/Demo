
<?php  require('../admins/dbcon.inc');
?>

<html>

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="TRAN THANH TOAN" content="" />
    <link rel="stylesheet" type="text/css" href="style_tb.css"/>
    <script type="text/javascript" src="../admins/jquery.min.js"></script>
    <script type="text/javascript" src="xuly_tb.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var wid = $("body").width();
            var hei=$("body").height();
            $(".cot").click(function(){
                $("#gray").css("display","block");
                $("#gray").css("height",hei + 20);
                $("#lightbox").css("display","block");
                $("#lightbox").css("left",((wid/2)-250)+"px");
                var id = $(this).attr("vitri");
                $.get('load_lightbox_thuebao.php',{'dk':'load_lightbox','id':id},function(data){
                    $("#lightbox").html(data);
                    $("#lightbox").append("<div class='check'><div>");
                });
            return False;
            });
        return False;
        });
    </script>
	<title>Tong dai</title>
</head>
<body>
</div>
<div id="gray"title="close"></div>

    <div id="header">
        <h1>THUÊ BAO ANALOG</h1>
    </div>
    <div align="center">
    <?php
    require('../admins/menu.php');
    ?>
    <p></p>
    </div>

     <div id="thuebao" align="center">
         <div title="Xuất ra file EXCEL" id="ban_left" class="ban_scroll">
             <div id="ban_left_1"><img height="70px" src="../images/Export to CSV & Excel.png" /></div>
             <img height="70px" src="../images/ms-office1.png" />
             Xuất ra file EXCEL
       </div>

    <div id="lightbox"></div>
     <div id="section" align="center">
        <?php
        $query = "SELECT * FROM thuebao";
        $result = mysql_query($query) or die(mysql_error);
        $sotb = mysql_num_rows($result);
        $limit = 0;
        $l=1;
        while ($limit < $sotb) {
            $query = "SELECT * FROM thuebao ORDER BY VITRI_ANALOG ASC LIMIT $limit , 8";
            $result = mysql_query($query);
            echo "<div class='bang'>
                    <div class ='limit'><p></p><p>".$l."</p></div>
                ";
            $j =1;
            while ($row = mysql_fetch_array($result)){
            $row_tb = mysql_fetch_array( mysql_query("SELECT * FROM danhba WHERE SODT = '$row[SODT]'"));
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
            echo "</div>";
            $limit +=8;
            $l+=1;
            mysql_free_result($result);
        }
?>
        </div>

</div>

    <footer>
        2012
    </footer>

</body>
</html>