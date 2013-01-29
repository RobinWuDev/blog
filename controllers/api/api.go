package api

import (
	"errors"
	"github.com/astaxie/beego"
	"lsdevBlog/models"
	"strconv"
	"time"
)

type ApiController struct {
	beego.Controller
}

func (this *ApiController) Post() {
	defer models.ErrorRecover(&this.Controller)()

	this.Ctx.Request.ParseForm()

	action := this.Ctx.Request.Form.Get("action")
	switch action {
	case "addCategory":
		addCategory(this)
	case "addArticle":
		addArticle(this)
	case "editArticle":
		editArticle(this)
	case "editCategory":
		editCategory(this)
	default:
		models.CheckErr(errors.New("没有找到服务"), "调用接口失败")

	}
}

func (this *ApiController) Get() {
	defer models.ErrorRecover(&this.Controller)()

	this.Ctx.Request.ParseForm()

	action := this.Ctx.Request.Form.Get("action")
	switch action {
	case "index":
		index(this)
	case "delCategory":
		delCategory(this)
	case "categoryList":
		categoryList(this)
	case "delArticle":
		delArticle(this)
	case "articleList":
		articleList(this)
	case "articleIsExist":
		articleIsExist(this)
	case "categoryIsExist":
		categoryIsExist(this)
	case "getAllCategory":
		getAllCategory(this)
	default:
		models.CheckErr(errors.New("没有找到服务"), "调用接口失败")

	}
}

//index接口

func index(this *ApiController) {
	categoryId, err := strconv.Atoi(this.Ctx.Request.Form.Get("category_id"))
	if err != nil {
		categoryId = 0
	}
	page, err := strconv.Atoi(this.Ctx.Request.Form.Get("page"))
	if err != nil {
		page = 0
	} else {
		page -= 1
	}
	num, err := strconv.Atoi(this.Ctx.Request.Form.Get("num"))
	if err != nil {
		num = 5
	}

	var articles []models.Article
	var categorys []models.Category
	var count int

	if categoryId == 0 {
		err = models.GetArticles(&articles, page, num)
		count = models.GetArticlesCount()
		models.CheckErr(err, "获取文章列表出错")
	} else {
		err = models.GetArticlesByCategoryID(&articles, page, num, categoryId)
		count = models.GetArticlesCountByCategoryID(categoryId)
		models.CheckErr(err, "获取文章列表出错")
	}

	err = models.GetAllCategorys(&categorys)
	models.CheckErr(err, "获取类别列表出错")

	pageSum := count / num
	if pageSum > 0 && count%num != 0 {
		pageSum += 1
	}

	data := models.Data{}
	data.Status = true
	data.Msg = "获取数据成功"
	tempData := map[string]interface{}{"Articles": articles,
		"Categorys": categorys, "Count": count, "CurrentPage": page + 1, "PageSum": pageSum, "CategoryId": categoryId}
	data.Data = tempData
	this.Data["json"] = &data
	this.ServeJson()
}

//category接口

func addCategory(this *ApiController) {
	title := this.Ctx.Request.Form.Get("title")
	if len(title) != 0 {
		tempArticle, err := models.GetCategoryByTitle(title)
		models.CheckErr(err, "添加类别失败")
		if tempArticle.Id != 0 {
			models.CheckErr(errors.New("类别标题已存在"), "添加类别失败")
		}

		article := models.Category{}
		article.Title = title
		article.CreateTime = time.Now().Format("2006-01-02 15:04:05")
		err = models.AddCategory(&article)
		models.CheckErr(err, "添加类别失败")

		tempData := map[string]interface{}{"Category": article}
		data := models.Data{Status: true, Msg: "添加成功", Data: tempData}
		this.Data["json"] = &data
		this.ServeJson()
	}
	models.CheckErr(errors.New("类别名长度为0"), "添加类别失败")
}

