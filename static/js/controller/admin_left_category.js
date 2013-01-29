
function getAdminNavCategoryList () {
	var url = '/api?action=getAllCategory';
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
								$("#admin_left_categorys").append(""
									+"<li ><a href='/admin/articleManager?categoryId="+value.Id+"'>"+value.Title+"("+value.ArticleCount+")</a></li>");
							});
						}
						
					}
				});
}

$(function(){
	getAdminNavCategoryList();
            
});


