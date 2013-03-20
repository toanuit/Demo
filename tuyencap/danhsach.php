<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="toan112" />
    <script type="text/javascript" src="../admins/jquery.min.js"></script>
    <script type="text/javascript" src="xuly_tuyencap.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        var hei=$(document).height();
        var wid = $(document).width();
        function mouse_move_hopcap(){
        $(".cac_hop_cap").mousemove(function(){
           //Cách TOP 200px
            //$(this).css('background-color','#C4F1B6');
            //$(this).mouseout(function(){
                //$(this).css('background-color','#fff');
           // return False;
            //});
            $(this).click(function(){ // chon vi tri can nhap hay can sua se hien form nhap
                var hei=$("body").height();
                $("#gray").css("display","block");
                $("#gray").css("height",hei+20);
                //$("#gray").css("width",wid);
                $("#lightbox").css("display","block");
                $("#lightbox").css("width","99%");
                $("#lightbox").css("left","1px");
               // $("#lightbox").css("left",((wid/2)-480)+"px");
                var id_hopcap = $(this).attr("id_hopcap");
                var ten_hc = $(this).text();
                //alert(ten_hc);
                function ct_hopcap(id_hopcap)
                {
                    $.get('CT_hopcap.php',{'dk':'ct_hop_cap','id_hopcap':id_hopcap},function(data){
                        $("#lightbox").html(data);
                        $(".cot").click(function(){
                            var vi_tri = $(this).attr("vitri");
                            //var ten_hc = $(this).attr("ten_hc");
                            $.get('xuly_tuyencap.php',{'dk':'edit_hc','id_hopcap':id_hopcap,'vi_tri':vi_tri,'ten_hc':ten_hc},function(data){
                                $("#lightbox").css("left",(wid-480)/2);
                                $("#lightbox").css("width","45%");
                                $("#lightbox").html(data);
                                $(".input_sodt").keyup(function(){
                                    var so_dt = $(".input_sodt").val();
                                    $.get('xuly_tuyencap.php',{'dk':'check_sodt','so_dt':so_dt},function(data){
                                        $("#space").html(data);
                                        var ten_tb = $("#check_result").attr("ten_tb");
                                        var ten_dv = $("#check_result").attr("ten_dv");
                                        $("#ten_tb").html(ten_tb);
                                        $("#ten_dv").html(ten_dv);
                                        return False;
                                    });
                                    return False;
                                })
                                $("#boqua").click(function(){
                                    $("#lightbox").css("left","0px");
                                    $("#lightbox").css("width","99%");
                                    ct_hopcap(id_hopcap);
                                return False;
                                })
                                $("#xacnhan").click(function(){
                                    var so_dt = $(".input_sodt").val();
                                    $.get('xuly_tuyencap.php',{'dk':'update_thuebao','id_hopcap':id_hopcap,'vi_tri':vi_tri,'so_dt':so_dt},function(data){
                                            $("#lightbox").css("left","0px");
                                            $("#lightbox").css("width","99%");
                                            ct_hopcap(id_hopcap);
                                        return False;
                                    })
                                return False;
                                })
                            });
                            return False;
                        })
                        $("#boqua").click(function(){
                            $("#gray").css("display","none");
                            $("#lightbox").css("display","none");
                            $("#lightbox").html("");
                            return False;
                        })
                    return False;
                    });
                return False;
                }
                ct_hopcap(id_hopcap);
            return False;
            });
        return False;
        });
    }
    mouse_move_hopcap();
        return False;
        }); // END JQUERY
    </script>
</head>
<body>
<h2>Các hộp cáp đã có</h2>
<?php
    require('../admins/dbcon.inc');
    $query = "SELECT * FROM hopcap";
    $result = mysql_query($query);

    while ($row = mysql_fetch_array($result)) {
echo '
    <div id_hopcap="'.$row[ID_HOPCAP].'" class="cac_hop_cap">'.$row[TEN_HOP_CAP].'</div>';
    }
    mysql_free_result($result);
?>
<body>
</html>