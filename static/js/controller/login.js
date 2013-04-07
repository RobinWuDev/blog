function login (username,password) {
	var url = '/api?action=login';
	if (username.length == 0) {
		return;
	};
	if (password.length == 0) {
		return;
	};
	$.ajax({
			url: url,
			type: 'post',
			data: {text:""+username,password:""+password},
			success: function(data) {
				var status = data.Status;
				var msg = data.Msg;
				var resultData = data.Data;
				if (status) {
					window.location.href='/admin';	
				} else {
					$("#login_prompt_info").html(msg);
					return;
				}
				
			}
		});
}

function dealInput (idName,showInfo) {
	//IE
    if($.support.msie){
      	$(idName).get(0).attachEvent("onpropertychange",function (o){
      			var text = o.srcElement.value;
      			if (text.length < 5) {
					$("#login_prompt_info").html(showInfo);
				} else {
					$("#login_prompt_info").html("");
					return;
				}
        });
    //非IE
    }else{
	    $(idName).get(0).addEventListener("input",function(o){
	            var text = o.srcElement.value;
      			if (text.length < 5) {
					$("#login_prompt_info").html(showInfo);
				} else {
					$("#login_prompt_info").html("");
					return;
				}
	        },false);
    }
}

$(function() {
	//IE
    dealInput("#text","您输入的账号太短拉");
    dealInput("#password","您输入的密码太短");
});

$("#login_button").click(function(e) {

	var text = $("#text").val();
	var password = $("#password").val();

	login(text,password)


});


