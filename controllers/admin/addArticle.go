package admin

import (
	"github.com/astaxie/beego"
)

type AddArticleConroller struct {
	beego.Controller
}

func (this *AddArticleConroller) Get() {
	session := this.StartSession()
	username := session.Get("username")
	if username != "lsdev" {
		this.Ctx.Redirect(302, "/admin/login")
	}
	this.TplNames = "/admin/addArticle.tpl"
	this.Layout = "/admin/adminLayout.html"
}
