
<?php  require('dbcon.inc');
?>
<html>

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="TRAN THANH TOAN" content="" />
    <link rel="stylesheet" type="text/css" href="style_tb.css"/>
    <script type="text/javascript" src="jquery.min.js"></script>
    <script type="text/javascript" src="ajax.js"></script>
    <script type="text/javascript" src="xuly_tb.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        var wid = $("body").width();
        var hei=$("body").height();
        $("#seach_result").css("left",(wid/2)+13);
        var danhba=$(".danhba");
        danhba.mousemove(function(){
            $(this).css("background-color","rgba(30, 128, 37,0.3)");
           // alert($(this).text());
            $(this).mouseout(function(){
                $(this).css("background-color","white");
                return  False;
                });
            return  False;
            });
//----------END MOUSE MOVE------------------->
       $("#seach").keyup(function()
               {seachok();
               return  False;
               }
       );
        $("#seach").mouseup(function()
               {seachok();
               return  False;
               }
       );
       function seachok()
            {
                //$("#seach_result").show();
                saech_value=$("input").val();
                if (saech_value.length>2)
                {
                $("#seach_result").show();
                $("#seach_result").load('xuly_tb.php',{'dk':'seach','value':saech_value});
                //alert(saech_value);
                $("#seach_result").mousemove(function()
                    {
                        $("#seach_result #result").mousemove(function()
                            {
                                $(this).css("background-color","#92D077")
                                return  False;
                            });
                        $("#seach_result #result").mouseout(function()
                            {
                                $(this).css("background-color","")
                            return  False;
                            });
                         $("#seach_result #result").mouseup(function()
                                {
                                saech_value=$(this).text();
                                $("section").load('xuly_tb.php',{'dk':'seach_result','value':saech_value});
                                $("#seach_result").hide();
                                $("article").css("height", "800px");
                                //$("article section").css("background","rgba(0, 128, 0,0.4)");
                                }
                            );
                    return  False;
                    });
                }
                else {
                $("#seach_result").hide();
                }
            };
//------------END KEYUP--------------->
    });
    </script>
	<title>Tong dai</title>
</head>
<body>
<div id="seach_result">
<div id="result"></div>
</div>
<div id="gray"title="close"></div>
<!------------------------------------>
    <header>
    <h1>THUÊ BAO ANALOG</h1>
        <ul>
            <li></li>
            <li></li>
        </ul>
    </header>
<!--------------------------------------------->
     <div align="center">
     <div id="seach">Tìm số điện thoại<input results="10" type="search" placeholder="nhập vào số điện thoại" maxlength="8" />
     </div>
    <article>
    <div id="lightbox"></div>
        <section>
        <?php
        $i=9;
        $j=1;
        $result= mysql_query("SELECT * FROM thuebao ORDER BY VITRI_ANALOG");
        while($row = mysql_fetch_array($result)){
            $sodt = $row[SODT];
            $row_tb = mysql_fetch_array( mysql_query("SELECT * FROM danhba WHERE SODT = '$row[SODT]'"));
            if($i==9)
            {
            echo '<div id="sott"></br></br>'.$j.'</div>'; 
            $i=1;
            }
        echo '
        <div class="danhba" id='.$row[VITRI_ANALOG].' onclick="add_number('.$row[VITRI_ANALOG].')">
        <div class="vitri">'.$i.'</div>
        <div class="shell" id="shell_'.$row[VITRI_ANALOG].'">'.$row[SHELL].'</div>
        <div class="ten" id="ten_'.$row[VITRI_ANALOG].'">'.$row_tb[TENTB].'</div>
        <div class="tendv" id="tendv_'.$row[VITRI_ANALOG].'">'.$row_tb[TENDV].'</div>
        <div class="sodt" id="sodt_'.$row[VITRI_ANALOG].'">'.$row[SODT].'</div>
        </div>
            ';  
          
        $i=$i+1;
        if($i==9) {$j=$j+1;
        if($j==41) break;
        echo '<div id="space"></div>'; 
        };
          };
        ?>
        
        </section>
    
    </article></div>
<!----------------------------------------------->
    <footer>
   
    </footer>

</body>
</html>