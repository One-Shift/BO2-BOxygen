<div class="article-add">
	<?php if (!isset($_POST["save"])) { ?>
	<form action="" method="post">
    	<div class="spacer30"></div>

    	<div>
    		<span id="label">Name</span>
    		<input type="text" name="name"/>
    	</div>
        <div>
    		<span id="label">Employ</span>
    		<input type="text" name="employ"/>
    	</div>
        <div>
    		<span id="label">Phone</span>
    		<input type="text" name="phone"/>
    	</div>
        <div>
    		<span id="label">Skype</span>
    		<input type="text" name="skype"/>
    	</div>
        <div>
    		<span id="label">E-mail</span>
    		<input type="text" name="email"/>
    	</div>
        <div>
    		<span id="label">Facebook</span>
    		<input type="text" name="fb"/>
    	</div>
        <div>
    		<span id="label">Google +</span>
    		<input type="text" name="g"/>
    	</div>
        <div>
    		<span id="label">Youtube</span>
    		<input type="text" name="yt"/>
    	</div>
        <div>
    		<span id="label">Pinterest</span>
    		<input type="text" name="pi"/>
    	</div>
        <div>
    		<span id="label">Twitter</span>
    		<input type="text" name="tw"/>
    	</div>
        <div>
    		<span id="label">LinkedIn</span>
    		<input type="text" name="in"/>
    	</div>
        <hr/>
        <div>
    		<span id="label">Company Name</span>
    		<input type="text" name="c_name"/>
    	</div>
        <div>
    		<span id="label">Company Area</span>
    		<input type="text" name="c_area"/>
    	</div>
        <div>
    		<span id="label">Company Phone</span>
    		<input type="text" name="c_phone"/>
    	</div>
        <div>
    		<span id="label">Company Skype</span>
    		<input type="text" name="c_skype"/>
    	</div>
        <div>
    		<span id="label">Company E-mail</span>
    		<input type="text" name="c_email"/>
    	</div>
        <div>
    		<span id="label">Company Fax</span>
    		<input type="text" name="c_fax"/>
    	</div>
        <div>
    		<span id="label">Company GPS</span>
    		<input type="text" name="c_gps"/>
    	</div>
        <div>
    		<span id="label">Company Website</span>
    		<input type="text" name="c_website"/>
    	</div>
        <div>
    		<span id="label">Company Street</span>
    		<input type="text" name="c_street"/>
    	</div>
        <div>
    		<span id="label">Company City</span>
    		<input type="text" name="c_city"/>
    	</div>
        <div>
    		<span id="label">Company Region</span>
    		<input type="text" name="c_region"/>
    	</div>
        <div>
    		<span id="label">Company Country</span>
    		<input type="text" name="c_country"/>
    	</div>
        <div>
    		<span id="label">Company ZipCode</span>
    		<input type="text" name="c_zipcode"/>
    	</div>
        <div>
    		<span id="label">Company Facebook</span>
    		<input type="text" name="c_fb"/>
    	</div>
        <div>
    		<span id="label">Company Google+</span>
    		<input type="text" name="c_g"/>
    	</div>
        <div>
    		<span id="label">Company Youtube</span>
    		<input type="text" name="c_yt"/>
    	</div>
        <div>
    		<span id="label">Company Printerest</span>
    		<input type="text" name="c_pri"/>
    	</div>
        <div>
    		<span id="label">Company Twitter</span>
    		<input type="text" name="c_tw"/>
    	</div>
        <div>
    		<span id="label">Company LinkedIn</span>
    		<input type="text" name="c_in"/>
    	</div>

		<div class="spacer30"></div>

    	<div class="bottom-area">
            <label><input type="checkbox" name="published" value="1"/> <?= $language["form"]["label_published"]; ?></label>

			<div class="spacer30"></div>

            <button class="green" title="save" type="submit" name="save" class="green"><i class="fa fa-floppy-o"></i></button>
            <button class="red" title="cancel" type="reset" name="cancel" class="red"><i class="fa fa-times"></i></button>
    	</div>

	</form>
	<?php } else {

		if (isset($_POST["published"])) $_POST["published"] = true; else $_POST["published"] = false;

		$vcard = new vcard();
        $vcard->setName($_POST["name"]);
        $vcard->setData(
            str_replace(
                [
                    "{c2r-p-employ}",
                    "{c2r-p-phone}",
                    "{c2r-p-skype}",
                    "{c2r-p-viber}",
                    "{c2r-p-whatsapp}",
                    "{c2r-p-email}",
                    "{c2r-p-fb}",
                    "{c2r-p-g+}",
                    "{c2r-p-yt}",
                    "{c2r-p-pi}",
                    "{c2r-p-tw}",
                    "{c2r-p-in}",

                    "{c2r-c-name}",
                    "{c2r-c-area}",
                    "{c2r-c-phone}",
                    "{c2r-c-skype}",
                    "{c2r-c-email}",
                    "{c2r-c-fax}",
                    "{c2r-c-gps}",
                    "{c2r-c-website}",
                    "{c2r-c-street}",
                    "{c2r-c-city}",
                    "{c2r-c-region}",
                    "{c2r-c-country}",
                    "{c2r-c-zipcode}",
                    "{c2r-c-fb}",
                    "{c2r-c-g+}",
                    "{c2r-c-yt}",
                    "{c2r-c-pi}",
                    "{c2r-c-tw}",
                    "{c2r-c-in}"
                ],
                [
                    $_POST["employ"],
                    $_POST["phone"],
                    $_POST["skype"],
                    $_POST["viber"],
                    $_POST["whatsapp"],
                    $_POST["email"],
                    $_POST["fb"],
                    $_POST["g"],
                    $_POST["yt"],
                    $_POST["pi"],
                    $_POST["tw"],
                    $_POST["in"],

                    $_POST["c_name"],
                    $_POST["c_area"],
                    $_POST["c_phone"],
                    $_POST["c_fax"],
                    $_POST["c_skype"],
                    $_POST["c_email"],
                    $_POST["c_gps"],
                    $_POST["c_website"],
                    $_POST["c_street"],
                    $_POST["c_city"],
                    $_POST["c_region"],
                    $_POST["c_country"],
                    $_POST["c_zipcode"],
                    $_POST["c_fb"],
                    $_POST["c_g"],
                    $_POST["c_yt"],
                    $_POST["c_pi"],
                    $_POST["c_tw"],
                    $_POST["c_in"]
                ],
                file_get_contents("modules/vcard/templates-e/data-template.html")
            )
        );
        $vcard->setDate();
        $vcard->setDateUpdate();
        $vcard->setPublished($_POST["published"]);

		if ($vcard->insert()) {
			print $language["actions"]["success"];

			$id = $mysqli->insert_id;
	?>
			<div class="spacer30"></div>

			<span id="label"><?= $language["form"]["label_file_list"]; ?></span>
			<?= returnFilesList($id, "vcard"); ?>

			<div class="spacer30"></div>

			<?php
				print returnImgUploader("IMG Uploader", $id, "vcard", 290, 350);
				print " ";
				print returnDocsUploader("DOCS Uploader", $id, "vcard", 290, 350);
			?>
	<?php
		} else {
			print $language["actions"]["failure"];
		}
	} ?>
</div>