func editCategory(this *ApiController) {
	id, err := strconv.Atoi(this.Ctx.Request.Form.Get("id"))
	models.CheckErr(err, "类别id错误")
	title := this.Ctx.Request.Form.Get("title")
	if len(title) != 0 {
		tempArticle, err := models.GetCategory(id)
		models.CheckErr(err, "添加类别失败")
		if tempArticle.Id == 0 {
			models.CheckErr(errors.New("类别标题不存在"), "编辑类别失败")
		}

		tempArticle1, err := models.GetCategoryByTitle(title)
		models.CheckErr(err, "添加类别失败")
		if tempArticle1.Id != 0 {
			models.CheckErr(errors.New("类别标题已存在"), "编辑类别失败")
		}

		tempArticle.Title = title
		tempArticle.CreateTime = time.Now().Format("2006-01-02 15:04:05")
		err = models.AddCategory(&tempArticle)
		models.CheckErr(err, "编辑类别失败")

		tempData := map[string]interface{}{"Category": tempArticle}
		data := models.Data{Status: true, Msg: "编辑成功", Data: tempData}
		this.Data["json"] = &data
		this.ServeJson()
	}
	models.CheckErr(errors.New("类别名长度为0"), "编辑类别失败")
}

func delCategory(this *ApiController) {
	id, err := strconv.Atoi(this.Ctx.Request.Form.Get("id"))
	models.CheckErr(err, "类别id错误")

	article, err := models.GetCategory(id)
	models.CheckErr(err, "删除类别失败")
	if article.Id != 0 {

		err := models.DelCategory(&article)
		models.CheckErr(err, "删除类别失败")

		tempData := map[string]interface{}{"Category": article}
		data := models.Data{Status: false, Msg: "删除成功", Data: tempData}
		this.Data["json"] = &data
		this.ServeJson()
	}

	models.CheckErr(errors.New("类别不存在"), "")
}

func categoryList(this *ApiController) {
	page, err := strconv.Atoi(this.Ctx.Request.Form.Get("page"))
	if err != nil {
		page = 0
	}
	num, err := strconv.Atoi(this.Ctx.Request.Form.Get("num"))
	if err != nil {
		num = 10
	}
	var categorys []models.Category
	var count int

	err = models.GetCategoryByPage(&categorys, page, num)
	models.CheckErr(err, "获取类别列表出错")
	count = models.GetCategoryCount()

	data := models.Data{}
	data.Status = true
	data.Msg = "获取数据成功"
	tempData := map[string]interface{}{
		"Categorys": categorys, "Count": count}
	data.Data = tempData
	this.Data["json"] = &data
	this.ServeJson()
}

//acticle接口
func articleList(this *ApiController) {
	categoryId, err := strconv.Atoi(this.Ctx.Request.Form.Get("category_id"))
	if err != nil {
		categoryId = 0
	}
	page, err := strconv.Atoi(this.Ctx.Request.Form.Get("page"))
	if err != nil {
		page = 0
	} else {
		page -= 1
	}
	num, err := strconv.Atoi(this.Ctx.Request.Form.Get("num"))
	if err != nil {
		num = 10
	}

	var articles []models.Article
	var count int

	if categoryId == 0 {
		err = models.GetArticles(&articles, page, num)
		count = models.GetArticlesCount()
		models.CheckErr(err, "获取文章列表出错")
	} else {
		err = models.GetArticlesByCategoryID(&articles, page, num, categoryId)
		count = models.GetArticlesCountByCategoryID(categoryId)
		models.CheckErr(err, "获取文章列表出错")
	}

	pageSum := count / num
	if pageSum > 0 && count%num != 0 {
		pageSum += 1
	}

	data := models.Data{}
	data.Status = true
	data.Msg = "获取数据成功"
	tempData := map[string]interface{}{"Articles": articles, "Count": count, "CurrentPage": page + 1, "PageSum": pageSum, "CategoryId": categoryId}
	data.Data = tempData
	this.Data["json"] = &data
	this.ServeJson()
}

func delArticle(this *ApiController) {
	id, err := strconv.Atoi(this.Ctx.Request.Form.Get("id"))
	models.CheckErr(err, "文章id错误")

	article, err := models.GetArticle(id)
	models.CheckErr(err, "删除文章失败")
	if article.Id != 0 {

		err := models.DelArticle(&article)
		models.CheckErr(err, "删除文章失败")

		tempData := map[string]interface{}{"Article": article}
		data := models.Data{Status: false, Msg: "删除成功", Data: tempData}
		this.Data["json"] = &data
		this.ServeJson()
	}

	models.CheckErr(errors.New("文章不存在"), "")
}

func lenIsZero(str string, msg string) {
	if len(str) == 0 {
		models.CheckErr(errors.New(msg), "添加文章失败")
	}
}

