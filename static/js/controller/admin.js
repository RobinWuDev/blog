$(function() {
	var url = '/api?action=index';
	var page = $.getUrlParam('page');
	if (page != null) {
		url += "&page="+page;
	}

	var categoryId = $.getUrlParam('categoryId');
	if (categoryId != null) {
		url += "&category_id="+categoryId;
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
					var categorys = resultData.Categorys;
					var count = resultData.Count;
					var currentPage = resultData.CurrentPage;
					var categoryId = resultData.CategoryId;
					var pageSum = resultData.PageSum;
					$.each(categorys, function(index, value) {
						if (value.Id == categoryId) {
							$("#categorys").append("<li class='active'><a>"+value.Title+"</a></li>");
						} else {
							$("#categorys").append("<li ><a href='/?categoryId="+value.Id+"''>"+value.Title+"</a></li>");
						}
  						
					});
					$.each(articles, function(index, value) {
						var converter = new Markdown.Converter();
  						var html = converter.makeHtml(value.Content);
						$("#articles").append(""
							+"<div class='hero-unit'>"
            				+"<h3>"+value.Title+"</h3>"
            				+"<p>文章类别:<a href='/?categoryId="+value.CategoryId+"''>"+value.CategoryName+"</a></p>"
            				+"<p>"+value.CreateName+"</p>"
            				+"<p class='article_content'>"+html+"</p>"
          					+"</div>");		
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




