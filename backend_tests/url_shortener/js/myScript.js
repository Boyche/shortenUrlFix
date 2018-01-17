 
$(document).on("click","#getShortUrlBtn",function(){
	var urlVal = $("#urlTxt").val().trim();
	
	
	
	if(urlVal.length == 0){
		alert("Please, insert url!");
		return;
	}
	var urlRegEx = /^(?:http(s)?:\/\/)?[\w.-]+(?:\.[\w\.-]+)+[\w\-\._~://?#[\]@!\$&'\(\)\*\+,;=.]+$/;
	if( !urlRegEx.test(urlVal) ){
		alert("Url is not propper!");
		return;
	}
	
	var arr = { url: urlVal };
	//console.log("Sve OK!");
	$.ajax({
		url: "/backend_tests/url_shortener/shorten.php",
		method: "POST",
		data: JSON.stringify(arr),
		contentType: 'application/json; charset=utf-8',
		dataType: "json",
		async: false,
		success: function(object){
			//console.log(object);
			//return;
			$("#yourUrlDiv").fadeOut(500, function(){
				var str ="Your link: "+object.original_link+
							"<br/><br/>Shorten link: <input readonly id='shortUrl' value='localhost/"+object.short_link+"'> </input> <br/><br/>";
				str+= "<button  onclick='clickToCopy()' >Click to Copy link </button><br/><br/>";
				str+= "<button  onclick='makeNewShortUrl()' >Make New Short Url</button><br/><br/>";
				$('#shortUrlDiv').html(str).fadeIn(500);
			
			});
		},
		error: function(){
		}
	});
});


function clickToCopy(){
  var copyText = document.getElementById("shortUrl");
    copyText.select();
    document.execCommand("Copy");
    alert("Copied the text: " + copyText.value);
}

function makeNewShortUrl(){
	$("#urlTxt").val("");
	$("#shortUrl").val("");
  $("#shortUrlDiv").fadeOut(500, function(){
	$("#yourUrlDiv").fadeIn(500);
  });
}

$(document).on("click","#testBtn", function(){
	$.ajax({
		url: "/backend_tests/url_shortener/openUrl.php",
		method: "GET",
		data: {
			"shortUrl":"ftKIvr4NWzaa"
		},
		dataType: "text",
		success: function(object){
			console.log(object);
			
		},
		error: function(){
		}
	});
});