$(document).ready(function() { // bat dau jquery, hien chi chay chinh xac tren trinh duet google chrome
       var wid = $("body").width();
       var hei=$("body").height();
        $(window).scroll(function(){
            var $toado_curr=$(window).scrollTop();
            $('.ban_scroll').stop().animate({'top':$toado_curr+570},400);//Cách TOP 200px
            $("#lightbox").stop().animate({'top':$toado_curr+70},200);
        return  False;
        });
       $("#ban_left").click(function(){
             window.open("../admins");
             return  False;
            });
       //$("#menu").css("left",((wid/2)-484.5)+"px");
       //xuly();
 // ket thuc phan xu ly va them moi bat dau phan tim kiem, hien chi tim theo so dt
    $("#seach").keyup(function(e){ // khi nap vao
               seachok();
               if(e.keyCode==13)
                 {
                 saech_value=$("#seach_value").val();
                 $.get('xuly_tb.php',{'dk':'seach_result','value':saech_value},function(data){
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
                $.get('xuly_tb.php',{'dk':'seach','value':saech_value},function(data){
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
                                $.get('xuly_tb.php',{'dk':'seach_result','value':saech_value},function(data){
                                    $("#section").html(data);
                                    xuly();
                                    return  False;
                                    });
                                $("#seach_result").hide();
                                return  False;
                                });
                         $("#seach_result #show_all").click(function() // khi chon so can tim
                                {
                                $.get('xuly_tb.php',{'dk':'seach_all','value':saech_value},function(data){
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
// ket thuc ham tim kiem  ----------------------------------------------------->
    /* function xuly(){
        //$("article").css("height",hei-400);
       $("td").mousemove(function(){ // khi ra chuot vao vi tri thue bao
            var id = $(this).attr("class");
            $("."+id).css("background-color","rgba(30, 128, 37,0.3)");
            $(this).mouseout(function(){
                $("."+id).css("background-color","white");
                return  False;
                });
            $(this).click(function(){ // chon vi tri can nhap hay can sua se hien form nhap
                var hei=$("body").height();
                $("#gray").css("display","block");
                $("#gray").css("height",hei);
                $("#gray").css("width",wid);
                $("#lightbox").css("display","block");
                $("#lightbox").css("left",((wid/2)-250)+"px");
                id = $(this).attr("class");
                $.get('xuly_tb.php',{'dk':'load_lightbox','id':id},function(data){
                    $("#lightbox").html(data);
                    $("#lightbox").append("<div class='check'><div>");
                    });
                $("#lightbox").mouseover(function(){
                      $(".input_sodt").keyup(function(){ // kiem tra so dien thoai nhap vao
                        var sodt = $(".input_sodt").val();
                        if (sodt.length >7){ // kiem tra so nay da nhap hay chua
                            $.get('xuly_tb.php',{'dk':'check_sodt','sodt':sodt},function(data){
                                $("#lightbox .check").html(data);
                                if (data.length >45){
                                    $(".input_sodt").css("background-color","rgba(204,188,0,0.6)");
                                    }
                                else $(".input_sodt").css("background-color","white");
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
                                $(".input_shell").css("background-color","rgba(204, 188, 0,0.6)");  // khi nhap trung se hien thi mau do de nguoi dung biet
                                } // neu nhap trung se xoa shell cu
                            else $(".input_shell").css("background-color","white"); // chua co se hien thi mau trang
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
                            $("#lightbox").hide();
                            $("#gray").hide();
                            return  False;
                            });
                      return  False;
                      });
                return  False;
                });
            return  False;
            });
        }*/
// ket thuc ham xu ly---------------------------------------------------->
    }); // ket thuc jquery