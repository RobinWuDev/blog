#LS.Dev'Blog接口文档

---
*接口地址:http://lsdev.me/api?*

示例:

	获得首页数据
	http://lsdev.me/api?action=index


###首页接口

---

####*接口名:首页(index)*

请求方式:GET

<table class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>请求字段名称</th>
			<th>备注</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>page</td>
			<td>页数</td>
		</tr>
		<tr>
			<td>category_id</td>
			<td>类别</td>
		</tr>
		<tr>
			<td>num</td>
			<td>每页文章数</td>
		</tr>
	</tbody>
</table>

<table class="table table-bordered table-striped ">
	<thead>
		<tr>
			<th>返回字段名称</th>
			<th>备注</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>Status</td>
			<td>状态(true|false)</td>
		</tr>
		<tr>
			<td>Msg</td>
			<td>信息(显示信息)</td>
		</tr>
		<tr>
			<td>Data</td>
			<td>返回数据</td>
		</tr>
		<tr>
			<td>Articles</td>
			<td>返回文章列表</td>
		</tr>
		<tr>
			<td>Categorys</td>
			<td>返回列表列表</td>
		</tr>
		<tr>
			<td>Count</td>
			<td>返回文章总数</td>
		</tr>
	</tbody>
</table>

###文章接口
-----

####*接口名:文章列表(articleList)*

请求方式:GET

<table class="table table-bordered table-striped ">
	<thead>
		<tr>
			<th>请求字段名称</th>
			<th>备注</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>page</td>
			<td>页数</td>
		</tr>
		<tr>
			<td>num</td>
			<td>数量</td>
		</tr>
		<tr>
			<td>category_id</td>
			<td>类别id</td>
		</tr>
	</tbody>
</table>

<table class="table table-bordered table-striped ">
	<thead>
		<tr>
			<th>返回字段名称</th>
			<th>备注</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>Status</td>
			<td>状态(true|false)</td>
		</tr>
		<tr>
			<td>Msg</td>
			<td>信息(显示信息)</td>
		</tr>
		<tr>
			<td>Data</td>
			<td>返回数据</td>
		</tr>
		<tr>
			<td>Articles</td>
			<td>返回文章列表</td>
		</tr>
		<tr>
			<td>Count</td>
			<td>返回文章数量</td>
		</tr>
	</tbody>
</table>

---

####*接口名:编辑(editArticle)*

请求方式:POST

<table class="table table-bordered table-striped ">
	<thead>
		<tr>
			<th>请求字段名称</th>
			<th>备注</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>sessionId</td>
			<td>当前用户的Session</td>
		</tr>
		<tr>
			<td>id</td>
			<td>文章id</td>
		</tr>
		<tr>
			<td>title</td>
			<td>文章标题</td>
		</tr>
		<tr>
			<td>content</td>
			<td>文章内容</td>
		</tr>
		<tr>
			<td>category_id</td>
			<td>类别id</td>
		</tr>
	</tbody>
</table>

<table class="table table-bordered table-striped ">
	<thead>
		<tr>
			<th>返回字段名称</th>
			<th>备注</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>Status</td>
			<td>状态(true|false)</td>
		</tr>
		<tr>
			<td>Msg</td>
			<td>信息(显示信息)</td>
		</tr>
		<tr>
			<td>Data</td>
			<td>返回数据</td>
		</tr>
		<tr>
			<td>Article</td>
			<td>返回编辑成功的文章信息</td>
		</tr>
	</tbody>
</table>

---

####*接口名:添加文章(addArticle)*

请求方式:POST

<table class="table table-bordered table-striped ">
	<thead>
		<tr>
			<th>请求字段名称</th>
			<th>备注</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>sessionId</td>
			<td>当前用户的Session</td>
		</tr>
		<tr>
			<td>title</td>
			<td>文章标题</td>
		</tr>
		<tr>
			<td>content</td>
			<td>文章内容</td>
		</tr>
		<tr>
			<td>category_id</td>
			<td>类别id</td>
		</tr>
	</tbody>
</table>

<table class="table table-bordered table-striped ">
	<thead>
		<tr>
			<th>返回字段名称</th>
			<th>备注</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>Status</td>
			<td>状态(true|false)</td>
		</tr>
		<tr>
			<td>Msg</td>
			<td>信息(显示信息)</td>
		</tr>
		<tr>
			<td>Data</td>
			<td>返回数据</td>
		</tr>
		<tr>
			<td>Article</td>
			<td>返回添加成功的文章</td>
		</tr>
	</tbody>
</table>

---


####*接口名:删除文章(delArticle)*

请求方式:GET

<table class="table table-bordered table-striped ">
	<thead>
		<tr>
			<th>请求字段名称</th>
			<th>备注</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>sessionId</td>
			<td>当前用户的Session</td>
		</tr>
		<tr>
			<td>id</td>
			<td>文章id</td>
		</tr>
	</tbody>
</table>

<table class="table table-bordered table-striped ">
	<thead>
		<tr>
			<th>返回字段名称</th>
			<th>备注</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>Status</td>
			<td>状态(true|false)</td>
		</tr>
		<tr>
			<td>Msg</td>
			<td>信息(显示信息)</td>
		</tr>
		<tr>
			<td>Data</td>
			<td>返回数据</td>
		</tr>
		<tr>
			<td>Article</td>
			<td>返回删除成功的文章</td>
		</tr>
	</tbody>
</table>

---


####*接口名:文章详情(articleDetail)*

