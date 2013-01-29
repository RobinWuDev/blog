package main

import (
	"github.com/astaxie/beego"
	"lsdevBlog/controllers"
	"lsdevBlog/controllers/admin"
	"lsdevBlog/controllers/api"
)

func main() {
	beego.RegisterController("/api", &api.ApiController{})
	beego.RegisterController("/", &controllers.IndexController{})
	beego.RegisterController("/about", &controllers.AboutController{})
	beego.RegisterController("/admin", &admin.ArticleManagerConroller{})
	beego.RegisterController("/admin/addArticle", &admin.AddArticleConroller{})
	beego.RegisterController("/admin/categoryManager", &admin.CategoryManagerConroller{})
	beego.RegisterController("/admin/articleManager", &admin.ArticleManagerConroller{})
	beego.Run()
}
