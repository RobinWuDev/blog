package admin

import (
	"fmt"
	"github.com/astaxie/beego"
	"lsdevBlog/models"
	"strconv"
)

type ArticleDetailConroller struct {
	beego.Controller
}

func (this *ArticleDetailConroller) Get() {

	this.Ctx.Request.ParseForm()
	articleId, _ := strconv.Atoi(this.Ctx.Request.Form.Get("id"))
	article, err := models.GetArticle(articleId)

	if err != nil {
		this.Data["error"] = fmt.Sprintln(err, ":", "查看文章出错")
		this.TplNames = "error.tpl"
		this.Layout = "layout.html"
		return
	}
	this.Data["Article"] = article
	this.TplNames = "/admin/articleDetail.tpl"
	this.Layout = "layout.html"
}
