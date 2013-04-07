<link rel="stylesheet" type="text/css" href="/static/css/demo.css" />
<div class="span9" id="content">
  <script type="text/javascript" src="/static/js/external/Markdown.Converter.js"></script>
  <script type="text/javascript" src="/static/js/external/Markdown.Sanitizer.js"></script>
  <script type="text/javascript" src="/static/js/external/Markdown.Editor.js"></script>
  <div class="row-fluid">
    <div class="well">
      <div id="myTabContent" class="tab-content">
        <div class="tab-pane active in" id="home">
          <form id="tab" class="form-horizontal">
            <div class="control-group">
              文章标题:
              <input type="text" id="add_article_title" value="" class="input-xlarge">
              <span class="text-error" id="add_article_prompt_info"></span>
            </div>
            <div class="control-group">
              选择类别:
              <select id="select_category"></select>
            </div>

            <div class="wmd-panel">
              <div id="wmd-button-bar"></div>
              <textarea name="content" class="wmd-input" id="wmd-input"></textarea>
            </div>
            <div id="wmd-preview" class="wmd-panel wmd-preview"></div>
            <div class="btn-toolbar">
              <button class="btn btn-primary" type="button" id="submit_button">提交</button>
            </div>
          </form>
        </div>
      </div>

    </div>
    <script type="text/javascript">
    (function () {
          var converter1 = Markdown.getSanitizingConverter();
          var editor1 = new Markdown.Editor(converter1);
          editor1.run();
    })();
    </script>
  </div>
</div>
  <script type="text/javascript" src="/static/js/controller/add_article.js"></script>