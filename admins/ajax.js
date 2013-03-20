
/////////////////////////
// begin - ajax framework
var xmlhttp = createXmlHttpRequestObject();
var ajax_queue = new Array();
var loop_delay = 10;
var loop_ide_delay = 100;

function createXmlHttpRequestObject() 
{  
  var xmlHttp;
  // this should work for all browsers except IE6 and older
  try
  {    
    xmlHttp = new XMLHttpRequest();
  }
  catch(e)
  {
    // assume IE6 or older
    var XmlHttpVersions = new Array("MSXML2.XMLHTTP.6.0",
									"MSXML2.XMLHTTP.5.0", 
									"MSXML2.XMLHTTP.4.0", 
									"MSXML2.XMLHTTP.3.0",      
									"MSXML2.XMLHTTP", 
									"Microsoft.XMLHTTP");    
    for (var i=0; i<XmlHttpVersions.length && !xmlHttp; i++) 
    {
      try 
      {        
        xmlHttp = new ActiveXObject(XmlHttpVersions[i]);
      } 
      catch (e) {}
    }
  }  
  if (!xmlHttp)
    alert("Error creating the XMLHttpRequest object.");
  else 
    return xmlHttp;
}

function do_request(url, callback, result_id)
{		
    xmlhttp.onreadystatechange = function()
    {		
        if(xmlhttp.readyState == 4)
        {
            if(xmlhttp.status == 200) 
			{
               if(callback) 
					callback(xmlhttp.responseText, result_id); 
			}
            else
                alert("error request url: " + url);
        }
		if(xmlhttp.readyState == 4 || xmlhttp.readyState == 0)
			setTimeout("ajax_loop()", loop_delay);
    }	
	var random_string;
	if(url.lastIndexOf("?") != -1)
		random_string = "&rand=" + new Date().getTime();
	else
		random_string = "?rand=" + new Date().getTime();
    xmlhttp.open("GET", url + random_string, true);
    xmlhttp.send(null);
}

function ajax_loop()
{
    if(ajax_queue.length > 0)
    {
        var request = ajax_queue.pop();
        do_request(request[0], request[1], request[2]);
    }
    else
        setTimeout("ajax_loop()", loop_ide_delay);
}
function ajax_request(url, callback, result_id)
{
    var request = new Array(url, callback, result_id);
    ajax_queue.push(request);
}

// Init ajax
ajax_loop();
// End - ajax framework
/////////////////////////
// SEARCH -------------------->

var last_input = "";
function suggest(e)
{
	var code;
	if(!e) e = window.event;
	if(e.keyCode) code = e.keyCode;
	else if(e.which) code = e.which;
	
	if(code == 13)
	{
		search();			
	}
	else
	{
		var input = document.getElementById("search_input").value;
		if(input == last_input) return;
		last_input = input;	
		ajax_request("admin/thuvien/search/suggest.php?q=" + input, suggest_ok, "suggest_div");	
	}
}
function suggest_ok(text, id)
{
	if(text != null && text != "")
	{
		document.getElementById(id).innerHTML = text;
		document.getElementById(id).style.display = "block";
		suggest_index = -1;
		var suggest_div = document.getElementById("suggest_div");
		var suggest_items = suggest_div.getElementsByTagName("div");
		num_suggest_item = suggest_items.length;
		for(var i = 0; i < suggest_items.length; i++)
		{
			var suggest_item = document.getElementById("suggest_item_" + i);
			suggest_item.style.backgroundColor = "WhiteSmoke";			
		}	
	}
	else
	{
		document.getElementById(id).style.display = "none";
		document.getElementById(id).innerHTML = null;
	}
}

