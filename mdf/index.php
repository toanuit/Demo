
<?php  require('../admins/dbcon.inc');
?>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="toan112" />
    <link rel="stylesheet" type="text/css" href="style_mdf.css"/>
    <script type="text/javascript" src="../admins/jquery.min.js"></script>
    <script type="text/javascript" src="xuly_mdf.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        var wid = $("body").width();
        var hei=$("body").height();
        var $toado_curr=$(window).scrollTop();
        $("#lightbox").stop().animate({'top':$toado_curr+70},200);
        $(window).scroll(function(){
            var $toado_curr=$(window).scrollTop();
            $('.ban_scroll').stop().animate({'top':$toado_curr+570},400);//Cách TOP 200px
            $("#lightbox").stop().animate({'top':$toado_curr+70},200);
            return  False
            });
        $("#ban_left").click(function(){
             window.open("../admins");
             return  False;
            });
        $(".mdf").mousemove(function(){
          $(this).css("background-color","rgba(30, 128, 37,0.3)");
          $(this).mouseout(function(){
                $(this).css("background-color","white");
                return  False;
                });
          $(this).click(function(){ // khi chon so can sua hoac vi tri can nhap se hien form nhap
            $("#lightbox").css("display","block");
            $("#lightbox").css("left",((wid/2)-250)+"px");
            $("#gray").css("height",hei);
            $("#gray").css("width",wid);
			$("#gray").css("display","block");
            var id=$(this).attr("vitri");
            $.get('xuly_mdf.php',{'dk':'load_lightbox','id':id},function(data){
                $("#lightbox").html(data);
                $("#lightbox").append("<div class='check'><div>");
                //$(".check").css("top",350);
                check_sodt();
                return  False;
                })
            //$("#lightbox").load('xuly_mdf.php?dk=load_lightbox&id='+id);
function check_sodt(){
                    $(".sodt_input").keyup(function(e){
                    id=$(".xacnhan").attr("vitri");
                    var sodt=$(this).val();
                    $.get('xuly_mdf.php',{'dk':'check_sodt','sodt':sodt},function(data){
                        $("#lightbox .check").html(data);
                        if(data == 'số này đã có nếu xác nhận thì vị trí cũ sẽ mất'){
                             $(".sodt_input").css("background-color","red");
                            }
                        else $(".sodt_input").css("background-color","white");
                        return  False;
                        });
                     if(e.keyCode==13) {
                        xacnhan();
                     }
                    $.get('xuly_mdf.php',{'dk':'input_ten','sodt':sodt},function(data){
                        $("#ten_input"+id).val(data);
                        return  False;
                        });
                    $.get('xuly_mdf.php',{'dk':'input_tendv','sodt':sodt},function(data){
                        $("#tendv_input"+id).val(data);
                        return  False;
                        });
                    return  False;
                    });
                $(".xacnhan").click(function(){
                    xacnhan();
                return  False;
                });
            function xacnhan(){
                    var sodt = $(".sodt_input").val();
                    var tentb = $(".ten_input").val();
                    var tendv = $(".tendv_input").val();
                    id=$(".xacnhan").attr("vitri");
                    $.get('xuly_mdf.php',{'dk':'up_mdf','sodt':sodt,'tentb':tentb,'tendv':tendv,'id':id},function(data){
                        if (data != sodt) {
                            $("#sodt_"+data).html(' ');
                            $("#ten_"+data).html(' ');
                            };
                        var so = sodt.substring(5,8);
                        $("#sodt_"+id).html(sodt.substring(5,8));
                        $("#ten_"+id).html(tentb +' '+tendv);
                        return  False;
                        });
                    $("#lightbox").hide();
                    $("#gray").hide();
                }
                 $(".boqua").click(function(){
                    $("#lightbox").hide();
                    $("#gray").hide();
                    return  False;
                    });
            }

 /*           $("#lightbox").mousemove(function(){
                $(".sodt_input").keyup(function(){
                    id=$(".xacnhan").attr("vitri");
                    var sodt=$(this).val();
                    $.get('xuly_mdf.php',{'dk':'check_sodt','sodt':sodt},function(data){
                        $("#lightbox .check").html(data);
                        if(data == 'số này đã có nếu xác nhận thì vị trí cũ sẽ mất'){
                             $(".sodt_input").css("background-color","red");
                            }
                        else $(".sodt_input").css("background-color","white");
                        return  False;
                        });
                    $.get('xuly_mdf.php',{'dk':'input_ten','sodt':sodt},function(data){
                        $("#ten_input"+id).val(data);
                        return  False;
                        });
                    $.get('xuly_mdf.php',{'dk':'input_tendv','sodt':sodt},function(data){
                        $("#tendv_input"+id).val(data);
                        return  False;
                        });
                    return  False;
                    });
                $(".xacnhan").click(function(){
                    var sodt = $(".sodt_input").val();
                    var tentb = $(".ten_input").val();
                    var tendv = $(".tendv_input").val();
                    id=$(".xacnhan").attr("vitri");
                    $.get('xuly_mdf.php',{'dk':'up_mdf','sodt':sodt,'tentb':tentb,'tendv':tendv,'id':id},function(data){
                        if (data != sodt) {
                            $("#sodt_"+data).html(' ');
                            $("#ten_"+data).html(' ');
                            };
                        var so = sodt.substring(5,8);
                        $("#sodt_"+id).html(sodt.substring(5,8));
                        $("#ten_"+id).html(tentb +' '+tendv);
                        return  False;
                        });
                    $("#lightbox").hide();
                    $("#gray").hide();
                    return  False;
                });
                 $(".boqua").click(function(){
                    $("#lightbox").hide();
                    $("#gray").hide();
                    return  False;
                    });
                return  False;
                }); */
            return False;
            });
        return False;
        });
