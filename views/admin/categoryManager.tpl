<div class="span9" id="content">
    <p class="text-error" id="prompt_info"></p>
    <h3>类别管理</h3>
    <form class="form-inline">  
      新增博客分类  : 
      <input  placeholder="请输入类别名称" size="30" type="text" id="category_title" /> 
      <input class="submit" id="submit_button" type="button" value="提交" />
    </form>
    <table class="table table-hover" >
        <thead>
            <tr>
              <td>名称</td>
              <td>文章数量</td>
              <td>管理</td>
            </tr>
        </thead>
        <tbody id="category_list">
            
        </tbody>
    </table>
</div><!--/span-->
<script src="/static/js/controller/my.js"></script>
<script src="/static/js/controller/admin_category.js"></script>