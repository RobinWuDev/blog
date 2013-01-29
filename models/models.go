package models

import (
	"database/sql"
	// "fmt"
	"errors"
	"github.com/LostSkyDev/beedb"
	_ "github.com/mattn/go-sqlite3"
	"strconv"
)

type Data struct {
	Status bool
	Msg    string
	Data   map[string]interface{}
}

type Article struct {
	Id           int
	Title        string
	CategoryId   int
	CategoryName string `-`
	Content      string
	CreateTime   string
	ModifyTime   string
}

type Category struct {
	Id           int
	Title        string
	ArticleCount int `-`
	CreateTime   string
}

func AddArticle(article *Article) (err error) {
	orm := getDBOrm()
	if cat, _ := GetCategory(article.CategoryId); cat.Id != 0 {
		err = orm.Save(article)
	} else {
		err = errors.New("类别id不存在")
	}

	return err

}

func GetArticle(id int) (article Article, err error) {
	orm := getDBOrm()

	a, err := orm.SetTable("article").Join("LEFT", "category", "article.category_id=category.id").Where("article.id=?", id).Select("article.id,article.title,article.category_id,category.title as category_name,article.content,article.create_time,article.modify_time").OrderBy("article.create_time desc").FindMap()
	if len(a) > 0 {
		temp := a[0]
		article = Article{}
		article.Id, _ = strconv.Atoi(string(temp["id"]))
		article.Title = string(temp["title"])
		article.Content = string(temp["content"])
		article.CategoryId, _ = strconv.Atoi(string(temp["category_id"]))
		article.CategoryName = string(temp["category_name"])
		article.CreateTime = string(temp["create_time"])
		article.ModifyTime = string(temp["modify_time"])
	}
	return
}

func GetArticleByTitle(title string) (article Article, err error) {
	orm := getDBOrm()
	a, err := orm.SetTable("article").Join("LEFT", "category", "article.category_id=category.id").Where("article.title=?", title).Select("article.id,article.title,article.category_id,category.title as category_name,article.content,article.create_time,article.modify_time").OrderBy("article.create_time desc").FindMap()
	if len(a) > 0 {
		temp := a[0]
		article = Article{}
		article.Id, _ = strconv.Atoi(string(temp["id"]))
		article.Title = string(temp["title"])
		article.Content = string(temp["content"])
		article.CategoryId, _ = strconv.Atoi(string(temp["category_id"]))
		article.CategoryName = string(temp["category_name"])
		article.CreateTime = string(temp["create_time"])
		article.ModifyTime = string(temp["modify_time"])
	}
	return article, err
}

func DelArticle(article *Article) (err error) {
	orm := getDBOrm()
	_, err = orm.Delete(article)
	return err

}

func GetAllArticles(articles *[]Article) (err error) {
	orm := getDBOrm()
	a, err := orm.SetTable("article").Join("LEFT", "category", "article.category_id=category.id").Select("article.id,article.title,article.category_id,category.title as category_name,article.content,article.create_time,article.modify_time").OrderBy("article.create_time desc").FindMap()
	tempArticles := make([]Article, 0)

	for _, temp := range a {
		article := Article{}
		article.Id, _ = strconv.Atoi(string(temp["id"]))
		article.Title = string(temp["title"])
		article.Content = string(temp["content"])
		article.CategoryId, _ = strconv.Atoi(string(temp["category_id"]))
		article.CategoryName = string(temp["category_name"])
		article.CreateTime = string(temp["create_time"])
		article.ModifyTime = string(temp["modify_time"])
		tempArticles = append(tempArticles, article)
	}
	*articles = tempArticles

	return err
}

