package controllers

import (
	"github.com/astaxie/beego"
	"io/ioutil"
)

type ShowApiController struct {
	beego.Controller
}

func (this *ShowApiController) Get() {
	b, e := ioutil.ReadFile("./static/api.md")
	if e != nil {
		beego.Error("打开api.md出错:", e)
		return
	}

	this.Data["Content"] = string(b)
	this.Layout = "layout.html"
	this.TplNames = "showapi.tpl"

}
