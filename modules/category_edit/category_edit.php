<div class="category-add">
<?php 
    if(isset($_REQUEST['i']) && !empty($_REQUEST['i'])){
?>
        <h1><?php echo $language["mod-category-edit-title"]; ?></h1>
        <?php if (!isset($_REQUEST['save'])) { 
            $object_category = new category();
            $object_category->setId(intval($_REQUEST['i']));
            $category = $object_category->returnOneCategory();
        ?>
        <form action="" method="post">
            <div class="separator30"></div>
            
            <div <?php if (!$configuration['lang_1_state']) {echo 'style="display: none;"';} ?>>
                <h2>Lingua 1</h2>
        		<span id="label">Categoria</span>
        		<input type="text" name="title_1" value="<?php print $category['name_1']; ?>" />
        		<span id="label">Descrição</span>
				<?php print returnEditor('content_1',$category['content_1']); ?>
                <div class="separator30"></div> 
            </div>
            <div <?php if (!$configuration['lang_2_state']) {echo 'style="display: none;"';} ?>>
                <h2>Lingua 2</h2>
            	<span id="label">Categoria</span>
        		<input type="text" name="title_2" value="<?php print $category['name_2']; ?>"/>
        		<span id="label">Descrição</span>
				<?php print returnEditor('content_2',$category['content_2']); ?>
                <div class="separator30"></div>
            </div>
            <div <?php if (!$configuration['lang_3_state']) {echo 'style="display: none;"';} ?>>
                <h2>Lingua 3</h2>
            	<span id="label">Categoria</span>
        		<input type="text" name="title_3" value="<?php print $category['name_3']; ?>"/>
        		<span id="label">Descrição</span>
				<?php print returnEditor('content_3',$category['content_3']); ?>
                <div class="separator30"></div>
            </div>
            <div <?php if (!$configuration['lang_4_state']) {echo 'style="display: none;"';} ?>>
                <h2>Lingua 4</h2>
            	<span id="label">Categoria</span>
        		<input type="text" name="title_4" value="<?php print $category['name_4']; ?>"/>
        		<span id="label">Descrição</span>
				<?php print returnEditor('content_4',$category['content_4']); ?>
                <div class="separator30"></div>
            </div>
            <div <?php if (!$configuration['lang_5_state']) {echo 'style="display: none;"';} ?>>
                <h2>Lingua 5</h2>
            	<span id="label">Categoria</span>
        		<input type="text" name="title_5" value="<?php print $category['name_5']; ?>"/>
        		<span id="label">Descrição</span>
				<?php print returnEditor('content_5',$category['content_5']); ?>
                <div class="separator30"></div>
            </div>
            <div <?php if (!$configuration['lang_6_state']) {echo 'style="display: none;"';} ?>>
                <h2>Lingua 6</h2>
            	<span id="label">Categoria</span>
        		<input type="text" name="title_6" value="<?php print $category['name_6']; ?>"/>
        		<span id="label">Descrição</span>
				<?php print returnEditor('content_6',$category['content_6']); ?>
                <div class="separator30"></div>
            </div>
            <div>
                <span id="label">Tipo</span>
        		<select name="category_type">
                <option value="null">Selecione uma Type</option>
                <?php 
                    foreach($configuration['category_sections'] as $category_type){
                        if($category['category_type'] == $category_type) {$selected = 'SELECTED';} else {$selected = null;}
                        print '<option '.$selected.' value="'.$category_type.'">'.$category_type.'</option>';
                        unset($category_type);
                    }    
                ?>
                </select>
                
                <div class="separator30"></div>
            </div>
            
            <div>
				<span id="label">Descrição</span>
				<?php print returnEditor('description',$category['description']); ?>
				<div class="separator30"></div>
			</div>
			
			<span id="label">Lista de ficheiros</span>
            <?php returnFilesList($category['id'],'category'); ?>
            
            <div class="separator30"></div>
            
            <?php
                returnImgUploader('IMG Uploader',$category['id'],'category','290',350);
                print ' ';
                returnDocsUploader('DOCS Uploader',$category['id'],'category','290',350);
            ?>
            
            
            <div class="separator30"></div>
			
	        <div>
	        	<span id="label">Code</span>
				<textarea name="code"><?php print $category['code']; ?></textarea>
				<div class="separator30"></div>
	        </div>
	        
            <div class="bottom-area">
              <input type="checkbox" <?php if($category['published']){ print 'checked="yes"';} ?> name="published"/> Publicado
    	      </br> 
        	  <button type="submit" name="save" class="green"><?php echo $language['save']; ?></button>
        	  <button type="reset" name="cancel" class="red"><?php echo $language['cancel']; ?></button>
        	</div>
        </form>
        
<?php
        }else{
            if (isset($_REQUEST['published'])) $_REQUEST['published'] = true; else $_REQUEST['published'] = false;
            
            $category = new category();
            $category->setId(intval($_REQUEST['i']));
            $category->setContent(
                $_REQUEST['title_1'],
                $_REQUEST['content_1'],
                $_REQUEST['title_2'],
                $_REQUEST['content_2'],
                $_REQUEST['title_3'],
                $_REQUEST['content_3'],
                $_REQUEST['title_4'],
                $_REQUEST['content_4'],
                $_REQUEST['title_5'],
                $_REQUEST['content_5'],
                $_REQUEST['title_6'],
                $_REQUEST['content_6'],
                $_REQUEST['code'],
                );
            $category->setDateUpdate();
            $category->setPublished($_REQUEST['published']);
            $category->setCategoryType($_REQUEST['category_type']);
            
            if ($category->update()) {
                print 'sucess';
            } else {
                print 'failure';
            }
        }
    }else{
        print 'error';   
    }
?>
</div>
