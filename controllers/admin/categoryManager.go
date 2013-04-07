package admin

import (
	"github.com/astaxie/beego"
)

type CategoryManagerConroller struct {
	beego.Controller
}

func (this *CategoryManagerConroller) Get() {
	session := this.StartSession()
	username := session.Get("username")
	if username != "lsdev" {
		this.Ctx.Redirect(302, "/admin/login")
	}
	this.TplNames = "/admin/categoryManager.tpl"
	this.Layout = "/admin/adminLayout.html"
}
