package models

import (
	"fmt"
	"github.com/astaxie/beego"
)

func ErrorRecover(this *beego.Controller) func() {
	return func() {
		if err := recover(); err != nil {
			data := Data{}
			data.Status = false
			if v, ok := err.(string); ok {
				data.Msg = v
			} else {
				data.Msg = "未知错误"
			}

			data.Data = nil
			this.Data["json"] = &data
			this.ServeJson()
			beego.Error(data.Msg)
		}
	}
}

func CheckErr(err error, msg string) {
	if err != nil {
		panic(fmt.Sprintln(msg, ":", err.Error()))
	}

}
