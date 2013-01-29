function requestIndexData (page,categoryId) {
	var url = '/api?action=index';
	if (page != null) {
		url += "&page="+page;
	}
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
					$("#categorys").html("<li class='nav-header'>文章类别</li>");
					$.each(categorys, function(index, value) {
						if (value.Id == categoryId) {
							$("#categorys").append("<li class='active'><a>"+value.Title+"</a></li>");
						} else {
							$("#categorys").append("<li ><a class='index_category' href='#' id='leftCategory_"+value.Id+"''>"+value.Title+"</a></li>");
						}
  						
					});
					$("#articles").html("");
					$.each(articles, function(index, value) {
						var converter = new Markdown.Converter();
  						var html = converter.makeHtml(value.Content);
  						
						$("#articles").append(""
							+"<div class='hero-unit'>"
            				+"<h3>"+value.Title+"</h3>"
            				+"<p>文章类别:<a class='index_category' href='#' id='articleCategory_"+value.CategoryId+"'>"+value.CategoryName+"</a></p>"
            				+"<p>"+value.CreateTime+"</p>"
            				+"<p class='article_content'>"+html+"</p>"
          					+"</div>");		
					});
			        pageNav.pageNavId="pageNavId";
					pageNav.pre="上一页";
					pageNav.next="下一页";
					pageNav.url="page_{index}";
					pageNav.fn = function(p,pn){
					};
					pageNav.go(currentPage,pageSum);
					$(".index_category").click(function (e) {
					    e.preventDefault();
					    var id = e.target.id.split("_")[1];
					    requestIndexData(null,id);
					});
					$(".pageNum").click(function (e) {
					    e.preventDefault();
					    var id = e.target.id.split("_")[1];
					    requestIndexData(id,categoryId);
					});
				} else {
					alert(msg);
				}
				
			}
		});
}
$(function() {
	requestIndexData(null,null);
});




