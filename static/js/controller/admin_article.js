function delArticle (id,categoryId,page) {
	var url = '/api?action=delArticle';
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
				window.location.href='/admin/articleManager'+"?categoryId="+categoryId+"&page="+page;	
			}
		});
}

$(function() {
	var url = '/api?action=articleList';
	var page = $.getUrlParam('page');
	if (page != null) {
		url += "&page="+page;
	}

	var categoryId = $.getUrlParam('categoryId');
	if (categoryId != null) {
		url += "&category_id="+categoryId;
	}
	var action = $.getUrlParam('action');
    var id = -1;
	if (action == "edit") {
		 id = $.getUrlParam('id');
	} else if (action == "del") {
		 id = $.getUrlParam('id');
		 if (id.length != 0) {
		 	if(window.confirm('你确定要删除这篇文章吗?')){
				delArticle(id,categoryId,page);
				return;
			}else{
				window.location.href='/admin/articleManager'+"?categoryId="+categoryId+"&page="+page;
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
					var articles = resultData.Articles;
					var count = resultData.Count;
					var currentPage = resultData.CurrentPage;
					var categoryId = resultData.CategoryId;
					var pageSum = resultData.PageSum;
					$.each(articles, function(index, value) {
						$("#article_list").append(""
							+"<tr >"
	                			+"<td><a href='/detailArticle?id="+value.Id+"' title='"+value.Title+"'>"+value.Title+"</a></td>"
	                			+"<td>"+value.CreateTime+"</td>"
	                			+"<td>"+value.CategoryName+"</td>"
	               				+"<td>"
	                			+"<a href='/admin/editArticle?id="+value.Id+"' title='编辑'>编辑 </a>"
	                			+"<a href='/admin/articleManager?action=del&id="+value.Id+"' title='删除'>删除</a>"
	                			+"</td>"
              				+"</tr>");	
						if (categoryId == 0) {
							$("#article_h3").html("最新文章列表");
						} else {
							$("#article_h3").html(value.CategoryName+"文章列表");
						}
						
					});
			        pageNav.pageNavId="pageNavId";
					pageNav.pre="上一页";
					pageNav.next="下一页";
					pageNav.url="?page={index}";
					pageNav.fn = function(p,pn){
					};
					pageNav.go(currentPage,pageSum);
				} else {
					alert(msg);
				}
				
			}
		});
});




