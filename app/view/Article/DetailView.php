<?php
/**
 * 文章详情页面
 */
class ArticleDetailView {
    public function render($twig,$data = array()) {
        echo $twig->render ( 'article_detail.twig',array('article'=>$data));
    }
}
?>
        
