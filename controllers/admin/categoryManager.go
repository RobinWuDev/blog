package admin

import (
	"github.com/astaxie/beego"
)

type CategoryManagerConroller struct {
	beego.Controller
}

func (this *CategoryManagerConroller) Get() {
	this.TplNames = "/admin/categoryManager.tpl"
	this.Layout = "/admin/adminLayout.html"
}
