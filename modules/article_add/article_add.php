<div class="article-add">
	<h1><?php echo $language["mod-news-add-title"]; ?></h1>
    <?php if (!isset($_REQUEST['save'])) { ?>
    <form action="" method="post">
    <div class="separator30"></div>
    
    <div <?php if (!$configuration['lang_1_state']) {echo 'style="display: none;"';} ?>>
        <h2>Lingua 1</h2>
		<span id="label">Titulo</span>
		<input type="text" name="title_1"/>
		<span id="label">Conteudo</span>
		<?php print returnEditor('content_1',null); ?>
        
        <div class="separator30"></div>
    </div>
    
    <div <?php if (!$configuration['lang_2_state']) {echo 'style="display: none;"';} ?>>
		<h2>Lingua 2</h2>
		<span id="label">Titulo</span>
		<input type="text" name="title_2"/>
		<span id="label">Conteudo</span>
		<?php print returnEditor('content_2',null); ?>
		
        <div class="separator30"></div>
    </div>
    
    <div <?php if (!$configuration['lang_3_state']) {echo 'style="display: none;"';} ?>>
		<h2>Lingua 3</h2>
		<span id="label">Titulo</span>
		<input type="text" name="title_3"/>
		<span id="label">Conteudo</span>
		<?php print returnEditor('content_3',null); ?>
		
        <div class="separator30"></div>
    </div>
    
    <div <?php if (!$configuration['lang_4_state']) {echo 'style="display: none;"';} ?>>
		<h2>Lingua 4</h2>
		<span id="label">Titulo</span>
		<input type="text" name="title_4"/>
		<span id="label">Conteudo</span>
		<?php print returnEditor('content_4',null); ?>
        
        <div class="separator30"></div>
    </div>
    
    <div <?php if (!$configuration['lang_5_state']) {echo 'style="display: none;"';} ?>>
		<h2>Lingua 5</h2>
		<span id="label">Titulo</span>
		<input type="text" name="title_5"/>
		<span id="label">Conteudo</span>
		<?php print returnEditor('content_5',null); ?>
        
        <div class="separator30"></div>
    </div>
    
    <div <?php if (!$configuration['lang_6_state']) {echo 'style="display: none;"';} ?>>
		<h2>Lingua 6</h2>
		<span id="label">Titulo</span>
		<input type="text" name="title_6"/>
		<span id="label">Conteudo</span>
		<?php print returnEditor('content_6',null); ?>
        
        <div class="separator30"></div>
    </div>
    
    <span id="label">Categoria</span>
    <select name="category">
        <option value="null">Selecione uma Categoria</option>
    <?php
        $category = new category();
        
        foreach($category->returnAllCategories() as $cat) {
            if ($cat['category_type'] == 'articles') {
                print '<option value="'.$cat['id'].'">'.$cat['name_1'].'</option>';
            }
        }
        unset($category);
    ?>
    </select>
    
    <div class="separator30"></div>
    
    <div>
        <span id="label">Code</span>
		<textarea name="code"></textarea>
        <div class="separator30"></div>
    </div>
    
	<div class="bottom-area">  
	  <input type="checkbox" name="published" value="1"/> Publicado
	  </br>
	  <input type="checkbox" name="onhome" value="1"/> Pagina Inicial
	  </br>
	  <button type="submit" name="save" class="green"><?php echo $language['save']; ?></button>
	  <button type="reset" name="cancel" class="red"><?php echo $language['cancel']; ?></button>
	</div>
    
    </form>
    <?php } else {
        
        if (isset($_REQUEST['published'])) $_REQUEST['published'] = true; else $_REQUEST['published'] = false;
        if (isset($_REQUEST['onhome'])) $_REQUEST['onhome'] = true; else $_REQUEST['onhome'] = false;
        
        $article = new article();
        $article->setContent(
            $_REQUEST['title_1'], $_REQUEST['content_1'],
            $_REQUEST['title_2'], $_REQUEST['content_2'],
            $_REQUEST['title_3'], $_REQUEST['content_3'],
            $_REQUEST['title_4'], $_REQUEST['content_4'],
            $_REQUEST['title_5'], $_REQUEST['content_5'],
            $_REQUEST['title_6'], $_REQUEST['content_6'],
            $_REQUEST['code']
        );
        $article->setUserId($account['name']);
        $article->setCategory($_REQUEST['category']);
        $article->setDate();
        $article->setDateUpdate();
        $article->setPublished($_REQUEST['published']);
        $article->setonHome($_REQUEST['onhome']);
        
        if ($article->insert()) {
            print 'sucess';
            
            $id = $mysqli->insert_id;
    ?>
            <div class="separator30"></div>
        
            <span id="label">Lista de ficheiros</span>
            <?php print returnFilesList($id,'article'); ?>
            
            <div class="separator30"></div>
            
            <?php
                print returnImgUploader('IMG Uploader',$id,'article','290',350);
                print ' ';
                print returnDocsUploader('DOCS Uploader',$id,'article','290',350);
            ?>
    <?php 
        } else {
            print 'failure';
        }
    } ?>
</div>