请求方式:GET

<table class="table table-bordered table-striped ">
	<thead>
		<tr>
			<th>请求字段名称</th>
			<th>备注</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>id</td>
			<td>文章id</td>
		</tr>
	</tbody>
</table>

<table class="table table-bordered table-striped ">
	<thead>
		<tr>
			<th>返回字段名称</th>
			<th>备注</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>Status</td>
			<td>状态(true|false)</td>
		</tr>
		<tr>
			<td>Msg</td>
			<td>信息(显示信息)</td>
		</tr>
		<tr>
			<td>Data</td>
			<td>返回数据</td>
		</tr>
		<tr>
			<td>Article</td>
			<td>文章信息</td>
		</tr>
	</tbody>
</table>

###类别接口
-----

####*接口名:类别列表(categoryList)*

请求方式:GET

<table class="table table-bordered table-striped ">
	<thead>
		<tr>
			<th>请求字段名称</th>
			<th>备注</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>page</td>
			<td>页数</td>
		</tr>
		<tr>
			<td>num</td>
			<td>数量</td>
		</tr>
	</tbody>
</table>

<table class="table table-bordered table-striped ">
	<thead>
		<tr>
			<th>返回字段名称</th>
			<th>备注</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>Status</td>
			<td>状态(true|false)</td>
		</tr>
		<tr>
			<td>Msg</td>
			<td>信息(显示信息)</td>
		</tr>
		<tr>
			<td>Data</td>
			<td>返回数据</td>
		</tr>
		<tr>
			<td>Categorys</td>
			<td>返回类别列表</td>
		</tr>
		<tr>
			<td>Count</td>
			<td>返回类别数量</td>
		</tr>
	</tbody>
</table>

---

####*接口名:添加类别(addCategory)*

请求方式:POST
<table class="table table-bordered table-striped ">
	<thead>
		<tr>
			<th>请求字段名称</th>
			<th>备注</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>sessionId</td>
			<td>当前用户的Session</td>
		</tr>
		<tr>
			<td>title</td>
			<td>类别标题</td>
		</tr>
	</tbody>
</table>

<table class="table table-bordered table-striped ">
	<thead>
		<tr>
			<th>返回字段名称</th>
			<th>备注</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>Status</td>
			<td>状态(true|false)</td>
		</tr>
		<tr>
			<td>Msg</td>
			<td>信息(显示信息)</td>
		</tr>
		<tr>
			<td>Data</td>
			<td>返回数据</td>
		</tr>
		<tr>
			<td>Category</td>
			<td>返回添加成功后的类别</td>
		</tr>
	</tbody>
</table>

---

####*接口名:编辑类别(editCategory)*

请求方式:POST
<table class="table table-bordered table-striped ">
	<thead>
		<tr>
			<th>请求字段名称</th>
			<th>备注</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>sessionId</td>
			<td>当前用户的Session</td>
		</tr>
		<tr>
			<td>id</td>
			<td>类别id</td>
		</tr>
		<tr>
			<td>title</td>
			<td>类别标题</td>
		</tr>
	</tbody>
</table>

<table class="table table-bordered table-striped ">
	<thead>
		<tr>
			<th>返回字段名称</th>
			<th>备注</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>Status</td>
			<td>状态(true|false)</td>
		</tr>
		<tr>
			<td>Msg</td>
			<td>信息(显示信息)</td>
		</tr>
		<tr>
			<td>Data</td>
			<td>返回数据</td>
		</tr>
		<tr>
			<td>Category</td>
			<td>返回编辑成功后的类别信息</td>
		</tr>
	</tbody>
</table>

-----

####*接口名:删除类别(delCategory)*

请求方式:GET

<table class="table table-bordered table-striped ">
	<thead>
		<tr>
			<th>请求字段名称</th>
			<th>备注</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>sessionId</td>
			<td>当前用户的Session</td>
		</tr>
		<tr>
			<td>id</td>
			<td>类别id</td>
		</tr>
	</tbody>
</table>

<table class="table table-bordered table-striped ">
	<thead>
		<tr>
			<th>返回字段名称</th>
			<th>备注</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>Status</td>
			<td>状态(true|false)</td>
		</tr>
		<tr>
			<td>Msg</td>
			<td>信息(显示信息)</td>
		</tr>
		<tr>
			<td>Data</td>
			<td>返回数据</td>
		</tr>
		<tr>
			<td>Category</td>
			<td>返回删除成功后的类别</td>
		</tr>
	</tbody>
</table>

###其他接口
-----

####*接口名:登陆(login)*

请求方式:POST

<table class="table table-bordered table-striped ">
	<thead>
		<tr>
			<th>请求字段名称</th>
			<th>备注</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>text</td>
			<td>用户名</td>
		</tr>
		<tr>
			<td>password</td>
			<td>密码</td>
		</tr>
	</tbody>
</table>

<table class="table table-bordered table-striped ">
	<thead>
		<tr>
			<th>返回字段名称</th>
			<th>备注</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>Status</td>
			<td>状态(true|false)</td>
		</tr>
		<tr>
			<td>Msg</td>
			<td>信息(显示信息)</td>
		</tr>
		<tr>
			<td>Data</td>
			<td>返回数据</td>
		</tr>
		<tr>
			<td>Username</td>
			<td>用户名</td>
		</tr>
		<tr>
			<td>Session</td>
			<td>当前用户的Session,通过这个值进行调用其他接口</td>
		</tr>
	</tbody>
</table>