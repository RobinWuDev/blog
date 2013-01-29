function categoryIsExist (title) {
	var url = '/api?action=categoryIsExist';
	if (title.length == 0) {
		return;
	};
	$.ajax({
			url: url,
			type: 'get',
			data: {title:""+title},
			success: function(data) {
				var status = data.Status;
				var msg = data.Msg;
				var resultData = data.Data;
				if (status) {
					$("#prompt_info").html("类别已存在");
				} else {
					$("#prompt_info").html("");
					return;
				}
				
			}
		});
}

function editCategory (id) {
	var title = $("#edit_category_name_input").val();
	if (title.length == 0) {
		alert("类别名不能为空");
		return;
	}
	var url = '/api?action=editCategory';
	$.ajax({
			url: url,
			type: 'post',
			data: {id:""+id,title:""+title},
			success: function(data) {
				var status = data.Status;
				var msg = data.Msg;
				var resultData = data.Data;
				alert(msg);	
				if (status) {
					window.location.href='/admin/categoryManager';	
				};
			}
		});
}

function delCategory (id) {
	var url = '/api?action=delCategory';
	$.ajax({
			url: url,
			type: 'get',
			data: {id:""+id},
			success: function(data) {
				var status = data.Status;
				var msg = data.Msg;
				var resultData = data.Data;
				if (status) {
					
				} else {
					alert(msg);
				}
				window.location.href='/admin/categoryManager';	
			}
		});
}

$(function(){
            //IE
            if($.support.msie){
                  $("#category_title").get(0).attachEvent("onpropertychange",function (o){
                           categoryIsExist(o.srcElement.value);
                    });
            //非IE
            }else{
            $("#category_title").get(0).addEventListener("input",function(o){
                    categoryIsExist(o.target.value);
                },false);
            }

            var url = '/api?action=categoryList';
            var action = $.getUrlParam('action');
            var id = -1;
			if (action == "edit") {
				 id = $.getUrlParam('id');
			} else if (action == "del") {
				 id = $.getUrlParam('id');
				 if (id.length != 0) {
				 	if(window.confirm('你确定要删除这个文章类别吗?')){
						delCategory(id);
						return;
					}else{
						window.location.href='/admin/categoryManager';
						return;
					}
				 }
				 return;
			}
			$.ajax({
					url: url,
					type: 'get',
					data: {},
					success: function(data) {
						var status = data.Status;
						var msg = data.Msg;
						var resultData = data.Data;
						if (status) {
							var categorys = resultData.Categorys;
							$.each(categorys, function(index, value) {
								if (value.Id != id) {
									$("#category_list").append("<tr>"
										+"<td>"+value.Title+"</td>"
              							+"<td>"+value.ArticleCount+"</td>"
              							+"<td>"
                						+"<a href='?action=edit&id="+value.Id+"'>编辑 </a>"
               							+"<a href='?action=del&id="+value.Id+"'>删除 </a>"
              							+"</td>"
            							+"</tr>");
								} else {
									$("#category_list").append("<tr><td colspan='3'>"
              							+"<form class='form-inline'>"
                						+"<div>"
                						+"<input id='edit_category_name_input' size='30' type='text' value='"+value.Title+"' />"
                						+"<input class='submit'  type='button' value='保存'id='edit_save_button' />"
                						+"<input type='button' value='取消' class='button' id='edit_cancel_button'/>"
              							+"</form>"
  										+"</td> </tr>");
									$("#edit_save_button").click(function(e) {
										editCategory(id);
									});

									$("#edit_cancel_button").click(function(e) {
										window.location.href='/admin/categoryManager';
									});
								}
								
		  						
							});
						}
						
					}
				});
});

$("#submit_button").click(function(e) {

	var title = $("#category_title").val();
	if (title.length == 0) {
		$("#prompt_info").html("类别名不能为空");
		return;
	}
	if ($("#prompt_info").val().length != 0) {
		return;
	}
	var url = '/api?action=addCategory';
	$.ajax({
			url: url,
			type: 'post',
			data: {title:""+title},
			success: function(data) {
				var status = data.Status;
				var msg = data.Msg;
				var resultData = data.Data;
				alert(msg);
				window.location.href='/admin/categoryManager';
			}
		});


});

