package admin

import (
	"github.com/astaxie/beego"
)

type ArticleManagerConroller struct {
	beego.Controller
}

func (this *ArticleManagerConroller) Get() {
	this.TplNames = "/admin/articleManager.tpl"
	this.Layout = "/admin/adminLayout.html"
}