var suggest_index = -1;
var num_suggest_item = 0;
function select_suggest(e)
{
	var code;
	if(!e) e = window.event;
	if(e.keyCode) code = e.keyCode;
	else if(e.which) code = e.which;	
	
	var suggest_div = document.getElementById("suggest_div");
	var suggest_items = suggest_div.getElementsByTagName("div");
	num_suggest_item = suggest_items.length;
	if(num_suggest_item == 0) return;	
	if(code == 38)
	{
		suggest_index--;
		if(suggest_index < 0)
			suggest_index = num_suggest_item - 1;
	}
	if(code == 40)
	{
		suggest_index = (suggest_index + 1) % num_suggest_item;
	}	
	for(var i = 0; i < suggest_items.length; i++)
		{
			var suggest_item = document.getElementById("suggest_item_" + i);
			if(i == suggest_index)
			{			
				suggest_item.style.backgroundColor = "GreenYellow";
				document.getElementById("search_input").value = suggest_item.innerHTML;
				last_input = suggest_item.innerHTML;
			}
			else
			{
				suggest_item.style.backgroundColor = "WhiteSmoke";
			}
	}	
}
function search()
{	
	document.getElementById("suggest_div").style.display = "none";		
	var input = document.getElementById("search_input").value;
	ajax_request("admin/thuvien/search/search.php?q=" + input, search_ok, "san_pham");
}
function search_ok(text, id)
{
	document.getElementById(id).innerHTML = text;
}
function mouse_select_suggest(id)
{
	var suggest_div = document.getElementById("suggest_div");
	var suggest_items = suggest_div.getElementsByTagName("div");
	num_suggest_item = suggest_items.length;
	for(var i = 0; i < suggest_items.length; i++)
		{
			var suggest_item = document.getElementById("suggest_item_" + i);
			if(i == id)
			{			
				suggest_item.style.backgroundColor = "GreenYellow";				
			}
			else
			{
				suggest_item.style.backgroundColor = "WhiteSmoke";
			}
	}	
}
function click_search(id)
{	
	document.getElementById("search_input").value = document.getElementById("suggest_item_" + id).innerHTML;
	search();
}



// xu ly menu va muc sanpham ---------------------------->
// show info san pham
function show_product_info(masp)
{
	var box = document.getElementById("info_sp");
	if(box.style.display == "block")
	{
		box.style.left = tempX + "px";
		box.style.top = tempY + "px";		
	}
	else
	{
		box.style.display = "block";
		box.style.left = tempX + "px";
		box.style.top = tempY + "px";	
		ajax_request("xuly.php?dk=show_product_info&masp=" + masp,show_product_info_ok,"info_sp");
		//ajax_request("test2.php?masp=" + masp, show_product_info_ok,idshow);
	}
}
function show_product_info_ok(result, id)
{
	document.getElementById(id).innerHTML = result;
}

function hide_product_info()
{
	document.getElementById("info_sp").style.display = "none";
}


// Lay vi tri chuot
// Tham khao: http://www.codelifter.com/main/javascript/capturemouseposition1.html
var IE = document.all?true:false
// If NS -- that is, !IE -- then set up for mouse capture
if (!IE) document.captureEvents(Event.MOUSEMOVE)
// Set-up to use getMouseXY function onMouseMove
document.onmousemove = getMouseXY;
// Temporary variables to hold mouse x-y pos.s
var tempX = 0
var tempY = 0
// Main function to retrieve mouse x-y pos.s
function getMouseXY(e) {
  if (IE) { // grab the x-y pos.s if browser is IE
    tempX = event.clientX + document.body.scrollLeft
    tempY = event.clientY + document.body.scrollTop
  } else {  // grab the x-y pos.s if browser is NS
    tempX = e.pageX 
	tempX -= 120;
    tempY = e.pageY
	tempY -= 320;
  }  
  // catch possible negative values in NS4
  if (tempX < 0){tempX = 0}
  if (tempY < 0){tempY = 0}   
  return true
}

//------------------------------------>


//------------------------>
// --- LOGIN ------>


// function xu ly -------------------->
function xuly(text, id){
	document.getElementById(id).innerHTML = text;	
}