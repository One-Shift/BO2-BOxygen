<?php
    $object_article = new article();
    $article_list = $object_article->returnAllArticles();
?>
<div class="article-list">
	<div class="button-area">
		<button onclick="goTo('./backoffice.php?pg=article-add');" class="green"><?php print $language["template"]["add"] ?></button>  
    	<button onclick="buttonAction ('Confirma?','article-edit');" class="orange"><?php print $language["template"]["edit"] ?></button>
		<button onclick="buttonAction ('Confirma?','article-del');" class="red"><?php print $language["template"]["del"] ?></button>
	</div>
	<table class="db-list">
	  <tr>
		<th>#</th>
		<th>Titulo</th>
		<th>Categoria</th>
		<th>Pub.</th>
        <th>Sel.</th>
	  </tr>
      <?php 
        foreach ($article_list as $article) {
            $object_category = new category();
            $object_category->setId($article['category_id']);
            $category = $object_category->returnOneCategory();
            
            if ($article['published']) {$published = '<img src="./site-assets/images/icon_on.png" alt="on" title="publicado"/>';}
            else {$published = '<img src="./site-assets/images/icon_off.png" alt="off"  title="não publicado"/>';}
            
            print 
            '<tr>'.
            '<td>'.$article['id'].'</td>'.
            '<td>'.$article['title_1'].'</td>'.
            '<td>'.$category['name_1'].'</td>'.
            '<td>'.$published.'</td>'.
            '<td><input type="radio" name="article" value="'.$article['id'].'"/></td>'.
            '</tr>';
        }
        
        
      ?> 
	</table>
	<div class="button-area">
		<button onclick="goTo('./backoffice.php?pg=article-add');" class="green"><?php print $language["template"]["add"] ?></button>  
    	<button onclick="buttonAction ('Confirma?','article-edit');" class="orange"><?php print $language["template"]["edit"] ?></button>
		<button onclick="buttonAction ('Confirma?','article-del');" class="red"><?php print $language["template"]["del"] ?></button>
	</div>
</div>