func GetArticles(articles *[]Article, page int, num int) (err error) {
	orm := getDBOrm()
	a, err := orm.SetTable("article").Join("LEFT", "category", "article.category_id=category.id").Select("article.id,article.title,article.category_id,category.title as category_name,article.content,article.create_time,article.modify_time").OrderBy("article.create_time desc").Limit(num, num*page).FindMap()
	tempArticles := make([]Article, 0)
	for _, temp := range a {
		article := Article{}
		article.Id, _ = strconv.Atoi(string(temp["id"]))
		article.Title = string(temp["title"])
		article.Content = string(temp["content"])
		article.CategoryId, _ = strconv.Atoi(string(temp["category_id"]))
		article.CategoryName = string(temp["category_name"])
		article.CreateTime = string(temp["create_time"])
		article.ModifyTime = string(temp["modify_time"])
		tempArticles = append(tempArticles, article)
	}
	*articles = tempArticles

	return err
}

func GetArticlesByCategoryID(articles *[]Article, page int, num int, categoryId int) (err error) {
	orm := getDBOrm()
	a, err := orm.SetTable("article").Join("LEFT", "category", "article.category_id=category.id").Where("article.category_id = ?", categoryId).Limit(num, num*page).Select("article.id,article.title,article.category_id,category.title as category_name,article.content,article.create_time,article.modify_time").OrderBy("article.create_time desc").FindMap()
	tempArticles := make([]Article, 0)
	for _, temp := range a {
		article := Article{}
		article.Id, _ = strconv.Atoi(string(temp["id"]))
		article.Title = string(temp["title"])
		article.Content = string(temp["content"])
		article.CategoryId, _ = strconv.Atoi(string(temp["category_id"]))
		article.CategoryName = string(temp["category_name"])
		article.CreateTime = string(temp["create_time"])
		article.ModifyTime = string(temp["modify_time"])
		tempArticles = append(tempArticles, article)
	}
	*articles = tempArticles

	return err
}

func GetArticlesCountByCategoryID(categoryId int) (count int) {
	orm := getDBOrm()
	var countArticle []Article
	orm.Where("category_id = ?", categoryId).FindAll(&countArticle)
	count = len(countArticle)
	return count
}

func GetArticlesCount() int {
	orm := getDBOrm()
	var countArticle []Article
	orm.FindAll(&countArticle)
	count := len(countArticle)
	return count
}

func AddCategory(article *Category) (err error) {
	orm := getDBOrm()
	err = orm.Save(article)
	return err
}

func GetCategory(id int) (category Category, err error) {
	orm := getDBOrm()
	err = orm.Where("id = ?", id).Find(&category)
	if category.Id != 0 {
		category.ArticleCount = GetArticlesCountByCategoryID(category.Id)
	}
	return
}

func GetCategoryByTitle(title string) (category Category, err error) {
	orm := getDBOrm()
	err = orm.Where("title = ?", title).Find(&category)
	if category.Id != 0 {
		category.ArticleCount = GetArticlesCountByCategoryID(category.Id)
	}
	return
}

func DelCategory(article *Category) (err error) {
	orm := getDBOrm()
	_, err = orm.Delete(article)
	return err
}

func GetCategoryByPage(articles *[]Category, page int, num int) (err error) {
	orm := getDBOrm()
	var tempArtilces []Category
	*articles = make([]Category, 0)
	err = orm.Limit(num, num*page).FindAll(&tempArtilces)
	for _, v := range tempArtilces {
		count := GetArticlesCountByCategoryID(v.Id)
		v.ArticleCount = count
		*articles = append(*articles, v)
	}
	return err
}

func GetAllCategorys(articles *[]Category) (err error) {
	orm := getDBOrm()
	err = orm.FindAll(articles)
	var tempArtilces []Category
	*articles = make([]Category, 0)
	err = orm.FindAll(&tempArtilces)
	for _, v := range tempArtilces {
		count := GetArticlesCountByCategoryID(v.Id)
		v.ArticleCount = count
		*articles = append(*articles, v)
	}
	return err
}

func GetCategoryCount() int {
	orm := getDBOrm()
	var countArticle []Category
	orm.FindAll(&countArticle)
	count := len(countArticle)
	return count
}

func getDBOrm() (orm beedb.Model) {

	db, err := sql.Open("sqlite3", "./models/ls_dev.rdb")
	// db, err := sql.Open("sqlite3", "./ls_dev.rdb")
	if err != nil {
		panic(err)
	}
	orm = beedb.New(db)

	return orm
}
