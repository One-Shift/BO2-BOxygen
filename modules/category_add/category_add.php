<div class="article-add">
    <h1><?php echo $language["mod-category-add-title"]; ?></h1>
    <?php if (!isset($_REQUEST['save'])) { ?>
    <form action="" method="post">
    <div class="separator30"></div>
    
    <div <?php if (!$configuration['lang_1_state']) {echo 'style="display: none;"';} ?>>
        <h2>Lingua 1</h2>
		<span id="label">Categoria</span>
		<input type="text" name="title_1"/>
		<span id="label">Descrição</span>
		<?php print returnEditor('content_1',null); ?>
        <div class="separator30"></div> 
    </div>
    <div <?php if (!$configuration['lang_2_state']) {echo 'style="display: none;"';} ?>>
        <h2>Lingua 2</h2>
    	<span id="label">Categoria</span>
		<input type="text" name="title_2"/>
		<span id="label">Descrição</span>
		<?php print returnEditor('content_2',null); ?>
        <div class="separator30"></div>
    </div>
    <div <?php if (!$configuration['lang_3_state']) {echo 'style="display: none;"';} ?>>
        <h2>Lingua 3</h2>
    	<span id="label">Categoria</span>
		<input type="text" name="title_3"/>
		<span id="label">Descrição</span>
		<?php print returnEditor('content_3',null); ?>
        <div class="separator30"></div>
    </div>
    <div <?php if (!$configuration['lang_4_state']) {echo 'style="display: none;"';} ?>>
        <h2>Lingua 4</h2>
    	<span id="label">Categoria</span>
		<input type="text" name="title_4"/>
		<span id="label">Descrição</span>
		<?php print returnEditor('content_4',null); ?>
        <div class="separator30"></div>
    </div>
    <div <?php if (!$configuration['lang_5_state']) {echo 'style="display: none;"';} ?>>
        <h2>Lingua 5</h2>
    	<span id="label">Categoria</span>
		<input type="text" name="title_5"/>
		<span id="label">Descrição</span>
		<?php print returnEditor('content_5',null); ?>
        <div class="separator30"></div>
    </div>
    <div <?php if (!$configuration['lang_6_state']) {echo 'style="display: none;"';} ?>>
        <h2>Lingua 6</h2>
    	<span id="label">Categoria</span>
		<input type="text" name="title_6"/>
		<span id="label">Descrição</span>
		<?php print returnEditor('content_6',null); ?>
        <div class="separator30"></div>
    </div>
    <div>
        <span id="label">Section</span>
		<select name="section">
        <option value="null">Selecione uma Type</option>
        <?php 
            foreach($configuration['category_sections'] as $section){
                print '<option value="'.$section.'">'.$language[$section].'</option>';   
            }    
        ?>
        </select>
        <div class="separator30"></div>
    </div>
    <div>
        <span id="label">Code</span>
		<textarea name="code"></textarea>
        <div class="separator30"></div>
    </div>
    
    <div class="bottom-area">
      <input type="checkbox" name="published" value="1"/> Publicado
	  </br>
	  <button type="submit" name="save" class="green"><?php echo $language['save']; ?></button>
	  <button type="reset" name="cancel" class="red"><?php echo $language['cancel']; ?></button>
	</div>
    
    </form>
    
    <?php
    }else{
        
        if (isset($_REQUEST['published'])) $_REQUEST['published'] = true; else $_REQUEST['published'] = false;
        
        $object_category = new category();
        $object_category->setContent(
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
            
        $object_category->setUserId();
        $object_category->setDate();
        $object_category->setDateUpdate();
        $object_category->setPublished($_REQUEST['published']);
        $object_category->setCategoryType($_REQUEST['section']);
        
        if ($object_category->insert()) {
            print 'sucess';
        } else {
            print 'failure';
        }
    }
    ?>
</div>
