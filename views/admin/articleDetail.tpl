{{with .Article}}
<div class="container row-fluid">
  <div class="span2"></div>
  <div class="span8">
    <h2 align="center">{{.Title}}</h2>
    <div class="row">
      <div class="span4 offset2">
        文章类别:{{.CategoryName}}
      </div>
      <div class="span4 offset2">
        {{.CreateTime}}
      </div>

    </div>
   <hr>
    <p>{{markdown .Content}}
    </p>
  </div>
  <div class="span2"></div>
</div>
{{end}}
<!-- Le javascript
    ================================================== -->
<script src="/static/js/external/pagenav1.1.min.js"></script>
<script src="/static/js/external/Markdown.Converter.js"></script>
<script src="/static/js/external/Markdown.Editor.js"></script>
<script src="/static/js/external/Markdown.Sanitizer.js"></script>