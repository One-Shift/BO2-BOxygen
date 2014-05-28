<div class="product-edit">
    <?php if(isset($_REQUEST['i']) && !empty($_REQUEST['i'])){ ?>
        <h1><?php echo $language["mod-product-edit-title"]; ?></h1>
        <?php if (!isset($_REQUEST['save'])) {
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
                <?php print returnEditor("content_1",$item['content_1']); ?>
                <div class="separator30"></div>
            </div>
            <div <?php if (!$configuration['lang_2_state']) {echo 'style="display: none;"';} ?>>
                <h2>Lingua 2</h2>
                <span id="label">Artigo</span>
                <input type="text" name="title_2" value="<?php print $item['title_2'] ?>"/>
                <span id="label">Descrição</span>
                <?php print returnEditor("content_2",$item['content_2']); ?>
                <div class="separator30"></div>
            </div>
            <div <?php if (!$configuration['lang_3_state']) {echo 'style="display: none;"';} ?>>
                <h2>Lingua 3</h2>
                <span id="label">Titulo</span>
                <input type="text" name="title_3" value="<?php print $item['title_3'] ?>"/>
                <span id="label">Descrição</span>
                <?php print returnEditor("content_3",$item['content_3']); ?>
                <div class="separator30"></div>
            </div>
            <div <?php if (!$configuration['lang_4_state']) {echo 'style="display: none;"';} ?>>
                <h2>Lingua 4</h2>
                <span id="label">Titulo</span>
                <input type="text" name="title_4" value="<?php print $item['title_4'] ?>"/>
                <span id="label">Descrição</span>
                <?php print returnEditor("content_4",$item['content_4']); ?>
                <div class="separator30"></div>
            </div>
            <div <?php if (!$configuration['lang_5_state']) {echo 'style="display: none;"';} ?>>
                <h2>Lingua 5</h2>
                <span id="label">Titulo</span>
                <input type="text" name="title_5" value="<?php print $item['title_5'] ?>"/>
                <span id="label">Descrição</span>
                <?php print returnEditor("content_5",$item['content_5']); ?>
                <div class="separator30"></div>
            </div>
            <div <?php if (!$configuration['lang_6_state']) {echo 'style="display: none;"';} ?>>
                <h2>Lingua 6</h2>
                <span id="label">Titulo</span>
                <input type="text" name="title_6" value="<?php print $item['title_6'] ?>"/>
                <span id="label">Descrição</span>
                <?php print returnEditor("content_6",$item['content_6']); ?>
                <div class="separator30"></div>
            </div>

            <span id="label">Categoria</span>
            <select name="category">
                <option value="null">Selecione uma Categoria</option>
            <?php
                $category = new category();

                foreach($category->returnAllCategories() as $cat) {
                    $selected = null;
                    if ($cat["id"] === $item["category_id"]) {
                        $selected = "selected=\"\"";
                    }

                    if ($cat['category_type'] === 'products') {
                        printf("<option value=\"%s\" %s>%s</option>", $cat["id"], $selected, $cat["name_1"]);
                    }
                }
            ?>
            </select>

            <div class="separator30"></div>

            <span id="label">Lista de ficheiros</span>
            <?php returnFilesList($item['id'],'product'); ?>

            <div class="separator30"></div>

            <?php
                print returnImgUploader('IMG Uploader',$item['id'],'product','290',350);
                print ' ';
                print returnDocsUploader('DOCS Uploader',$item['id'],'product','290',350);
            ?>

            <div class="separator30"></div>
            <div>
            	<span id="label">Code</span>
    			<textarea name="code"><?php print $item['code']; ?></textarea>
    			<button id="code_spr" type="button">[spr]</button> <button id="code_slash" type="button">[/]</button>
            	<div class="separator30"></div>
            </div>

		    <div>
		    	<span id="label">Price</span>
				<input type="number" step="any" placeholder="ex.: 1.23" name="price" value="<?php print $item['price']; ?>" />
		    	<div class="separator30"></div>
		    </div>

		    <div>
		    	<span id="label">VAT</span>
				<input type="number" step="any" placeholder="ex.: 23.0" name="vat" value="<?php print $item['vat']; ?>" />
		    	<div class="separator30"></div>
		    </div>\

		    <div>
		    	<span id="label">Discount</span>
				<input type="number" step="any" placeholder="ex.: 1.10" name="discount" value="<?php print $item['discount']; ?>"/>
		    	<div class="separator30"></div>
		    </div>

            <div class="bottom-area">
            	<input type="checkbox" <?php if($item['published']){ print 'checked="yes"';} ?> name="service" /> Serviço
    	        </br>
                <input type="checkbox" <?php if($item['published']){ print 'checked="yes"';} ?> name="published" /> Publicado
    	        </br>
    	        <input type="checkbox" <?php if($item['onhome']){ print 'checked="yes"';} ?>  name="onhome" /> Pagina Inicial
    	        </br>
    	        <button type="submit" name="save" class="green"><?php echo $language['save']; ?></button>
    	        <button type="reset" name="cancel" class="red"><?php echo $language['cancel']; ?></button>
    	    </div>
        </form>
        <?php

        }else{
            $product = new product();
            $product->setId(intval($_GET['i']));
			
			// convert to bool the service box
			if (isset($_REQUEST['service'])) $_REQUEST['service'] = true; else $_REQUEST['service'] = false;
			// convert to bool the published box
            if (isset($_REQUEST['published'])) $_REQUEST['published'] = true; else $_REQUEST['published'] = false;
            // convert to bool the onhome box
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

            $product->setPrice($_REQUEST['price']);
        	$product->setVAT($_REQUEST['vat']);
        	$product->setDiscount($_REQUEST['discount']);

            $product->setCategory($_REQUEST['category']);
            $product->setDateUpdate();
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
