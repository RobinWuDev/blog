package admin

import (
	"github.com/astaxie/beego"
)

type AddArticleConroller struct {
	beego.Controller
}

func (this *AddArticleConroller) Get() {
	this.TplNames = "/admin/add.tpl"
	this.Layout = "/admin/adminLayout.html"
}
