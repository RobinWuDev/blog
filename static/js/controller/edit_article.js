function articleIsExist (title) {
	var url = '/api?action=articleIsExist';
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
					var originTitle = $("#add_article_origin_title").val();
					if (originTitle == title) {
						$("#add_article_prompt_info").html("");
					} else {
						$("#add_article_prompt_info").html("文章存在");
					}
					
				} else {
					$("#add_article_prompt_info").html("");
					return;
				}
				
			}
		});
}

$(function() {
	//IE
    if($.support.msie){
      	$("#add_article_title").get(0).attachEvent("onpropertychange",function (o){
               articleIsExist(o.srcElement.value);
        });
    //非IE
    }else{
	    $("#add_article_title").get(0).addEventListener("input",function(o){
	            articleIsExist(o.target.value);
	        },false);
    }
	var url = '/api?action=categoryList';
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
							var categoryId = $("#select_category").attr("value");
							$.each(categorys, function(index, value) {
								if (categoryId == value.Id) {
									$("#select_category").append("<option selected='selected' value='"+value.Id+"'>"+value.Title+"</option>");
								} else {
									$("#select_category").append("<option value='"+value.Id+"'>"+value.Title+"</option>");
								}
								
							});
						}
						
					}
				});
});

$("#submit_button").click(function(e) {

	var title = $("#add_article_title").val();
	var categoryId = $("#select_category").val();
	var content = $("#wmd-input").val();
	var articleId = $("#add_article_id").val();
	if (title.length == 0) {
		$("#add_article_prompt_info").html("标题不能为空");
		return;
	}
	if ($("#add_article_prompt_info").val().length != 0) {
		return;
	}

	if (content.length == 0) {
		alert("内容不能为空");
		return;
	}


	var url = '/api?action=editArticle';
	$.ajax({
			url: url,
			type: 'post',
			data: {id:""+articleId,title:""+title,category_id:""+categoryId,content:content},
			success: function(data) {
				var status = data.Status;
				var msg = data.Msg;
				var resultData = data.Data;
				alert(msg);
				window.location.href='/admin';
			}
		});


});