//------------------------------------------------------------------------------------
    $("#seach").keyup(function(e){ // khi nap vao
               seachok();
               if(e.keyCode==13)
                 {
                 saech_value=$("#seach_value").val();
                 $.get('xuly_mdf.php',{'dk':'seach_result','value':saech_value},function(data){
                    $("#section").html(data);
                    //xuly();
                    return  False;
                    });
                 //$("section").load('xuly_tb.php',{'dk':'seach_result','value':saech_value});
                 $("#seach_result").hide();
                 //$("article section").css("background","rgba(0, 128, 0,0.4)");
                 } ;
               return  False;
               });
    function seachok()
            {
                saech_value=$("#seach_value").val();
                if (saech_value.length>2)
                {
                $("#seach_result").show();
                $.get('xuly_mdf.php',{'dk':'seach','value':saech_value},function(data){
                    $("#seach_result").html(data);
                    //alert(saech_value);
                    return  False;
                    });
                $("#seach_result").mousemove(function() // khi dua chuot vao so can tim
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
                         $("#seach_result #result").click(function() // khi don vi can tim
                                {
                                saech_value=$(this).text();
                                $.get('xuly_mdf.php',{'dk':'seach_result','value':saech_value},function(data){
                                    $("#section").html(data);
                                    xuly();
                                    return  False;
                                    });
                                $("#seach_result").hide();
                                return  False;
                                });
                         $("#seach_result #show_all").click(function() // khi chon so can tim
                                {
                                $.get('xuly_mdf.php',{'dk':'seach_all','value':saech_value},function(data){
                                    $("#seach_result").html(data);
                                    return  False;
                                    });
                                return  False;
                                });
                    return  False;
                    });
                }
                else {
                $("#seach_result").hide();
                return  False;
                }
                var show = 0;
                $("#seach_value").click(function(){
                    if (show == 0){
                    $("#seach_result").hide();
                    show = 1;
                    }
                    else {
                        $("#seach_result").show();
                        show = 0;
                    }
                    return  False;
                    });
            };
//------------------------------------------------------------------------------------
    });
    </script>
	<title>MDF</title>
</head>
<body>
<div align="center" id="lightbox"></div>
<div id="gray"></div>
   <div id="header">
        <h1>GIÁ MDF</h1>
   </div>
   <div align="center">
        <?php
        require('../admins/menu.php');
        ?>
    <p></p>
   </div>
   <div title="Xuất ra file EXCEL" id="ban_left" class="ban_scroll">
             <div id="ban_left_1"><img height="70px" src="../images/Export to CSV & Excel.png" /></div>
             <img height="70px" src="../images/ms-office1.png" />
             Xuất ra file EXCEL
    </div>
<div id="mdf" align="center">
<div id="section" align="center">
<?php
    $result = mysql_query("SELECT * FROM mdf ORDER BY HOP,VITRI ASC");
    $i=1;
    $j=1;
    while($row= mysql_fetch_array($result)){
        if($row[HOP]==$i){
             echo '<h2>Hộp '.$row[HOP].'</h2>';
             echo '
                <table cellspacing="0">
                <tr>
                <td>STT</td>
                <td>SĐT</td>
                <td>Tên TB</td>
                <td>SDT</td>
                <td>Tên TB</td>
                <td>SĐT</td>
                <td>Tên TB</td>
                <td>SĐT</td>
                <td>Tên TB</td>
                <td>SĐT</td>
                <td>Tên TB</td>
                </tr>';
                $i=$i+1;
            }
        $rowdb=mysql_fetch_array(mysql_query("SELECT * FROM danhba WHERE SODT = '$row[SODT]'"));
        if($row[VITRI]==1 or ($row[VITRI]-1)%5==0){ echo '<tr><td>'.$row[VITRI].'</td>' ;}
        echo '<td vitri="'.$row[id].'" class="mdf" id="sodt_'.$row[id].'">'.substr($row[SODT],5).'</td><td align = "left" vitri="'.$row[id].'" id="ten_'.$row[id].'">'.$rowdb[TENTB].'  '.$rowdb[TENDV].'</td>';
        if( $row[VITRI]%5==0) echo '</tr>' ;
        if($row[VITRI]==100) echo '</table>';
    }
?>
      </div>
</div>
    <footer>

    </footer>
</body>
</html>