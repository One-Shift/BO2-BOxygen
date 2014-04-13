<div class="product-edit">
    <?php if(isset($_REQUEST['i']) && !empty($_REQUEST['i'])){ ?>
        <h1><?php echo $language["mod-product-edit-title"]; ?></h1>
        <?php if (!isset($_REQUEST['save'])) { 
            returnEditorInit();
            $product = new product();
            $product->setId(intval($_REQUEST['i']));
            $item = $product->returnOneProduct();
        ?>  
        <form action="" method="post">
            <div class="separator30"></div>
            <div <?php if (!$configuration['lang_1_state']) {echo 'style="display: none;"';} ?>>
                <h2>Lingua 1</h2>
                <span id="label">Artigo</span>
                <input type="text" name="title_1" value="<?php print $item['title_1'] ?>"/>
                <span id="label">Descrição</span>
                <?php returnEditor("content_1",$item['content_1']); ?>
                <div class="separator30"></div>
            </div>
            <div <?php if (!$configuration['lang_2_state']) {echo 'style="display: none;"';} ?>>
                <h2>Lingua 2</h2>
                <span id="label">Artigo</span>
                <input type="text" name="title_2" value="<?php print $item['title_2'] ?>"/>
                <span id="label">Descrição</span>
                <?php returnEditor("content_2",$item['content_2']); ?>
                <div class="separator30"></div>
            </div>
            <div <?php if (!$configuration['lang_3_state']) {echo 'style="display: none;"';} ?>>
                <h2>Lingua 3</h2>
                <span id="label">Titulo</span>
                <input type="text" name="title_3" value="<?php print $item['title_3'] ?>"/>
                <span id="label">Descrição</span>
                <?php returnEditor("content_3",$item['content_3']); ?>
                <div class="separator30"></div>
            </div>
            <div <?php if (!$configuration['lang_4_state']) {echo 'style="display: none;"';} ?>>
                <h2>Lingua 4</h2>
                <span id="label">Titulo</span>
                <input type="text" name="title_4" value="<?php print $item['title_4'] ?>"/>
                <span id="label">Descrição</span>
                <?php returnEditor("content_4",$item['content_4']); ?>
                <div class="separator30"></div>
            </div>
            <div <?php if (!$configuration['lang_5_state']) {echo 'style="display: none;"';} ?>>
                <h2>Lingua 5</h2>
                <span id="label">Titulo</span>
                <input type="text" name="title_5" value="<?php print $item['title_5'] ?>"/>
                <span id="label">Descrição</span>
                <?php returnEditor("content_5",$item['content_5']); ?>
                <div class="separator30"></div>
            </div>
            <div <?php if (!$configuration['lang_6_state']) {echo 'style="display: none;"';} ?>>
                <h2>Lingua 6</h2>
                <span id="label">Titulo</span>
                <input type="text" name="title_6" value="<?php print $item['title_6'] ?>"/>
                <span id="label">Descrição</span>
                <?php returnEditor("content_6",$item['content_6']); ?>
                <div class="separator30"></div>
            </div>
            
            <span id="label">Categoria</span>
            <select name="category">
                <option value="null">Selecione uma Categoria</option>
            <?php
                $category = new category();
                
                foreach($category->returnAllCategories() as $cat) {
                    if ($cat['section'] == 'products' || $cat['section'] == 'animes' || $cat['section'] == 'manga') {
                        if($cat['id'] == $item['category'] ) {$selected = 'SELECTED';} else {$selected = null;}
                        print '<option '.$selected.' value="'.$cat['id'].'">'.$cat['name_1'].'</option>';
                    }
                }
                unset($category);
            ?>
            </select>
            
            <div class="separator30"></div>
                
            <span id="label">Lista de ficheiros</span>
            <?php returnFilesList($item['id'],'product'); ?>
            
            <div class="separator30"></div>
            
            <?php
                returnImgUploader('IMG Uploader',$item['id'],'product','290',350);
                print ' ';
                returnDocsUploader('DOCS Uploader',$item['id'],'product','290',350);
            ?>
            
            <div class="separator30"></div>
            <div>
            <span id="label">Code</span>
    		<textarea name="code"><?php print $item['code']; ?></textarea>
            <div class="separator30"></div>
            </div>
            
            <div class="bottom-area">  
                <input type="checkbox" <?php if($item['published']){ print 'checked="yes"';} ?> name="published"/> Publicado
    	        </br>
    	        <input type="checkbox" <?php if($item['onhome']){ print 'checked="yes"';} ?>  name="onhome"/> Pagina Inicial
    	        </br>
    	        <button type="submit" name="save" class="green"><?php echo $language['save']; ?></button>
    	        <button type="reset" name="cancel" class="red"><?php echo $language['cancel']; ?></button>
    	    </div>
        </form>
        <?php
        
        }else{
            $product = new product();
            $product->setId(intval($_REQUEST['i']));
            
            if (isset($_REQUEST['published'])) $_REQUEST['published'] = true; else $_REQUEST['published'] = false;
            if (isset($_REQUEST['onhome'])) $_REQUEST['onhome'] = true; else $_REQUEST['onhome'] = false;
            
            $product->setContent(
                $_REQUEST['title_1'], $_REQUEST['content_1'],
                $_REQUEST['title_2'], $_REQUEST['content_2'],
                $_REQUEST['title_3'], $_REQUEST['content_3'],
                $_REQUEST['title_4'], $_REQUEST['content_4'],
                $_REQUEST['title_5'], $_REQUEST['content_5'],
                $_REQUEST['title_6'], $_REQUEST['content_6'],
                $_REQUEST['code']
            );
            
            $product->setCategory($_REQUEST['category']);
            $product->setPublished($_REQUEST['published']);
            $product->setonHome($_REQUEST['onhome']);
            
            if ($product->update()) {
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