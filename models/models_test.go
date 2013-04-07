package models

import (
	"fmt"
	"testing"
	"time"
	// "time"
)

func TestAddArticle(t *testing.T) {
	article := &Article{}
	article.Title = "博客1"
	article.CategoryId = 1
	article.Content = "博客内容"
	article.CreateTime = time.Now().Format("2006-01-02 15:04:05")
	article.ModifyTime = time.Now().Format("2006-01-02 15:04:05")
	err := AddArticle(article)
	if err != nil {
		t.Log("添加文章失败:", err)
		t.Fail()
	}
	fmt.Println("添加文章成功:", article)
}

func TestDelArticle(t *testing.T) {
	article := Article{}
	article.Title = "博客1"
	article.CategoryId = 1
	article.Content = "博客内容"
	article.CreateTime = time.Now().Format("2006-01-02 15:04:05")
	article.ModifyTime = time.Now().Format("2006-01-02 15:04:05")
	err := AddArticle(&article)
	if err != nil {
		t.Log("添加文章失败:", err)
		t.Fail()
	}

	err1 := DelArticle(&article)

	if err1 != nil {
		t.Log("删除文章失败", err)
		t.Fail()
	}
	fmt.Println("删除文章成功:", article)
}

func TestGetAllArticles(t *testing.T) {
	var articles []Article
	err := GetAllArticles(&articles)
	if err != nil {
		t.Log("获取文章列表失败", err)
		t.Fail()
	}
	fmt.Println("TestGetAllArticles:", articles)
}

func TestGetAllArticlesWithCategoryId(t *testing.T) {
	var articles []Article
	err := GetArticlesByCategoryID(&articles, 1, 8, 1)
	if err != nil {
		t.Log("获取文章列表失败", err)
		t.Fail()
	}
	fmt.Println("TestGetAllArticlesWithCategoryId:", articles)
}

func TestGetAllArticlesCountWithCategoryId(t *testing.T) {

	count := GetArticlesCountByCategoryID(1)
	fmt.Println(count)

}

func TestGetAllArticlesCount(t *testing.T) {

	count := GetArticlesCount()
	fmt.Println(count)

}

func TestGetArticles(t *testing.T) {
	var articles []Article
	err := GetArticles(&articles, 1, 8)
	if err != nil {
		t.Log("获取文章列表失败", err)
		t.Fail()
	}
	fmt.Println("TestGetArticles:", articles)
}

func TestAddCategory(t *testing.T) {
	article := &Category{}
	article.Title = "类别1"
	article.CreateTime = time.Now().Format("2006-01-02 15:04:05")
	err := AddCategory(article)
	if err != nil {
		t.Log("添加类别失败:", err)
		t.Fail()
	}
	fmt.Println("添加类别成功:", article)
}

func TestGetActicle(t *testing.T) {
	article, err := GetArticle(20)
	if err != nil {
		t.Log(err)
	}

	fmt.Println(article)
}

func TestDelCategory(t *testing.T) {
	article := &Category{}
	article.Title = "类别1"
	article.CreateTime = time.Now().Format("2006-01-02 15:04:05")
	err := AddCategory(article)
	if err != nil {
		t.Log("添加类别失败:", err)
		t.Fail()
	}

	err1 := DelCategory(article)
	if err1 != nil {
		t.Log("删除类别失败:", err1)
		t.Fail()
	}
	fmt.Println("删除类别成功:", article)
}

func TestGetAllCategory(t *testing.T) {
	articles := make([]Category, 0, 10)
	err := GetAllCategorys(&articles)
	if err != nil {
		t.Log("获取类别失败:.", err)
		t.Fail()
	}
	t.Log(articles)
	fmt.Println("获取类别成功:", articles)
}

func TestGetCategory(t *testing.T) {
	article, err := GetCategory(1)
	if err != nil {
		t.Log(err)
	}

	fmt.Println(article)
}

func TestGetCategoryByPage(t *testing.T) {
	var articles []Category
	err := GetCategoryByPage(&articles, 0, 5)
	if err != nil {
		t.Log("获取文章列表失败", err)
		t.Fail()
	}
	fmt.Println("获取文章列表文章成功:", articles)
}

func TestCategoryCount(t *testing.T) {

	count := GetCategoryCount()
	if count == 0 {
		t.Log("获取失败")
		t.Fail()
	}

}
func TestGetCategoryByTitle1(t *testing.T) {

	category, err := GetCategoryByTitle("测试劣币")
	if err != nil {
		t.Log("获取失败")
		t.Fail()
	}
	fmt.Println(category)

}

func TestGetCategoryByTitle2(t *testing.T) {

	category, err := GetCategoryByTitle("心情")
	if err != nil {
		t.Log("获取失败")
		t.Fail()
	}
	fmt.Println(category)

}
