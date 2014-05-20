<div class="product-add">
    <h1><?php echo $language["mod-product-add-title"]; ?></h1>
    <?php if (!isset($_REQUEST['save'])) { 
        returnEditorInit();
    ?>  
    <form action="" method="post">
        <div class="separator30"></div>
        <div <?php if (!$configuration['lang_1_state']) {echo 'style="display: none;"';} ?>>
            <h2>Lingua 1</h2>
            <span id="label">Artigo</span>
            <input type="text" name="title_1"/>
            <span id="label">Referencia</span>
            <input type="text" name="reference"/>
            <span id="label">Descrição</span>
            <?php returnEditor("content_1",null); ?>
            <div class="separator30"></div>
        </div>
        <div <?php if (!$configuration['lang_2_state']) {echo 'style="display: none;"';} ?>>
            <h2>Lingua 2</h2>
            <span id="label">Artigo</span>
            <input type="text" name="title_2"/>
            <span id="label">Descrição</span>
            <?php returnEditor("content_2",null); ?>
            <div class="separator30"></div>
        </div>
        <div <?php if (!$configuration['lang_3_state']) {echo 'style="display: none;"';} ?>>
            <h2>Lingua 3</h2>
            <span id="label">Titulo</span>
            <input type="text" name="title_3"/>
            <span id="label">Descrição</span>
            <?php returnEditor("content_3",null); ?>
            <div class="separator30"></div>
        </div>
        <div <?php if (!$configuration['lang_4_state']) {echo 'style="display: none;"';} ?>>
            <h2>Lingua 4</h2>
            <span id="label">Titulo</span>
            <input type="text" name="title_4"/>
            <span id="label">Descrição</span>
            <?php returnEditor("content_4",null); ?>
            <div class="separator30"></div>
        </div>
        <div <?php if (!$configuration['lang_5_state']) {echo 'style="display: none;"';} ?>>
            <h2>Lingua 5</h2>
            <span id="label">Titulo</span>
            <input type="text" name="title_5"/>
            <span id="label">Descrição</span>
            <?php returnEditor("content_5",null); ?>
            <div class="separator30"></div>
        </div>
        <div <?php if (!$configuration['lang_6_state']) {echo 'style="display: none;"';} ?>>
            <h2>Lingua 6</h2>
            <span id="label">Titulo</span>
            <input type="text" name="title_6"/>
            <span id="label">Descrição</span>
            <?php returnEditor("content_6",null); ?>
            <div class="separator30"></div>
        </div>
        
        <span id="label">Categoria</span>
        <select name="category">
            <option value="null">Selecione uma Categoria</option>
        <?php
            $category = new category();
            
            foreach($category->returnAllCategories() as $cat) {
                if ($cat['category_type'] === 'products') {
                    print '<option value="'.$cat['id'].'">'.$cat['name_1'].'</option>';
                }
            }
        ?>
        </select>
        
        <div class="separator30"></div>
        
        <div>
        	<span id="label">Code</span>
			<textarea name="code"></textarea>
			<button id="code_spr" type="button">[spr]</button> <button id="code_slash" type="button">[/]</button>
        	<div class="separator30"></div>
        </div>
        
        <div>
        	<span id="label">Price</span>
			<input type="text" step="any" placeholder="ex.: 1.23" name="price"/>
        	<div class="separator30"></div>
        </div>
        
        <div>
        	<span id="label">VAT</span>
			<input type="text" step="any" placeholder="ex.: 23.0" name="vat"/>
        	<div class="separator30"></div>
        </div>
        
        <div>
        	<span id="label">Discount</span>
			<input type="text" step="any" placeholder="ex.: 1.10" name="discount"/>
        	<div class="separator30"></div>
        </div>
        
        <div class="bottom-area">  
    	  	<input type="checkbox" name="published"/> Publicado
    	  	</br>
    	  	<input type="checkbox" name="onhome"/> Pagina Inicial
    	  	</br>
    	  	<button type="submit" name="save" class="green"><?php echo $language['save']; ?></button>
    	  	<button type="reset" name="cancel" class="red"><?php echo $language['cancel']; ?></button>
    	</div>
     </form>
    <?php
    }else{
        if (isset($_REQUEST['published'])) $_REQUEST['published'] = true; else $_REQUEST['published'] = false;
        if (isset($_REQUEST['onhome'])) $_REQUEST['onhome'] = true; else $_REQUEST['onhome'] = false;
        
        $product = new product();
        $product->setReference($_REQUEST['reference']);
        $product->setContent(
            $_REQUEST['title_1'], $_REQUEST['content_1'],
            $_REQUEST['title_2'], $_REQUEST['content_2'],
            $_REQUEST['title_3'], $_REQUEST['content_3'],
            $_REQUEST['title_4'], $_REQUEST['content_4'],
            $_REQUEST['title_5'], $_REQUEST['content_5'],
            $_REQUEST['title_6'], $_REQUEST['content_6'],
            $_REQUEST['code']
        );
        
        $product->setPrice($_REQUEST['price']);
        $product->setVAT($_REQUEST['vat']);
        $product->setDiscount($_REQUEST['discount']);
        
        $product->setUserId($account['name']);
        $product->setCategory($_REQUEST['category']);
        $product->setDate();
        $product->setDateUpdate();
        $product->setPublished($_REQUEST['published']);
        $product->setonHome($_REQUEST['onhome']);
        
        if ($product->insert()) {
            print 'sucess';
            
            $id = $mysqli->insert_id;
    ?>
            <div class="separator30"></div>
        
            <span id="label">Lista de ficheiros</span>
            <?php returnFilesList($id,'product'); ?>
            
            <div class="separator30"></div>
            
            <?php
                returnImgUploader('IMG Uploader',$id,'product','290',350);
                print ' ';
                returnDocsUploader('DOCS Uploader',$id,'product','290',350);
            ?>
    <?php 
        } else {
            print 'failure';
        }
    }
    ?>
</div>
