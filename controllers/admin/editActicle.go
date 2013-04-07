package admin

import (
	"fmt"
	"github.com/astaxie/beego"
	"lsdevBlog/models"
	"strconv"
)

type EditArticleConroller struct {
	beego.Controller
}

func (this *EditArticleConroller) Get() {
	session := this.StartSession()
	username := session.Get("username")
	if username != "lsdev" {
		this.Ctx.Redirect(302, "/admin/login")
	}

	this.Ctx.Request.ParseForm()
	articleId, _ := strconv.Atoi(this.Ctx.Request.Form.Get("id"))
	article, err := models.GetArticle(articleId)

	if err != nil {
		this.Data["error"] = fmt.Sprintln(err, ":", "编辑文章出错")
		this.TplNames = "error.tpl"
		this.Layout = "/admin/adminLayout.html"
		return
	}
	this.Data["Article"] = article
	this.Layout = "/admin/adminLayout.html"
	this.TplNames = "/admin/editArticle.tpl"

}
