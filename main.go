package main

import (
	"github.com/astaxie/beego"
	"log"
	"lsdevBlog/controllers"
	"lsdevBlog/controllers/admin"
	"lsdevBlog/controllers/api"
	"os"
)

// var globalSessions *session.Manager

func main() {
	fd, err := os.OpenFile("./log/lsdevlog.log", os.O_RDWR|os.O_APPEND, 0644)
	if err != nil {
		beego.Critical("openfile lsdevlog.log:", err)
		return
	}
	lg := log.New(fd, "", log.Ldate|log.Ltime)
	beego.SetLogger(lg)
	beego.SessionOn = true
	beego.RegisterController("/api", &api.ApiController{})
	beego.RegisterController("/", &controllers.IndexController{})
	beego.RegisterController("/about", &controllers.AboutController{})
	beego.RegisterController("/admin", &admin.ArticleManagerConroller{})
	beego.RegisterController("/admin/addArticle", &admin.AddArticleConroller{})
	beego.RegisterController("/admin/editArticle", &admin.EditArticleConroller{})
	beego.RegisterController("/detailArticle", &admin.ArticleDetailConroller{})
	beego.RegisterController("/admin/categoryManager", &admin.CategoryManagerConroller{})
	beego.RegisterController("/admin/articleManager", &admin.ArticleManagerConroller{})
	beego.RegisterController("/api.md", &controllers.ShowApiController{})
	beego.RegisterController("/admin/login", &admin.LoginController{})
	beego.Run()
}
