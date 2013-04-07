package admin

import (
	"github.com/astaxie/beego"
)

type LoginController struct {
	beego.Controller
}

func (this *LoginController) Get() {

	this.Layout = "layout.html"
	this.TplNames = "login.tpl"

}
