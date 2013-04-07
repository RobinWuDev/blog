package admin

import (
	"github.com/astaxie/beego"
)

type ArticleManagerConroller struct {
	beego.Controller
}

func (this *ArticleManagerConroller) Get() {
	session := this.StartSession()
	username := session.Get("username")
	if username != "lsdev" {
		this.Ctx.Redirect(302, "/admin/login")
	}
	this.TplNames = "/admin/articleManager.tpl"
	this.Layout = "/admin/adminLayout.html"
}