func addArticle(this *ApiController) {
	title := this.Ctx.Request.Form.Get("title")
	lenIsZero(title, "title为空")
	content := this.Ctx.Request.Form.Get("content")
	lenIsZero(content, "content为空")
	categoryId, err := strconv.Atoi(this.Ctx.Request.Form.Get("category_id"))
	models.CheckErr(err, "类别id错误")

	tempArticle, err := models.GetArticleByTitle(title)
	models.CheckErr(err, "添加文章失败")
	if tempArticle.Id != 0 {
		models.CheckErr(errors.New("文章标题已存在"), "添加文章失败")
	}

	article := models.Article{}
	article.Title = title
	article.Content = content
	article.CategoryId = categoryId
	article.CreateTime = time.Now().Format("2006-01-02 15:04:05")
	article.ModifyTime = time.Now().Format("2006-01-02 15:04:05")
	err = models.AddArticle(&article)
	models.CheckErr(err, "添加文章失败")

	tempData := map[string]interface{}{"Article": article}
	data := models.Data{Status: true, Msg: "添加成功", Data: tempData}
	this.Data["json"] = &data
	this.ServeJson()
}

func editArticle(this *ApiController) {
	id, err := strconv.Atoi(this.Ctx.Request.Form.Get("id"))
	models.CheckErr(err, "文章id错误")
	title := this.Ctx.Request.Form.Get("title")
	lenIsZero(title, "title为空")
	content := this.Ctx.Request.Form.Get("content")
	lenIsZero(content, "content为空")
	categoryId, err := strconv.Atoi(this.Ctx.Request.Form.Get("category_id"))
	models.CheckErr(err, "类别id错误")

	tempArticle, err := models.GetArticle(id)
	models.CheckErr(err, "编辑文章失败")
	if tempArticle.Id == 0 {
		models.CheckErr(errors.New("文章标题不存在"), "编辑文章失败")
	}

	tempArticle1, err := models.GetArticleByTitle(title)
	models.CheckErr(err, "添加文章失败")
	if tempArticle1.Id != 0 {
		models.CheckErr(errors.New("类别文章已存在"), "编辑文章失败")
	}

	tempArticle.Title = title
	tempArticle.Content = content
	tempArticle.CategoryId = categoryId
	tempArticle.ModifyTime = time.Now().Format("2006-01-02 15:04:05")
	err = models.AddArticle(&tempArticle)
	models.CheckErr(err, "添加文章失败")

	tempData := map[string]interface{}{"Article": tempArticle}
	data := models.Data{Status: true, Msg: "添加成功", Data: tempData}
	this.Data["json"] = &data
	this.ServeJson()
}

func articleIsExist(this *ApiController) {
	title := this.Ctx.Request.Form.Get("title")
	lenIsZero(title, "title为空")

	tempArticle, err := models.GetArticleByTitle(title)
	models.CheckErr(err, "查询失败")
	if tempArticle.Id == 0 {
		models.CheckErr(errors.New("文章不存在"), "")
	}
	data := models.Data{Status: true, Msg: "文章存在", Data: nil}
	this.Data["json"] = &data
	this.ServeJson()
}

func categoryIsExist(this *ApiController) {
	title := this.Ctx.Request.Form.Get("title")
	lenIsZero(title, "title为空")

	tempArticle, err := models.GetCategoryByTitle(title)
	models.CheckErr(err, "查询失败")
	if tempArticle.Id == 0 {
		models.CheckErr(errors.New("类别不存在"), "")
	}
	data := models.Data{Status: true, Msg: "类别存在", Data: nil}
	this.Data["json"] = &data
	this.ServeJson()
}

//获取全部的类别，包括全部类别这个类别
func getAllCategory(this *ApiController) {
	var categorys []models.Category = make([]models.Category, 0)

	allArticleCount := models.GetArticlesCount()
	allCategory := models.Category{Id: 0, Title: "全部文章", ArticleCount: allArticleCount, CreateTime: time.Now().Format("2006-01-02 15:04:05")}
	categorys = append(categorys, allCategory)

	var tempCategorys []models.Category
	err := models.GetAllCategorys(&tempCategorys)
	models.CheckErr(err, "获取类别列表出错")

	categorys = append(categorys, tempCategorys...)

	data := models.Data{}
	data.Status = true
	data.Msg = "获取数据成功"
	tempData := map[string]interface{}{
		"Categorys": categorys}
	data.Data = tempData
	this.Data["json"] = &data
	this.ServeJson()
}
