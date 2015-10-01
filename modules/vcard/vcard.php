<div class="vcard">
    <?php
    if ($a != null) {
        switch ($a) {
            case "add": include "modules/vcard/add.php";
				break;
            case "delete": include "modules/vcard/del.php";
				break;
            case "edit": include "modules/vcard/edit.php";
                break;
            default: include "modules/vcard/list.php";
        }
    } else {
        include "modules/vcard/list.php";
    }
    ?>
</div>
